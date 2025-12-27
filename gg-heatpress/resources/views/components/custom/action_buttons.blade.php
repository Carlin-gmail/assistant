{{-- View --}}
<div class="d-flex gap-1">
    <a href="{{ route("$viewName.show",  $model ) }}"
    style="width:4rem; padding:1px;"
    class="btn btn-sm btn-primary">
    View
</a>

{{-- Edit --}}
<a href="{{ route("$viewName.edit", $model) }}"
    style="width:4rem; padding:1px;"
    class="btn btn-sm btn-warning">
    Edit
</a>

{{-- Delete --}}
<form action="{{ route("$viewName.destroy", $model) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('Delete this customer and all related bags/leftovers?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger"
        style="width:4rem; padding:1px;">
        Delete
    </button>
</form>
</div>
