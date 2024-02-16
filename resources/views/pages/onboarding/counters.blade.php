<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_counters">
    {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Counter Information",
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

                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_counter" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new counter">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                                    <!--end::Svg Icon-->New Counter</a>
                </div>
            </div>
            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary" data-mv-counters-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <!-- <a>Skip for now >></a> -->
            </div>
        </div>
    </div>
    <!--begin::Modal - Add Counter -->
    {{ theme()->getView('partials/modals/counter/_add', array('location' => $location)) }}
    <!--end::Modal - Add Counter-->
    <!--begin::Modal - Edit Counter -->
    {{ theme()->getView('partials/modals/counter/_edit') }} <!--end::Modal dialog-->
    <!--end::Modal dialog-->
    @section('scripts')
    {{ $dataTable->scripts() }}

    @include('pages.location.counter._button-actions-js')

    @endsection
</x-base-layout>