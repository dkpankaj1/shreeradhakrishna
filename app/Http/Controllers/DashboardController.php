<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Purchase;
use App\Services\BhashSmsService;
use App\Services\WhatsAppService;
use DB;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\RewardSetting;

class DashboardController extends Controller
{
    public function index()
    {
        /** ------------- sale data -------------- */
        $sales = Purchase::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('sum(amt) as amt'),
        )
            ->where(DB::raw('date(created_at)'), '>=', (string) date('Y') . "-01-01")
            ->groupBy('year')
            ->groupBy('month')
            ->get()
            ->toArray();

        $data = (array) [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($sales as $sale) {
            $data[$sale['month']] = $sale['amt'];
        }

        /** ------------- reward data -------------- */

        $customers = Customer::latest()->take(5)->get();
        $r = DB::table('customers')
            ->where('purchases.isredeem', '=', "0")
            ->where('purchases.deleted_at', '=', null)
            ->select('customers.id as customer_id', 'customers.name', 'customers.vehicle_number', 'customers.phone', DB::raw('sum(purchases.reward) as rewards'))
            ->join('purchases', 'customers.id', '=', 'purchases.customer_id')
            ->groupBy(['customers.id', 'customers.name', 'customers.vehicle_number', 'customers.phone'])
            ->take(5)
            ->orderBy('rewards', 'DESC')
            ->get();

        $smsBalance = WhatsAppService::checkWABalance();
        return view('dashboard', [
            'customers' => Customer::latest()->take(5)->get(),
            'rewards' => $r,
            'saledata' => $data,
            "smsBalance" => $smsBalance
        ]);
    }

    public function exportTopReworderCustomer()
    {
        $r = DB::table('customers')
            ->where('purchases.isredeem', '=', "0")
            ->where('purchases.deleted_at', '=', null)
            ->select('customers.id as customer_id', 'customers.name', 'customers.vehicle_number', 'customers.phone', DB::raw('sum(purchases.reward) as rewards'))
            ->join('purchases', 'customers.id', '=', 'purchases.customer_id')
            ->groupBy(['customers.id', 'customers.name', 'customers.vehicle_number', 'customers.phone'])
            // ->take(5)
            ->orderBy('rewards', 'DESC')
            ->get();

        $rs = RewardSetting::first();

        $topReword = [];

        foreach ($r as $row) {
            if ($rs->alert_limit <= $row->rewards) {
                $data['Id'] = $row->customer_id;
                $data['Name'] = $row->name;
                $data['Vehicle Number'] = $row->vehicle_number;
                $data['Phone'] = $row->phone;
                $data['Reward'] = $row->rewards;
                $topReword[] = $data;
            }
        }


        return (new FastExcel($topReword))->download('customerreword.xlsx');
    }
}