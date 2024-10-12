<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Redeem;
use App\Models\WaTemplate;
use App\Services\WhatsAppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Rap2hpoutre\FastExcel\FastExcel;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        try {

            $customer = Customer::query();

            #if isset search 
            if (request('search')) {
                $customer->where('name', 'Like', '%' . request('search') . '%')
                    ->orwhere('card', 'Like', '%' . request('search') . '%')
                    ->orwhere('vehicle_number', 'Like', '%' . request('search') . '%')
                    ->orwhere('phone', 'Like', '%' . request('search') . '%')
                    ->orwhere('city', 'Like', '%' . request('search') . '%');
            }

            $customers = $customer->with('purchases')->latest()->paginate(10);

            return view('customer.index', compact('customers'));
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
            return view('customer.create');
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
            'card_number'       => 'required|unique:customers,card',
            'name'              => 'required',
            'phone'             => 'required|digits:10',
            'vehicle'           => 'nullable|string',
            'city'              => 'nullable|string',
            'address'           => 'nullable|string',
            'state'             => 'nullable|string',
            'payment_method'    => 'required',
            'payment_detail'    => 'nullable|string',
        ]);

        $customer = [
            "card"              => $request->card_number,
            "name"              => $request->name,
            "phone"             => $request->phone,
            "vehicle_number"    => $request->vehicle,
            "city"              => $request->city,
            "address"           => $request->address,
            "state"             => $request->state,
            "payment_type"      => $request->payment_method,
            "payment_detail"    => $request->payment_detail,
            "created_by"        => $request->user()->email
        ];
        try {
            $customerData = Customer::create($customer);

            $template = WaTemplate::find(1);
            $whatsappService = new WhatsAppService();
            $whatsappService->sendNormalText($customerData->phone, $template->template_id);

            return redirect()->route('customer.index')->with('success', 'Customer create success!.');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer): View
    {
        try {
            $purchase_history = Purchase::where('customer_id',$customer->id)->latest()->take(50)->get();
            $reward = Purchase::where('customer_id', '=', $customer->id)->where('isredeem','=',0)->sum('reward');
            $redeem_history = Redeem::where('customer_id',$customer->id)->get();

            return view('customer.show', ['customer' => $customer,'purchase_history' => $purchase_history,'reward' => $reward,'redeem_history'=>$redeem_history]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer): View
    {
        try {
            return view('customer.edit', ['customer' => $customer]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer) : RedirectResponse
    {
        $request->validate([
            'card_number'       => 'required|unique:customers,card,'. $customer->id,
            'name'              => 'required',
            'phone'             => 'required',
            'vehicle'           => 'nullable|string',
            'city'              => 'nullable|string',
            'address'           => 'nullable|string',
            'state'             => 'nullable|string',
            'payment_method'    => 'required',
            'payment_detail'    => 'nullable|string',
        ]);

        $customerUpdate = [
            "card"              => $request->card_number ?? $customer->card,
            "name"              => $request->name ?? $customer->name,
            "phone"             => $request->phone ?? $customer->phone,
            "vehicle_number"    => $request->vehicle ?? $customer->vehicle_number,
            "city"              => $request->city ?? $customer->city,
            "address"           => $request->address ?? $customer->address,
            "state"             => $request->state ?? $customer->state,
            "payment_type"      => $request->payment_method ?? $customer->payment_type,
            "payment_detail"    => $request->payment_detail ?? $customer->payment_detail,
            "updated_by"        => $request->user()->email
        ];
        try {
            $customer->update($customerUpdate);
            return back()->with('success', 'Customer update successfull');
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
    public function delete(Customer $customer) : View
    {
        try {
            return view('customer.delete', ['customer' => $customer]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Customer $customer) :RedirectResponse
    {
        try {
            $customer->update(['deleted_by' => $request->user()->email]);
            $customer->messengers()->delete();
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Customer delete successfull');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }

    public function export()
    {
        $customersData = [];

        $customers = Customer::with('purchases')->get();

        foreach ($customers as $customer) {
            $data['id'] = $customer->id;
            $data['Card'] = $customer->card;
            $data['Name'] = $customer->name;
            $data['Phone'] = $customer->phone;
            $data['Vehicle'] = $customer->vehicle_number;
            $data['City'] = $customer->city;
            $data['State'] = $customer->state;
            $data['Created_At'] = Carbon::parse($customer->created_at)->format('d-m-Y');
            $data['VisitCount'] = $customer->purchases->count();
            $data['LastVisit'] = $customer->purchases->sortByDesc('created_at')->first() ? $customer->purchases->sortByDesc('created_at')->first()->created_at->format('d-m-Y') : 'N/A';

            $customersData[] = $data;
        }

        // Sort the data by 'VisitCount' instead of 'Re Visit'
        $customersData = collect($customersData)->sortByDesc('VisitCount')->values()->all();

        return (new FastExcel($customersData))->download('customers.xlsx');
    }
}