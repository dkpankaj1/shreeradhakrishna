<x-app-layout>

    @section('breadcrumb')
        {{ Breadcrumbs::render('customer.index') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('customer.create') }}" class="btn btn-primary">Create</a>
                    <a href="{{ route('customer.export') }}" class="btn text-success">Export</a>
                </div>
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                            value="{{ request()->search }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Card</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Vehicle Number</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Created At</th>
                        <th>Re Visit</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($customers) > 0)

                        @foreach ($customers as $customer)
                            <tr>
                                <td>#</td>
                                <td>{{ $customer->card }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->vehicle_number }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->state }}</td>
                                <td>{{ Carbon\Carbon::parse($customer->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $customer->purchases->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('purchase.create', ['customer' => $customer]) }}"
                                            class="btn btn-success" title="New Purchase"><i
                                                class="fas fa-plus-circle"></i></a>
                                        <a href="{{ route('customer.show', $customer) }}" class="btn btn-warning"
                                            title="View"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('customer.edit', $customer) }}" class="btn btn-info"
                                            title="Edit"><i class="fas fa-edit"></i></a>
                                        <button type="button" data-attr="{{ route('customer.delete', $customer) }}"
                                            class="btn btn-danger d3l3t3btn" title="Delete"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">No Record Found..</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $customers->links() }}
        </div>
    </div>


    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
        </script>
        <script>
            // confirm delete using bs model
            $(document).ready(function() {
                $("body").append(
                    '<div class="modal fade " id="modelHolder" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"></div></div>'
                )
            });
            $(document).on("click", ".d3l3t3btn", function(o) {
                o.preventDefault();
                let t = $(this).attr("data-attr");
                $.ajax({
                    url: t,
                    beforeSend: function() {
                        $.LoadingOverlay("show", {
                            image: "",
                            fontawesome: "fa fa-cog fa-spin"
                        })
                    },
                    success: function(o) {
                        $("#modelHolder").modal("show"), $("#modelHolder .modal-dialog").html(o).show()
                    },
                    complete: function() {
                        $.LoadingOverlay("hide")
                    },
                    error: function(o, e, n) {
                        console.log(n), $.LoadingOverlay("hide")
                    },
                    timeout: 8e3
                })
            });
        </script>
    @endsection
</x-app-layout>
