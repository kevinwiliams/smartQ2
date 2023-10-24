<!--begin::Apps-->
<div class="d-none" data-mv-element="code">
    <!--begin::Heading-->
    <h3 class="text-dark fw-bolder mb-7">
        Confirm Code
    </h3>
    <!--end::Heading-->

    <!--begin::Description-->
    <div class="text-gray-500 fw-bold fs-6 mb-10">
        Enter the code we sent.
    </div>
    <!--end::Description-->
<!--begin::Form-->
    <form data-mv-element="code-form" class="form" action="{{ URL::to('home/confirmOTP') }}" method="post">
        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <input name="type" id="type" type="hidden" value="" />
            <input name="code" id="code" type="text" data-inputmask="'mask': '999999', 'placeholder': '______'" maxlength="6" class="form-control form-control-lg form-control-solid" value="" inputmode="text">
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-center">
            <button type="reset" data-mv-element="code-cancel" class="btn btn-white me-3">
                Cancel
            </button>

            <button type="submit" data-mv-element="code-submit" class="btn btn-primary">
                @include('partials.general._button-indicator')
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<!--end::Options-->
