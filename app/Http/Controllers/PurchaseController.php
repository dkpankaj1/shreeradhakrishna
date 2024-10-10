<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Customer;
use App\Models\Messenger;
use App\Models\Purchase;
use App\Models\WaTemplate;
use App\Services\WhatsAppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\BhashSmsService;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {

        try {
            $resources = Purchase::join('customers', 'customers.id', '=', 'purchases.customer_id')->select([
                'purchases.id',
                'purchases.trans_id',
                'purchases.product',
                'purchases.volume',
                'purchases.amt',
                'purchases.reward',
                'purchases.isredeem',
                'customers.card',
                'customers.name',
                'customers.vehicle_number'
            ])->latest('purchases.created_at');

            /** if isset search */
            if (request('search')) {
                $resources->where('customers.name', 'Like', '%' . request('search') . '%')
                    ->orWhere('customers.card', 'Like', '%' . request('search') . '%')
                    ->orWhere('purchases.trans_id', 'Like', '%' . request('search') . '%')
                    ->orWhere('purchases.product', 'Like', '%' . request('search') . '%')
                    ->orWhere('purchases.volume', 'Like', '%' . request('search') . '%')
                    ->orWhere('purchases.amt', 'Like', '%' . request('search') . '%');
            }

            $purchases = $resources->paginate(10);
            return view('purchase.index', compact('purchases'));

        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        try {
            $resource = Customer::all();
            return view('purchase.create', ['customers' => $resource]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'trans_id' => 'required|unique:purchases,trans_id',
            'product' => 'required',
            'volume' => 'required',
            'amt' => 'required|numeric|min:0|max:100000',
            'customer_id' => 'required',
        ]);

        $data = [
            'trans_id' => $request->trans_id,
            'product' => $request->product,
            'volume' => $request->volume,
            'amt' => $request->amt,
            'reward' => floor(AppHelper::makeReward((int) $request->amt)),
            'isredeem' => 0,
            'customer_id' => $request->customer_id,
            'created_by' => $request->user()->email,
        ];
        Purchase::create($data);
        try {

            $customer = Customer::where('id', $request->customer_id)->first();
            $template = WaTemplate::where('template_id', 'new_purchase')->first();
            $totalReword = Purchase::where(['customer_id' => $request->customer_id, 'isredeem' => 0])->sum('reward') ?? 0;
            $waService = new WhatsAppService();
            $msg = new Messenger();

            $waService->sendTextWithParams([$customer->phone], $template->template_id, [$customer->name, $totalReword]);

            $msg->customer_id = $customer->id;
            $msg->wa_template_id = $template->id;
            $msg->attachment = "";
            $msg->status = 1;
            $msg->save();

            return redirect()->route('purchase.index')->with('success', 'Purchase Update successfully');

        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase): View
    {
        try {
            return view('purchase.show', ['data' => $purchase]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase): View
    {
        try {
            $customers = Customer::all();
            return view('purchase.edit', ['data' => $purchase, 'customers' => $customers]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase): RedirectResponse
    {
        $request->validate([
            'trans_id' => 'required|unique:purchases,trans_id,' . $purchase->id,
            'product' => 'required',
            'volume' => 'required',
            'amt' => 'required|numeric|min:0|max:100000',
            'customer_id' => 'required',
        ]);

        $data = [
            'trans_id' => $request->trans_id,
            'product' => $request->product,
            'volume' => $request->volume,
            'amt' => $request->amt,
            'reward' => floor(AppHelper::makeReward((int) $request->amt)) ?? (int) $purchase->amt,
            'customer_id' => $request->customer_id,
            'created_by' => $request->user()->email,
        ];

        try {
            $purchase->update($data);
            return redirect()->route('purchase.index')->with('success', 'Update successfull');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function delete(Purchase $purchase): View
    {
        try {
            return view('purchase.delete', ['purchase' => $purchase]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Purchase $purchase): RedirectResponse
    {
        try {
            $purchase->update(['deleted_by' => $request->user()->email]);
            $purchase->delete();
            return redirect()->back()->with('success', 'delete successfull');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }
}