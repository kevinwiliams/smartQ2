<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}
            <div class="row g-6 g-xl-9" data-sticky-container>
                {{ theme()->getView('pages/location/_sidemenu',  array('location' => $location )) }}
                <!--begin::Col-->
                <div class="col-lg-10">
                    <!--begin::Card-->
                    <div class="card">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">                    
                                <div class="d-flex align-items-center position-relative my-1 me-5">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                                    <!--end::Svg Icon-->
                                    <input type="text" data-mv-service-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Services">
                                </div>
                            </h3>
                            <div class="card-toolbar">

                                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_service" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new service">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                                    <!--end::Svg Icon-->New Service
                                </a>
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
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    <!--begin::Modal - Add Service -->
    {{ theme()->getView('partials/modals/services/_add', array('location' => $location)) }}
    <!--end::Modal - Add Service-->
    <!--begin::Modal - Edit Service -->
    <{{ theme()->getView('partials/modals/services/_edit') }}
    <!--end::Modal dialog-->
        {{-- Inject Scripts --}}
        @section('scripts')
        {{ $dataTable->scripts() }}
        
        @include('pages.location.services._button-actions-js')
   
        @endsection
</x-base-layout>