<x-app-layout>

    @section('breadcrumb')
        {{ Breadcrumbs::render('setting.reward.index') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3>Reward</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Price</th>
                        <th>Point</th>
                        <th>Alert Limit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $reward->price }}</td>
                        <td>{{ $reward->point }}</td>
                        <td>{{ $reward->alert_limit }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('setting.reward.edit', $reward) }}" class="btn btn-info"
                                    title="Edit"><i class="fas fa-edit"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

</x-app-layout>
