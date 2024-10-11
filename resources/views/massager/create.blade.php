<x-app-layout>
    @section('head')
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('messenger.create') }}
    @endsection

    <form action="{{ route('messenger.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex align-items-stretch">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="card-title">Compose</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="message">Template id</label>
                            <select name="template_id" class="form-control @error('template_id') is-invalid @enderror">
                                <option value="">-- select --</option>
                                @foreach ($messageTemplates as $messageTemplate)
                                    <option value="{{ $messageTemplate->id }}"
                                        {{ old('template_id') == $messageTemplate->id ? 'selected' : '' }}>
                                        {{ $messageTemplate->template_id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('template_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            @error('ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="attachment">Attachment</label>
                            <input type="file" name="attachment" class="form-control" />
                        </div> --}}

                        <div class="responsive">
                            <table class="table table-strip" id="dataTable">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Customer</td>
                                        <td>Mobile</td>
                                        <td>Visit</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $key => $customer)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input customer-checkbox"
                                                    name="ids[]" value="{{ $customer->id }}">
                                            </td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->purchases_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>Selected Users: <span id="selectedCount">0</span></p>
                        </div>
                        <div class="border-top py-2">
                            <button type="submit" class="btn btn-primary px-4">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('script')
        <script>
            const selectAllCheckbox = document.getElementById('selectAll');
            const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
            const startFromInput = document.getElementById('start_from');
            const maxSelectionLimit = 50;

            // Handle manual selection limit
            customerCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedCount = document.querySelectorAll('.customer-checkbox:checked').length;

                    // If selection exceeds limit, uncheck the current one and show alert
                    if (selectedCount > maxSelectionLimit) {
                        this.checked = false;
                        alert(`You can only select a maximum of ${maxSelectionLimit} customers.`);
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('.customer-checkbox');
                const selectedCountDisplay = document.getElementById('selectedCount');

                function updateSelectedCount() {
                    const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
                    selectedCountDisplay.textContent = selectedCount;
                }

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectedCount);
                });
            });
        </script>

        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

        <script>
            $(function() {
                $('#dataTable').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-app-layout>
