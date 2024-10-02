<x-delete-confirm :route="route('purchase.destroy', $purchase->id)">
    <h5 class="text-center">Are you sure you want to delete <span class="text-danger">{{ $purchase->trans_id }} </span> ?</h5>
</x-delete-confirm>
