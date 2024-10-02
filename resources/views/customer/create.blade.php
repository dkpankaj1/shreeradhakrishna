<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('customer.create') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3>Create new customer</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">FullName</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter fullname"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Card Number</label>
                            <input type="text" name="card_number" class="form-control" placeholder="Enter card number" value="{{ old('card_number') }}">
                            @error('card_number')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phonenumber"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Vehicle Number</label>
                            <input type="text" name="vehicle" class="form-control" placeholder="Enter vehicle number" value="{{ old('vehicle') }}">
                            @error('vehicle')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter city" value="{{ old('city') }}">
                            @error('city')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" placeholder="Enter State"
                                value="{{ old('state') }}">
                            @error('state')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea type="text" name="address" class="form-control" placeholder="Enter address"> {{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-control" name="payment_method">
                                <option value="">-- select --</option>
                                <option value="Cash" {{old('payment_method') == "Cash" ? "selected":""}}>Cash</option>
                                <option value="Google Pay" {{old('payment_method') == "Google Pay" ? "selected":""}}>Google pay</option>
                                <option value="Phone Pay" {{old('payment_method') == "Phone Pay" ? "selected":""}}>Phone Pay</option>
                                <option value="UPI" {{old('payment_method') == "UPI" ? "selected":""}}>UPI</option>
                                <option value="AC" {{old('payment_method') == "AC" ? "selected":""}}>AC</option>
                            </select>
                            @error('payment_method')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_detail" class="form-label">Payment Detail</label>
                            <input type="text" class="form-control" name="payment_detail"
                                placeholder="Enter payment detail" value="{{ old('payment_detail') }}">
                            @error('payment_detail')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-block btn-primary">Save</button>
                    </div>
                    <div class="col-md-3">
                        <input type="reset" class="btn btn-block btn-secondary" value="Reset" />
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
