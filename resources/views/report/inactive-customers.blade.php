<x-app-layout>

    @section('breadcrumb')
        {{ Breadcrumbs::render('report.inactive-customers') }}
    @endsection

    {{-- Filter Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                <div>
                    <h5 class="mb-1 fw-bold">Inactive Customers Report</h5>
                    <p class="text-muted mb-0 small">Customers whose last visit (purchase) was before the selected date.</p>
                </div>
                <span class="badge bg-warning text-dark px-3 py-2" style="font-size:0.85rem;">
                    <i class="fas fa-user-clock mr-1"></i> Inactive Report
                </span>
            </div>

            <form method="get" id="filterForm">

                {{-- Row 1: inputs --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="days" class="form-label fw-semibold mb-1">
                            <i class="fas fa-clock text-primary mr-1"></i> Not Visited Since (Days)
                        </label>
                        <input type="number" id="days" name="days" min="1"
                            class="form-control"
                            value="{{ request('days', $days) }}"
                            placeholder="e.g. 90">
                    </div>
                    <div class="col-md-8">
                        <label for="search" class="form-label fw-semibold mb-1">
                            <i class="fas fa-search text-primary mr-1"></i> Search Customer
                        </label>
                        <input type="text" id="search" name="search" class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search by name, card, phone, vehicle or city…">
                    </div>
                </div>

                {{-- Row 2: presets left, actions right --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:8px;">

                    {{-- Quick-select presets --}}
                    <div class="d-flex align-items-center flex-wrap" style="gap:6px;">
                        <small class="text-muted font-weight-bold mr-1">Quick:</small>
                        @foreach ([30, 60, 90, 180, 365] as $preset)
                            <a href="?days={{ $preset }}&search={{ request('search') }}"
                               class="btn btn-sm {{ (int) request('days', $days) === $preset ? 'btn-primary' : 'btn-outline-secondary' }}">
                                {{ $preset }} days
                            </a>
                        @endforeach
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex" style="gap:8px;">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-filter mr-1"></i> Apply Filter
                        </button>
                        <a href="{{ route('report.inactive-customers') }}"
                           class="btn btn-light border px-3" title="Clear filters">
                            <i class="fas fa-times mr-1"></i> Clear
                        </a>
                        <a href="{{ route('report.inactive-customers.export', request()->query()) }}"
                           class="btn btn-success px-4" title="Download Excel">
                            <i class="fas fa-file-excel mr-1"></i> Download Excel
                        </a>
                    </div>

                </div>

            </form>
        </div>
    </div>

    {{-- Results Card --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <span class="font-weight-bold">{{ $total }}</span>
            <span class="text-muted"> inactive customer(s) found — no visit in the last
                <strong class="text-danger">{{ $days }} days</strong>
            </span>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Card</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Vehicle</th>
                        <th>City</th>
                        <th>Last Visit</th>
                        <th>Days Since Visit</th>
                        <th>Visit Count</th>
                        <th style="width: 60px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $i => $customer)
                        <tr>
                            <td>{{ $customers->firstItem() + $i }}</td>
                            <td>{{ $customer->card }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->vehicle_number ?? '—' }}</td>
                            <td>{{ $customer->city ?? '—' }}</td>
                            <td>
                                @if ($customer->purchases_max_created_at)
                                    {{ \Carbon\Carbon::parse($customer->purchases_max_created_at)->format('d-m-Y') }}
                                @else
                                    <span class="badge badge-secondary">Never</span>
                                @endif
                            </td>
                            <td>
                                @if ($customer->purchases_max_created_at)
                                    {{ \Carbon\Carbon::parse($customer->purchases_max_created_at)->diffInDays(now()) }} days
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $customer->purchases_count }}</td>
                            <td>
                                <a href="{{ route('customer.show', $customer) }}"
                                   class="btn btn-warning btn-sm" title="View Customer">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">
                                No inactive customers found for the selected criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $customers->links() }}
        </div>
    </div>

</x-app-layout>
