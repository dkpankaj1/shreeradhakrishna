<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('purchase.create') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3>Create new Purchase</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('purchase.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <select class="form-control select2" style="width: 100%;" name="customer_id">
                                <option value=""> -- select --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{old('customer_id', request()->customer) == $customer->id ? "selected":"" }}>{{ $customer->name }} | {{ $customer->card }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Trans. Id</label>
                            <input type="text" name="trans_id" class="form-control" placeholder="Enter Trans. ID"
                                value="{{ old('trans_id') }}">
                            @error('trans_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_method" class="form-label">Product</label>
                            <select class="form-control" name="product">
                                <option value="">-- select --</option>
                                <option value="Diesel" {{ old('product') == 'Diesel' ? 'selected' : '' }}>Diesel
                                </option>
                                <option value="Petrol" {{ old('product') == 'Petrol' ? 'selected' : '' }}>Petrol
                                </option>
                                <option value="CNG" {{ old('product') == 'CNG' ? 'selected' : '' }}>CNG </option>
                            </select>
                            @error('product')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Volume</label>
                            <input type="text" name="volume" class="form-control" placeholder="1000 L"
                                value="{{ old('volume') }}">
                            @error('volume')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Sale Amount</label>
                            <input type="number" name="amt" class="form-control" placeholder="10000"
                                value="{{ old('amt') }}">
                            @error('amt')
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
    @section('script')
        <script>
            $('.select2').select2()
        </script>
    @endsection
</x-app-layout>
