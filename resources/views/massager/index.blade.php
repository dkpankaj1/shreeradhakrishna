<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('messenger.index') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Messenger</h3>
            <div class="card-tools">
                <a href="{{ route('messenger.create') }}" class="btn btn-success">Compose</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Mobile</th>
                            <th>Template</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messengers as $key => $msg)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $msg->customer->name }}</td>
                                <td>{{ $msg->customer->phone }}</td>
                                <td>{{ $msg->waTemplate->template_id }}</td>
                                <td>{{ $msg->status === 0 ? 'Failed' : 'Success' }}</td>
                                <td>{{ $msg->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Redord Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $messengers->links() }}
        </div>
    </div>
    @section('script')
    @endsection
</x-app-layout>
