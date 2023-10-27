@if(!auth()->user()->isOTPValid)
@php
    $class = $class ?? '';   
@endphp
<div class="card {{ $class }} mb-10">
    <!--begin::Content-->
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed  p-6">
             <!--begin::Icon-->
             {!! theme()->getSvgIcon("icons/duotune/general/gen048.svg", "svg-icon-3x svg-icon-danger me-4") !!}
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                <!--begin::Content-->
                <div class="mb-3 mb-md-0 fw-semibold">
                    <h4 class="text-gray-900 fw-bold">Verify your contact method</h4>

                    <div class="fs-6 text-gray-700 pe-7">Two-factor authentication adds an extra layer of security to your account. To verify, you'll need to provide a 6 digit code</div>
                </div>
                <!--end::Content-->

                <!--begin::Action-->
                <a href="#" class="btn btn-danger px-6 align-self-center text-nowrap" data-bs-toggle="modal" data-bs-target="#mv_modal_two_factor_authentication">
                    Verify </a>
                <!--end::Action-->
            </div>
            <!--end::Wrapper-->
        </div>
    </div>
    <!--end::Card body-->
    <!--end::Content-->
</div>

<!--begin::Modal - Two Factor Auth -->
{{ theme()->getView('partials/modals/two-factor-authentication/_main') }}
<!--end::Modal dialog-->
@endif