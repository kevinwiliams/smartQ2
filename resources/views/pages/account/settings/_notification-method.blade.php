<!--begin::Sign-in Method-->
<div class="card {{ $class ?? '' }}" {{ util()->putHtmlAttributes(array('id' => $id ?? '')) }}>
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#mv_account_notification_method">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Notification Method') }}</h3>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Content-->
    <div id="mv_account_notification_method" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <!--begin::Email Address-->
            <div class="d-flex flex-wrap align-items-center">
                <!--begin::Label-->
                <div id="mv_notification_method">
                    <div class="fs-6 fw-bolder mb-1">{{ __('Notify via') }}</div>
                    <div class="fw-bold text-gray-600">{{ ucfirst(auth()->user()->otp_type) }}</div>
                </div>
                <!--end::Label-->
                <!--begin::Action-->

                <div id="mv_signin_email_button" class="ms-auto">
                    <a href="#" class="btn btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_two_factor_authentication">{{ __('Change Notification Type') }}</a>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Email Address-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Sign-in Method-->