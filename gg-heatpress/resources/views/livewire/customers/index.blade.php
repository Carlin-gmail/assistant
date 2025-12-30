<div>
    <label class="form-label mb-1 d-none">Search</label>
    <input type="text"
        name="search"
        value="{{ request('search') }}"
        class="form-control rounded shadow-sm"
        placeholder="{{ $placeholder ?? 'Search...' }}"
        autofocus

        wire:model.live="search"
        debounce="500"
        >
    @foreach ($customers as $customer)
        <x-custom.card cardHeader="{{ $customer->name }}">
            <div class="d-flex card-body" style="justify-content: space-between">
                {{-- ACCOUNT NUMBER --}}
                <p class="">
                    <b class="">Bag Number:</b> {{ $customer->account_number_accessor }}
                </p>

                <p>
                    <b>Bags:</b>
                    {{ $customer->bags_count ?? '—' }}
                </p>

                <p>
                    <b>Last Job:</b>
                    {{ $customer->last_job_at
                        ? $customer->last_job_at->format('Y-m-d')
                        : '—' }}
                </p>

            </div>

            {{-- CARD FOOTER --}}
            <div class="card-footer d-flex justify-content-end">
                {{-- NOTES --}}
                <p class="me-auto">
                    <b class="">Notes:</b> {{ \Illuminate\Support\Str::limit($customer->notes, 40) ?: '—' }}
                </p>
                <x-custom.action_buttons :model="$customer" viewName="customers"/>
            </div>

        </x-custom.card>
    @endforeach

</div>
