{{-- @props([$hasFiles='true', $action='#', $method='POST']) --}}
<form
    action="{{ $action }}"
    method="{{ $method }}"
    {{ $attributes }}
>
    @csrf
    @method($method)

    {{ $slot }}
</form>

{{-- How to use the component: --}}

{{--
    <x-form.form-with-file
    action="{{-- route('route') }}"
    method="POST"
    has-files >
        <input type="file" name="file">
        <button>Upload</button>
    </x-form.form-with-file>
--}}
