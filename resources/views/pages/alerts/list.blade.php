<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">                
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-mv-alert-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Alerts">
                </div>
            </h3>
            <div class="card-toolbar">
                @can('create alert')
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_alert" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new Alert">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New Alert
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
    {{ theme()->getView('partials/modals/alerts/_add') }}
    <!--end::Modal - Add Alert-->
    <!--begin::Modal - Edit Alert -->
    {{ theme()->getView('partials/modals/alerts/_edit') }}
    <!--end::Modal dialog-->
    {{-- Inject Scripts --}}
    @section('scripts')
    {{ $dataTable->scripts() }}
    @include('pages.alerts._button-actions-js')
    @endsection
</x-base-layout>