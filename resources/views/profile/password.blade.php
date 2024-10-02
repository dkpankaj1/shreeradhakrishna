<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('password.update') }}
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Password</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">

                            @csrf
                            @method('patch')                            

                            <div class="form-group">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" class="form-control" name="old_password">
                                @error('old_password')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
