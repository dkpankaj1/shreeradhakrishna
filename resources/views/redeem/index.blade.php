<x-app-layout>

    @section('breadcrumb')
        {{ Breadcrumbs::render('redeem.index') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
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
                        <th>Customer</th>
                        <th>Card</th>
                        <th>Reward Amt</th>
                        <th>Reward Price</th>
                        <th>Redeem</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($redeems) > 0)

                        @foreach ($redeems as $key => $redeem)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $redeem->name }}</td>
                                <td>{{ $redeem->card }}</td>
                                <td>{{ $redeem->amt }}</td>
                                <td>{{ is_null($redeem->payment_detail) ? 'No Reward' : $redeem->payment_detail }}</td>
                                <td>{!! $redeem->status == 0
                                    ? '<span class="badge bg-warning px-3 py-2">Pending</span>'
                                    : '<span class="badge bg-success px-3 py-2">Success</span>' !!}</td>
                                <td>
                                    <div class="btn-group">

                                        <a href="{{ route('redeem.show', $redeem) }}" class="btn btn-warning"
                                            title="View"><i class="fas fa-eye"></i></a>
                                        @if ($redeem->status == 0)
                                            <a href="{{ route('redeem.payment', $redeem) }}" class="btn btn-info"
                                                title="Create Payment"><i class="fas fa-money-bill"></i></a>
                                        @else
                                        <a href="{{ route('redeem.payment.edit', $redeem) }}" class="btn btn-danger"
                                                title="Create Payment"><i class="fas fa-edit"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center">No Record Found..</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $redeems->links() }}
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
