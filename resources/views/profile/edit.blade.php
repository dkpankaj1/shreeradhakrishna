<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('profile.update') }}
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Profile</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                                @error('name')
                                <span class="invalid-feedback d-block">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{old('email',$user->email)}}">
                                @error('email')
                                <span class="invalid-feedback d-block">{{$message}}</span>
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
