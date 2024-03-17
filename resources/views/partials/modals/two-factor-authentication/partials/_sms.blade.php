<!--begin::SMS-->
<div class="d-none" data-mv-element="sms">
    <!--begin::Heading-->
    <h3 class="text-dark fw-bolder fs-3 mb-5">
        SMS: Verify Your Mobile Number
    </h3>
    <!--end::Heading-->

    <!--begin::Notice-->
    <div class="text-gray-400 fw-bold mb-10">
        Enter your mobile phone number with country code and we will send you a verification code upon request.
    </div>
    <!--end::Notice-->

    <!--begin::Form-->
    <form data-mv-element="sms-form" class="form" action="{{ URL::to('home/confirmMobile') }}" method="post">
        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <input type="phone" class="form-control form-control-lg form-control-solid" placeholder="1 (999) 999-9999" value="{{ old('phone', auth()->user()->mobile) }}" name="mobile"/>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-center">
            <button type="reset" data-mv-element="sms-cancel" class="btn btn-white me-3">
                Cancel
            </button>

            <button type="submit" data-mv-element="sms-submit" class="btn btn-primary">
                @include('partials.general._button-indicator')
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<!--end::SMS-->
