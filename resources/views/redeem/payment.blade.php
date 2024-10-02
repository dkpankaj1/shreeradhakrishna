<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('redeem.payment', $redeem) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3>Add Reward Detail</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Card</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Vehicle Number</th>
                                <th>City</th>
                                <th>State</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $customer->card }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->vehicle_number }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->state }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <form action="{{ route('redeem.payment.store', $redeem) }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Amount</label>
                            <input type="text" name="amt" class="form-control" placeholder="Amount" value="{{ old('amt',$redeem->amt) }}" disabled>
                            @error('amt')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reward_detail" class="form-label">Reward Detail</label>
                            <input type="text" class="form-control" name="reward_detail"
                                placeholder="Enter reward detail" value="{{ old('reward_detail') }}">
                            @error('reward_detail')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <hr>
                <div >
                    <button class="btn  px-4 btn-primary">Save</button>
                    <input type="reset" class="btn  px-4 btn-secondary" value="Reset" />
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
