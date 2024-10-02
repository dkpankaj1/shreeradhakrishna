<x-app-layout>

    @section('breadcrumb')
        {{ Breadcrumbs::render('purchase.index') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('purchase.create') }}" class="btn btn-primary">Create</a>
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
                        <th>Trean. ID</th>
                        <th>Name</th>
                        <th>Vehicle Number</th>
                        <th>Product</th>
                        <th>Volume</th>
                        <th>Sale AMT</th>
                        <th>Reward</th>
                        <th>Is Redeem</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($purchases) > 0)

                        @foreach ($purchases as $key => $purchase )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                {{-- <td>{{ $purchase->id }}</td> --}}
                                <td>{{ $purchase->trans_id }}</td>
                                <td>{{ $purchase->name }}</td>
                                <td>{{ $purchase->vehicle_number }}</td>
                                <td>{{ $purchase->product }}</td>
                                <td>{{ $purchase->volume }}</td>
                                <td>{{ $purchase->amt }}</td>
                                <td><span class="badge bg-info px-3 py-2">{{ $purchase->reward}}</span></td>
                                <td>{!! $purchase->isredeem ? '<span class="badge bg-danger px-3 py-2">redeem</span> ' : '<span class="badge bg-success px-3 py-2">Valid</span>' !!}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- <a href="{{ route('purchase.show', $purchase) }}" class="btn btn-warning" title="View"><i class="fas fa-eye"></i></a> --}}
                                        <a href="{{ route('purchase.edit', $purchase) }}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                        <button type="button" data-attr="{{route('purchase.delete',$purchase)}}" class="btn btn-danger d3l3t3btn" title="Delete"><i class="fas fa-trash-alt"></i></button>
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
            {{ $purchases->links() }}
        </div>
    </div>

    
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
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
