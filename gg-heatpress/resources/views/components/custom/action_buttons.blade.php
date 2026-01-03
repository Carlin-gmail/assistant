    {{-- View --}}
<div class="d-flex">
    <a href="{{ route("$viewName.show",  $model ) }}"
        style="width:4rem; padding:1px;"
        class="btn btn-sm btn-primary m-1">
        View
    </a>

    {{-- Edit --}}
    <a href="{{ route("$viewName.edit", $model) }}"
        style="width:4rem; padding:1px;"
        class="btn btn-sm btn-warning m-1">
        Edit
    </a>

    {{-- Delete --}}
    <form action="{{ route("$viewName.destroy", $model) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('Are you sure you want to delete it?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger m-1"
            style="width:4rem; padding:1px;">
            Delete
        </button>
    </form>
</div>
