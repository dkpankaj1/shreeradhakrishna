<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('wa-template.edit', $waTemplate) }}
    @endsection

    <form action="{{ route('wa-template.update', $waTemplate) }}" method="POST">
        @csrf
        @method('put')
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">Edit Template</h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label class="form-label">Template ID</label>
                    <input type="text" class="form-control @error('template_id') is-invalid @enderror" name="template_id"
                        value="{{ old('template_id', $waTemplate->template_id) }}" placeholder="Enter template id">
                    @error('template_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Template</label>
                    <textarea name="template" class="form-control @error('template') is-invalid @enderror" cols="30" rows="10" placeholder="Enter template">{{ old('template', $waTemplate->template) }}</textarea>
                    @error('template')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Has Params</label>
                    <select class="form-control @error('has_param') is-invalid @enderror" name="has_param">
                        <option value="">-- select --</option>
                        <option value="1" {{ old('has_param', $waTemplate->has_param) == 1 ? 'selected' : '' }}>Yes
                        </option>
                        <option value="0" {{ old('has_param', $waTemplate->has_param) == 0 ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('has_param')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="border-top py-2">
                    <button type="submit" class="btn btn-primary px-4">Update Template</button>
                </div>

            </div>
        </div>
    </form>

    @section('script')
    @endsection
</x-app-layout>
