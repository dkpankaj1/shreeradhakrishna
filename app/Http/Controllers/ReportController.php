<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportController extends Controller
{
    /**
     * Build a base query for inactive customers.
     * Inactive = last purchase was before $inactiveSince date (or no purchases at all).
     */
    private function inactiveQuery(Request $request)
    {
        $days = max(1, (int) $request->input('days', 90));
        $cutoff = Carbon::now()->subDays($days)->endOfDay();

        $search = $request->search;

        return Customer::query()
            ->withCount('purchases')
            ->withMax('purchases', 'created_at')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', '%' . $search . '%')
                        ->orWhere('card', 'like', '%' . $search . '%')
                        ->orWhere('vehicle_number', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('city', 'like', '%' . $search . '%');
                });
            })
            ->whereDoesntHave('purchases', function ($query) use ($cutoff) {
                $query->where('created_at', '>', $cutoff);
            })
            ->orderBy('purchases_max_created_at', 'asc');
    }

    /**
     * Display inactive customers report.
     */
    public function inactiveCustomers(Request $request): View
    {
        try {
            $days = max(1, (int) $request->input('days', 90));

            $customers = $this->inactiveQuery($request)->paginate(15);
            $customers->appends($request->query());

            return view('report.inactive-customers', [
                'customers' => $customers,
                'days'      => $days,
                'total'     => $customers->total(),
            ]);
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Export inactive customers to Excel.
     */
    public function inactiveCustomersExport(Request $request)
    {
        try {
            $days = max(1, (int) $request->input('days', 90));

            $customers = $this->inactiveQuery($request)->get();

            $rows = $customers->map(function ($customer) {
                $lastVisit = $customer->purchases_max_created_at
                    ? Carbon::parse($customer->purchases_max_created_at)->format('d-m-Y')
                    : 'Never';

                $daysSince = $customer->purchases_max_created_at
                    ? Carbon::parse($customer->purchases_max_created_at)->diffInDays(now())
                    : 'N/A';

                return [
                    'Card'            => $customer->card,
                    'Name'            => $customer->name,
                    'Phone'           => $customer->phone,
                    'Vehicle'         => $customer->vehicle_number ?? '',
                    'City'            => $customer->city ?? '',
                    'State'           => $customer->state ?? '',
                    'Last Visit'      => $lastVisit,
                    'Days Since Visit' => $daysSince,
                    'Visit Count'     => $customer->purchases_count,
                ];
            });

            $filename = 'inactive-customers-last-' . $days . '-days.xlsx';

            return (new FastExcel($rows))->download($filename);
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }
}
