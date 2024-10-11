<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('wa-template.index') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">WA Template</h3>
            <div class="card-tools">
                <a href="{{ route('wa-template.create') }}" class="btn btn-success">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tamplate Id</th>
                            <th>Template</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($waTemplates as $key => $waTemplate)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $waTemplate->template_id }}</td>
                                <td>{{ $waTemplate->template }}</td>
                                <td>{{ $waTemplate->created_at }}</td>
                                <td>{{ $waTemplate->approve === 1 ? 'Approved' : 'Pending' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('wa-template.edit', $waTemplate->id) }}">Edit</a>
                                        &nbsp;
                                        <div>
                                            <form action="{{ route('wa-template.destroy', $waTemplate->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Redord Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @section('script')
    @endsection
</x-app-layout>
