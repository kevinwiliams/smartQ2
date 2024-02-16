<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_visitreasons">
    {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Visit Reason Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            <h5>Tell us about your counters</h5>
            <br />
            <div class="card-header p-0">
                <h3 class="card-title align-items-start flex-column">
                    <div class="d-flex align-items-center position-relative my-1 me-5">
                        
                    </div>
                </h3>
                <div class="card-toolbar">
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_reasonforvisit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new reason for visit">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                                    <!--end::Svg Icon-->New Reason</a>
                </div>
            </div>
            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary" data-mv-visitreasons-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <!-- <a>Skip for now >></a> -->
            </div>
        </div>
    </div>
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