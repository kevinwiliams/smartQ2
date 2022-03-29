<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                {{-- <span class="card-label fw-bolder fs-3 mb-1">Active Tokens </span>
                <span class="text-muted mt-1 fw-bold fs-7">Clients waiting: {{ $waiting }}</span> --}}
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-company-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Companies">
                </div>
            </h3>
            <div class="card-toolbar" >
               
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#kt_modal_add_company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new company">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New Company</a>
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
    <!--begin::Modal - Add Company -->
    {{ theme()->getView('partials/modals/company/_add') }}
    <!--end::Modal - Add Company-->   
    <!--begin::Modal - Edit Company -->
    <{{ theme()->getView('partials/modals/company/_edit') }}
    <!--end::Modal dialog-->
    {{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }} 
@endsection
</x-base-layout>
