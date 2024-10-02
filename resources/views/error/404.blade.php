<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('error.404') }}
    @endsection

    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! not found.</h3>
            <p>something went wrong</p>
            <p>
                {{$error}}
            </p>

        </div>
        <!-- /.error-content -->
    </div>
</x-app-layout>
