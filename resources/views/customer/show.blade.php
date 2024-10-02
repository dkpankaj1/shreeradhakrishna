<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('customer.show', $customer) }}
    @endsection

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">{{ $customer->name }}</h3>
                            <h5 class="text-muted text-center">{{ $customer->card }}</h5>
                            <h4 class="text-center">Reward Point : <span class="text-success">{{ $reward }}</span>
                            </h4>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $customer->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Vehicle Number</b> <a class="float-right">{{ $customer->vehicle_number }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Paymnt Method</b> <a class="float-right">{{ $customer->payment_type }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Payment Detail</b> <a class="float-right">{{ $customer->payment_detail }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{ $customer->address }},
                                        {{ $customer->city }}, {{ $customer->state }}</a>
                                </li>
                            </ul>

                            <a href="{{ route('customer.edit', $customer) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('redeem.create', $customer) }}" class="btn btn-success">Redeem</a>
                            <a href="{{ route('purchase.create', ['customer' => $customer]) }}"
                                class="btn btn-primary">Add Purchase</a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#purchase"
                                        data-toggle="tab">Purchase History</a></li>
                                <li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab">Redeem
                                        History</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!--Begin::activity panel-->
                                <div class="active tab-pane table-responsive" id="purchase">
                                    <table class="table table-sm">

                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Trean. ID</th>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Volume</th>
                                                <th>Sale AMT</th>
                                                <th>Reward</th>
                                                <th>Is Redeem</th>
                                                <th style="width: 40px">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($purchase_history) > 0)
                                                @foreach ($purchase_history as $key => $purchase)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        {{-- <td>{{ $purchase->id }}</td> --}}
                                                        <td>{{ $purchase->trans_id }}</td>
                                                        <td>{{ $purchase->created_at->diffForHumans() }}</td>
                                                        <td>{{ $purchase->product }}</td>
                                                        <td>{{ $purchase->volume }}</td>
                                                        <td>{{ $purchase->amt }}</td>
                                                        <td><span
                                                                class="badge bg-info px-3 py-2">{{ $purchase->reward }}</span>
                                                        </td>
                                                        <td>{!! $purchase->isredeem
                                                            ? '<span class="badge bg-success px-3 py-2">redeem</span> '
                                                            : '<span class="badge bg-info px-3 py-2">valid</span>' !!}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                {{-- <a href="{{ route('purchase.show', $purchase) }}" class="btn btn-warning" title="View"><i class="fas fa-eye"></i></a> --}}
                                                                <a href="{{ route('purchase.edit', $purchase) }}"
                                                                    class="btn btn-info" title="Edit"><i
                                                                        class="fas fa-edit"></i></a>
                                                                <button type="button"
                                                                    data-attr="{{ route('purchase.delete', $purchase) }}"
                                                                    class="btn btn-danger d3l3t3btn" title="Delete"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8">No Purchase History..</td>
                                                </tr>

                                            @endif


                                        </tbody>

                                    </table>
                                </div>
                                <!--end::activity panel-->
                                <!--Begin::purchase panel-->
                                <div class="tab-pane table-responsive" id="payment">
                                    <table class="table table-sm">

                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Amt</th>
                                                <th>Reward Detail</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($redeem_history) > 0)
                                                @foreach ($redeem_history as $key => $redeem)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $redeem->amt }}</td>
                                                        <td>{{ is_null($redeem->payment_detail) ? "no reward" : $redeem->payment_detail }}</td>
                                                        <td>{{ $redeem->updated_at }}</td>
                                                        <td>{!! $redeem->status == 0 ?'<span class="badge bg-warning px-3 py-2">Pending</span>' :'<span class="badge bg-success px-3 py-2">Success</span>' !!}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8">No History..</td>
                                                </tr>

                                            @endif


                                        </tbody>

                                    </table>
                                </div>
                                <!--end::purchase panel-->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

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
