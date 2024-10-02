<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('redeem.show', $redeem) }}
    @endsection


    <div class="row">
        <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card ">
                <div class="card-header">
                    <h3>Purchase Detail</h3>
                </div>

                <div class="card-body box-profile">

                    <hr>
                    <div class="w-100">
                        @error('purchases')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <!--<th class="text-center">ID</th>-->
                                    <th class="text-center">#</th>
                                    <th>Date</th>
                                    <th>Trans ID</th>
                                    <th>Product</th>
                                    <th>Volume</th>
                                    <th>Amt</th>
                                    <th>Reward</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($purchases) > 0)

                                    @foreach ($purchases as $key => $purchase)
                                        <tr>
                                            <!--<td class="text-center">{{ $purchase->id }}</td>-->
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $purchase->created_at }}</td>
                                            <td>{{ $purchase->trans_id }}</td>
                                            <td>{{ $purchase->product }}</td>
                                            <td>{{ $purchase->volume }}</td>
                                            <td>{{ $purchase->amt }}</td>
                                            <td><span class="badge bg-info px-3 py-2">{{ $purchase->reward }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No Record Found..</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Profile Image -->
            <div class="card ">
                <div class="card-header">
                    <h3>Reward Detail</h3>
                </div>

                <div class="card-body box-profile">

                    <div class="w-100">

                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{$redeem->id}}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{$redeem->created_at}}</td>
                            </tr>
                            <tr>
                                <th>Reward Amount</th>
                                <td>{{$redeem->amt}}</td>
                            </tr>
                            <tr>
                                <th>Reward Detail</th>
                                <td>{{ $redeem->payment_detail }}</td>
                            </tr>
                            <tr>
                                <th>Reward Status</th>
                                <td>{!! $redeem->status == 0 ?'<span class="badge bg-warning px-3 py-2">Pending</span>' :'<span class="badge bg-success px-3 py-2">Success</span>' !!}</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>
    </div>

</x-app-layout>
