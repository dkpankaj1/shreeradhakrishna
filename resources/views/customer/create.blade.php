<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('customer.create') }}
    @endsection

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
            <h3 class="mb-1">Create New Customer</h3>
            <p class="text-muted mb-0">Fill in customer identity, location, and payment details.</p>
        </div>
        <div class="card-body pt-2">
            <form action="{{ route('customer.store') }}" method="post" class="pb-2">
                @csrf
                <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-4">
                    <h5 class="mb-0">Customer Information</h5>
                    <span class="badge bg-primary">Step 1</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input id="name" type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter full name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="card_number" class="form-label fw-semibold">Card Number</label>
                            <input id="card_number" type="text" name="card_number"
                                class="form-control @error('card_number') is-invalid @enderror"
                                placeholder="Enter card number" value="{{ old('card_number') }}">
                            @error('card_number')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="phone" class="form-label fw-semibold">Phone (without +91)</label>
                            <input id="phone" type="text" name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Enter phone number" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="vehicle" class="form-label fw-semibold">Vehicle Number</label>
                            <input id="vehicle" type="text" name="vehicle"
                                class="form-control @error('vehicle') is-invalid @enderror"
                                placeholder="Enter vehicle number" value="{{ old('vehicle') }}">
                            @error('vehicle')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="city" class="form-label fw-semibold">City</label>
                            <input id="city" type="text" name="city"
                                class="form-control @error('city') is-invalid @enderror"
                                placeholder="Enter city" value="{{ old('city') }}">
                            @error('city')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="state" class="form-label fw-semibold">State</label>
                            <input id="state" type="text" name="state"
                                class="form-control @error('state') is-invalid @enderror"
                                placeholder="Enter state" value="{{ old('state') }}">
                            @error('state')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group mb-0">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <textarea id="address" name="address" rows="3"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Enter complete address">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mt-4 mb-4">
                    <h5 class="mb-0">Payment Information</h5>
                    <span class="badge bg-info text-dark">Step 2</span>
                </div>

                <div class="row g-3 bg-light rounded-3 p-3">
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                            <select id="payment_method" class="form-control @error('payment_method') is-invalid @enderror"
                                name="payment_method">
                                <option value="">Select payment method</option>
                                <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Google Pay" {{ old('payment_method') == 'Google Pay' ? 'selected' : '' }}>Google Pay</option>
                                <option value="Phone Pay" {{ old('payment_method') == 'Phone Pay' ? 'selected' : '' }}>Phone Pay</option>
                                <option value="UPI" {{ old('payment_method') == 'UPI' ? 'selected' : '' }}>UPI</option>
                                <option value="AC" {{ old('payment_method') == 'AC' ? 'selected' : '' }}>AC</option>
                            </select>
                            @error('payment_method')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label for="payment_detail" class="form-label fw-semibold">Payment Detail</label>
                            <input id="payment_detail" type="text"
                                class="form-control @error('payment_detail') is-invalid @enderror" name="payment_detail"
                                placeholder="Enter payment detail" value="{{ old('payment_detail') }}">
                            @error('payment_detail')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <button class="btn btn-primary px-4">Save Customer</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
