<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-mv-scheduledreports-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Scheduled Reports">
                </div>
            </h3>

            <div class="card-toolbar">
                {{-- @can('create scheduled report') --}}
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_scheduledreport" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new scheduled report">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New Scheduled Report
                </a>
                {{-- @endcan --}}
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
    <!--begin::Modal - View History -->
    {{ theme()->getView('partials/modals/scheduledreports/_history') }}
    <!--end::Modal - View History-->

    <!--begin::Modal - View Schedule -->
    {{ theme()->getView('partials/modals/scheduledreports/_schedule') }}
    <!--end::Modal - View Schedule-->

    <!--begin::Modal - Add Schedule -->
    {{ theme()->getView('partials/modals/scheduledreports/_add', array('locations' => $locations)) }}
    <!--end::Modal - Add Schedule-->
    <!--begin::Modal - Add Schedule -->
    {{ theme()->getView('partials/modals/scheduledreports/_edit', array('locations' => $locations)) }}
    <!--end::Modal - Add Schedule-->
    <link rel="stylesheet" href="{{ asset('demo1/plugins/custom/flatpickr/flatpickr.bundle.css') }}">

    {{-- Inject Scripts --}}
    @section('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('demo1/plugins/custom/flatpickr/flatpickr.bundle.js') }}" type="application/javascript"></script>
    @include('pages.scheduledreports._action-active-js')
    @include('pages.scheduledreports._button-actions-js')
    @include('pages.scheduledreports._add-scheduledreport-js')    
    @include('pages.scheduledreports._edit-scheduledreport-js')   
    @endsection
</x-base-layout>