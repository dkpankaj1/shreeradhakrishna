<x-delete-confirm :route="route('customer.destroy', $customer->id)">
    <h5 class="text-center">Are you sure you want to delete <span class="text-danger">{{ $customer->name }} </span> ?</h5>
</x-delete-confirm>
