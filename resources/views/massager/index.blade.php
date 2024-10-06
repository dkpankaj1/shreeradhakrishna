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
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Send From</th>
                            <th>Send To</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messengers as $key => $msg)
                            <tr>{{ $key + 1 }}</tr>
                            <tr>{{ $msg->send_from }}</tr>
                            <tr>{{ $msg->send_to }}</tr>
                            <tr>{{ $msg->created_at }}</tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Redord Found</td>
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
