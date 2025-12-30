<x-layouts.app title="Transfer Types">

    {{-- Top of page --}}
    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><b class="">Transfer Types</b></h1>

            <x-custom.button
            btnName="+ New Transfer Type"
            href="{{ route('transfer-types.create') }}"
            btnColor="btn-primary"
            >
            </x-custom.button>

        </div>

        {{-- TABLE --}}
        <div class="">
            <div class="card-header">Available Transfer Types</div>

            <div class="card-body p-0">
                        @foreach ($transferTypes as $transferType)
                            <div class="mt-3">
                                <x-custom.card
                                    cardHeader="{{$transferType->name}}">

                                    <div class="card-body d-flex" style="justify-content: space-between">

                                        <div class="">
                                            <b>Fabric:</b>
                                            {{$transferType->fabric_type ?? '—'}}
                                        </div>

                                        <div class=""><b>Temp:</b> {{$transferType->temperature}}</div>
                                        <div class=""><b>Time:</b> {{ $transferType->press_time }}</div>
                                        <div class=""><b>Peel:</b> {{$transferType->peel_type}}</div>

                                        <div class="text-muted small mb-0">
                                            <b>Last Updated:</b> {{ $transferType->last_update ?? '—' }}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <x-custom.action_buttons
                                            viewName="transfer-types"
                                            :model="$transferType"
                                        />
                                    </div>
                                </x-custom.card>


                            </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    {{-- ========================================================= --}}
    {{-- NEW TRANSFER TYPE MODAL --}}
    {{-- ========================================================= --}}




</x-layouts.app>
