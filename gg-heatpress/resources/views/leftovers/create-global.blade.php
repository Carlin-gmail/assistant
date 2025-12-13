<x-layouts.app title="Add Leftover (Global)">

    {{-- PAGE HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Global Leftover
        </h2>
    </x-slot>

    {{-- PAGE CONTENT --}}
    <div class="container py-6 max-w-3xl">

        {{-- PAGE DESCRIPTION --}}
        <p class="text-sm text-gray-600 mb-6">
            !!! Do not use this page !!!
        </p>

        {{-- FORM CARD --}}
        <div class="bg-white shadow rounded-lg p-6">

            <x-form.form-with-file
                action="{{ route('leftovers.store-global') }}"
                has-files
                method="POST"
                class="space-y-5"
            >

                {{-- LEFTOVER NAME / TITLE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm"
                        placeholder="e.g. DTF Transfer – Black Logo"
                        required >
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- QUANTITY --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Quantity
                    </label>
                    <input
                        type="number"
                        name="quantity"
                        value="{{ old('quantity', 1) }}"
                        min="1"
                        class="w-full border-gray-300 rounded-md shadow-sm"
                        required
                    >
                    @error('quantity')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- OPTIONAL NOTES --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Notes (optional)
                    </label>
                    <textarea
                        name="notes"
                        rows="3"
                        class="w-full border-gray-300 rounded-md shadow-sm"
                        placeholder="Any useful information…"
                    >{{ old('notes') }}</textarea>
                </div>

                {{-- IMAGE UPLOAD --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Image (optional)
                    </label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700"
                    >
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTIONS --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a
                        href="{{ route('leftovers.index') }}"
                        class="px-4 py-2 text-sm text-gray-700 border rounded-md hover:bg-gray-100"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700"
                    >
                        Save Leftover
                    </button>
                </div>

            </x-form.form-with-file>

        </div>
    </div>

</x-layouts.app>
