<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}
             <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-5">       
                <h3 class="card-title align-items-start flex-column">
                        <div class="d-flex align-items-center position-relative my-1 me-5">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            
                            <!--end::Svg Icon-->
                            <!-- <input type="text" data-mv-dept-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Depts"> -->
                        </div>
                    </h3>             
                    <div class="card-toolbar" >
                    
                        <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_reasonforvisit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new reason for visit">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                            <!--end::Svg Icon-->New Reason</a>
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
        <!--end::Container-->
    </div>
    <!--end::Post-->
   
    <!--begin::Modal - Add Reason for Visit -->
    {{ theme()->getView('partials/modals/reasonforvisit/_add', array('departments' => $departmentlist)) }}
    <!--end::Modal - Add Reason for Visit-->   
    <!--begin::Modal - Edit Reason for Visit -->
    {{ theme()->getView('partials/modals/reasonforvisit/_edit', array('departments' => $departmentlist)) }}
    <!--end::Modal Edit Reason for Visit-->
    <!--begin::Modal - Delete Reason for Visit -->
    {{ theme()->getView('partials/modals/reasonforvisit/_delete', array('departments' => $departmentlist)) }}
    <!--end::Modal Delete Reason for Visit-->
@section('scripts')
{{ $dataTable->scripts() }}

@include('pages.location.reasonforvisit._button-actions-js')
    
@endsection
</x-base-layout>