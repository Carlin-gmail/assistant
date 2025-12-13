{{-- View --}}
<a href="{{ route("$viewName.show",  $model ) }}"
    class="btn btn-sm btn-outline-primary">
    View
</a>

{{-- Edit --}}
<a href="{{ route("$viewName.edit", $model) }}"
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
    <button class="btn btn-sm btn-danger">
        Delete
    </button>
</form>
