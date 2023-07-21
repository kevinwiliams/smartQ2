<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-mv-viplist-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Clients">
                </div>
            </h3>
            <div class="card-toolbar">
                @can('choose location')

                <div class="my-1 me-4">
                    <!--begin::Select-->
                    <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Location" tabindex="-1" aria-hidden="true" name="location" id="location">
                        @foreach($locations as $_location)
                        @php
                        $url = $_SERVER['REQUEST_URI'];
                        $parts = explode('/', $url);
                        $id = end($parts);

                        if($id == 'list'){
                        $id == auth()->user()->location_id;
                        }
                        @endphp
                        <option value="{{ $_location->id }}" {{ ($_location->id == $id)?'selected':'' }}>{{ $_location->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select-->

                </div>
                @else
                <input type="hidden" name="location" id="location" value="{{ auth()->user()->location_id }}" />
                @endif
                @can('create alert')
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_viplist" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new VIP">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New VIP
                </a>
                @endcan
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!--begin::Modal - Add Alert -->
    {{ theme()->getView('partials/modals/viplist/_add', array('locations' => $locations)) }}
    <!--end::Modal - Add Alert-->
    <!--begin::Modal - Edit Alert -->
    {{ theme()->getView('partials/modals/viplist/_edit', array('locations' => $locations)) }}
    <!--end::Modal dialog-->
    {{-- Inject Scripts --}}
    @section('scripts')
    {{ $dataTable->scripts() }}
    @include('pages.viplist._button-actions-js')

    <script>
        $(document).ready(function() {

            $("#location").on('change', function() {
                var id = $(this).val();
                var url = "/viplist/list/" + id;

                location.href = url;
            });
        });
    </script>
    @endsection
</x-base-layout>