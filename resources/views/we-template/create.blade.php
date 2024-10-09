<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('wa-template.create') }}
    @endsection

    <form action="{{ route('wa-template.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">Add Template</h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label class="form-label">Template ID</label>
                    <input type="text" class="form-control" name="template_id" value="{{ old('template_id') }}" placeholder="Enter template id">
                    @error('template_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Template</label>
                    <textarea name="template" class="form-control" cols="30" rows="10" placeholder="Enter template">{{ old('template') }}</textarea>
                    @error('template')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="border-top py-2">
                    <button type="submit" class="btn btn-primary px-4">Add Template</button>
                </div>

            </div>
        </div>
    </form>

    @section('script')
    @endsection
</x-app-layout>
