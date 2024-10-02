<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('redeem.create', $customer) }}
    @endsection


    <div class="row">
        <div class="col-md-12">
            <!-- Profile Image -->
            <div class="card ">
                <div class="card-header">
                    <h3>Create Redeem</h3>
                </div>

                <div class="card-body box-profile">

                    <h3 class="profile-username text-left">{{ $customer->name }}</h3>
                    <h5 class="text-muted text-left">{{ $customer->card }}</h5>
                    <h4 class="text-left">Reward Point : <span class="text-success">{{ $reward }}</span></h4>

                    <hr>
                    <form action="{{ route('redeem.store', $customer) }}" method="post">
                        @csrf
                        <div class="w-100">
                            @error('purchases')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" name="select_all_purchase" id="select_all_purchase">
                                        </th>
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
                                                <td class="text-center"> <input type="checkbox" name="purchases[]"
                                                        id="all" value="{{ $purchase->id }}"></td>
                                                <td>{{ $purchase->created_at }}</td>
                                                <td>{{ $purchase->trans_id }}</td>
                                                <td>{{ $purchase->product }}</td>
                                                <td>{{ $purchase->volume }}</td>
                                                <td>{{ $purchase->amt }}</td>
                                                <td><span
                                                        class="badge bg-info px-3 py-2">{{ $purchase->reward }}</span>
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

                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary">Create</button>
                                <input type="reset" class="btn btn-secondary" value="Reset" />
                            </div>
                        </div>

                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function() {
                $("#select_all_purchase").change(function() {
                    if (this.checked) {
                        $("input[name='purchases[]']").each(function() {
                            this.checked = true;
                        });
                    } else {
                        $("input[name='purchases[]']").each(function() {
                            this.checked = false;
                        });
                    }
                });
            });
        </script>
    @endsection

</x-app-layout>
