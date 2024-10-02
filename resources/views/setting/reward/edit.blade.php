<x-app-layout>
    @section('breadcrumb')
        {{-- {{ Breadcrumbs::render('setting.reward.edit',$reward) }} --}}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3>Update Reward Point</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('setting.reward.update', $reward) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter Price"
                                value="{{ old('price', $reward->price) }}">
                            @error('price')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Point</label>
                            <input type="text" name="point" class="form-control"
                                placeholder="Enter point" value="{{ old('point', $reward->point) }}">
                            @error('point')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-100"></div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Alert Point</label>
                            <input type="text" name="alert_limit" class="form-control"
                                placeholder="Enter Alert Limit" value="{{ old('alert_limit', $reward->alert_limit) }}">
                            @error('alert_limit')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-block btn-primary">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
