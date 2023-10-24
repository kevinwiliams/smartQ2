<!--begin::SMS-->
<div class="d-none" data-mv-element="email">
    <!--begin::Heading-->
    <h3 class="text-dark fw-bolder fs-3 mb-5">
        Email: Verify Your Email Address
    </h3>
    <!--end::Heading-->

    <!--begin::Notice-->
    <div class="text-gray-400 fw-bold mb-10">
        We'll send a password to your email
    </div>
    <!--end::Notice-->

    <!--begin::Form-->
    <form data-mv-element="email-form" class="form" action="{{ URL::to('home/confirmEmail') }}" method="post">
        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <!--begin::Email-->
            <div class="fw-bolder text-dark fs-3">{{ auth()->user()->getMaskedEmail() }}</div>
            <!--end::Email-->
            <input type="hidden" id="emailAddress" name="emailAddress" value="{{ auth()->user()->email }}">
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-center">
            <button type="reset" data-mv-element="email-cancel" class="btn btn-white me-3">
                Cancel
            </button>

            <button type="submit" data-mv-element="email-submit" class="btn btn-primary">
                @include('partials.general._button-indicator')
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<!--end::SMS-->
