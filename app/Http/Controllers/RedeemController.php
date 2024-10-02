<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Redeem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        try {

            $resources = Redeem::join('customers', 'customers.id', '=', 'redeems.customer_id')->select([
                'redeems.id',
                'redeems.amt',
                'redeems.payment_method',
                'redeems.payment_detail',
                'redeems.pay_amt',
                'redeems.status',
                'redeems.created_at',
                'customers.card',
                'customers.name',
            ])->latest('redeems.created_at');

            /** if isset search */
            if (request('search')) {
                $resources->where('customers.name', 'Like', '%' . request('search') . '%')
                    ->orwhere('customers.card', 'Like', '%' . request('search') . '%')
                    ->orwhere('redeems.trans_id', 'Like', '%' . request('search') . '%')
                    ->orwhere('redeems.amt', 'Like', '%' . request('search') . '%');
            }

            $redeems = $resources->paginate(10);

            return view('redeem.index', compact('redeems'));

        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Customer $customer): View
    {
        try {
            $purchase_history = Purchase::where('customer_id', $customer->id)->where('isredeem', 0)->get();
            $reward = Purchase::where('customer_id', '=', $customer->id)->where('isredeem', '=', 0)->sum('reward');

            return view('redeem.create', ['customer' => $customer, 'reward' => $reward, 'purchases' => $purchase_history]);
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
    public function store(Request $request, Customer $customer): RedirectResponse
    {

        $request->validate([
            "purchases" => "required|array|min:1",
        ], [
            'purchases.required' => 'Please select purchase.'
        ]);


        try {

            $redeem = Redeem::create([
                'amt' => Purchase::whereIn('id', $request->purchases)->sum('reward'),
                'customer_id' => $customer->id,
                'status' => 0,
                'created_by' => $request->user()->email
            ]);

            $redeem->purchases()->sync($request->purchases);

            Purchase::whereIn('id', $request->purchases)->update(['isredeem' => 1]);

            return redirect()->route('redeem.index')->with('success', 'Create successfull');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function show(Redeem $redeem): View
    {
        try {
            return view('redeem.show', ['redeem' => $redeem, 'purchases' => $redeem->purchases]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    public function create_payment(Redeem $redeem): View
    {
        // dd($redeem);
        try {
            return view('redeem.payment', ['redeem' => $redeem, 'purchases' => $redeem->purchases, 'customer' => $redeem->customer]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }
    public function store_payment(Request $request, Redeem $redeem): RedirectResponse
    {
        $request->validate([
            'reward_detail' => 'required|string',
        ]);

        $data = [
            'trans_id' => $request->trans_id,
            'payment_method' => $request->payment_method ?? "NaN",
            'payment_detail' => $request->reward_detail,
            'pay_amt' => $request->pay_amt ?? 0,
            'status' =>  1,
            'updated_by' => $request->user()->email
        ];

        try {
            $redeem->update($data);
            return redirect()->route('redeem.index')->with('success', 'Payment successfull');
        } catch (\Exception $e) {
            return redirect()->route('redeem.index')->with('error', $e->getMessage());
        }
    }

    public function edit_payment(Redeem $redeem)
    {
         // dd($redeem);
         try {
            return view('redeem.payment_edit', ['redeem' => $redeem, 'purchases' => $redeem->purchases, 'customer' => $redeem->customer]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }
    public function update_payment(Request $request, Redeem $redeem): RedirectResponse
    {
        $request->validate([
            'reward_detail' => 'required|string',
        ]);

        $data = [
            'trans_id' => $request->trans_id,
            'payment_method' => $request->payment_method ?? "NaN",
            'payment_detail' => $request->reward_detail,
            'pay_amt' => $request->pay_amt ?? 0,
            'status' =>  1,
            'updated_by' => $request->user()->email
        ];

        try {
            $redeem->update($data);
            return redirect()->route('redeem.index')->with('success', 'Payment successfull');
        } catch (\Exception $e) {
            return redirect()->route('redeem.index')->with('error', $e->getMessage());
        }
    }



}