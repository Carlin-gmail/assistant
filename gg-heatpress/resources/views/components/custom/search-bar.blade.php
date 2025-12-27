<form method="GET" action="{{ $route }}" class="row g-2 align-items-end mb-3">
    <div class="col-md-4">
        <label class="form-label mb-1 d-none">Search</label>
        <input type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control rounded shadow-sm"
                placeholder="{{ $placeholder ?? 'Search...' }}"
                autofocus
                >
    </div>
    <div class="col-md-2 d-none">
        <button class="btn btn-secondary w-100">Apply</button>
    </div>
</form>
