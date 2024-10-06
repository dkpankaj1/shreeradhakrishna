<x-app-layout>
    @section('breadcrumb')
        {{ Breadcrumbs::render('messenger.create') }}
    @endsection

    <form action="{{ route('messenger.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex align-items-stretch">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="card-title">Customer</h3>
                    </div>
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                    <label class="form-check-label" for="selectAll">Select All (Max 100)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" id="start_from" class="form-control" value="1" min="1"
                                    max="{{ count($customers) }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="px-1" style="height: 360px; overflow-y: scroll;">
                            <ul class="nav nav-pills flex-column">
                                @foreach ($customers as $key => $customer)
                                    <li class="nav-item">
                                        <div class="form-check nav-link">
                                            <input type="checkbox" class="form-check-input customer-checkbox"
                                                name="ids[]" value="{{ $customer->id }}">
                                            <label class="form-check-label" for="customer-{{ $customer->id }}">
                                                {{ $key + 1 }} - {{ $customer->name }}
                                                ({{ $customer->purchases_count }})
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            @error('ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="card-title">Compose</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" cols="30" rows="10">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="attachment">Attachment</label>
                            <input type="file" name="attachment" class="form-control" />
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
            const maxSelectionLimit = 100;

            // Handle 'Select All' checkbox functionality
            selectAllCheckbox.addEventListener('change', function() {
                const startFrom = parseInt(startFromInput.value) - 1; // Convert to zero-based index
                if (this.checked) {
                    let selectedCount = 0;
                    customerCheckboxes.forEach((checkbox, index) => {
                        if (index >= startFrom && selectedCount < maxSelectionLimit) {
                            checkbox.checked = true;
                            selectedCount++;
                        } else {
                            checkbox.checked = false;
                        }
                    });
                    if (selectedCount >= maxSelectionLimit) {
                        alert(`You have selected the maximum of ${maxSelectionLimit} customers.`);
                    }
                } else {
                    // Uncheck all if 'Select All' is unchecked
                    customerCheckboxes.forEach(checkbox => checkbox.checked = false);
                }
            });

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
        </script>
    @endsection
</x-app-layout>
