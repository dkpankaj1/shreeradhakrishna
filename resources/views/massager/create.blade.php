<x-app-layout>
    @section('head')
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('messenger.create') }}
    @endsection

    <div class="card h-100">
        <div class="card-header">
            <h3 class="card-title">Compose</h3>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Templete ID</th>
                            <th>Templete Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messageTemplates as $key => $messageTemplate)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $messageTemplate->template_id }}</td>
                                <td>{{ $messageTemplate->template }}</td>
                                <td><a href="{{ route('messenger.create', ['template_id' => $messageTemplate->template_id]) }}"
                                        class="btn btn-success">compose</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @section('script')
    @endsection
</x-app-layout>
