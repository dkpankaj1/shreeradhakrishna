<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('messenger.create') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3>Compose</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('messenger.store') }}" method="post">
                @csrf

            </form> --}}
            <h6>under development..</h6>
        </div>
    </div>
    @section('script')
    @endsection
</x-app-layout>
