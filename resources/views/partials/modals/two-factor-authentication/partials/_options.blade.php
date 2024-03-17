<!--begin::Options-->
<div data-mv-element="options">
    <!--begin::Notice-->
    <p class="text-gray-400 fs-5 fw-bold mb-10">
        To verify that we can successfully alert you, we will send a code to your chosen alert method.
    </p>
    <!--end::Notice-->

    <!--begin::Wrapper-->
    <div class="pb-10">
        <!--begin::Option-->
        <input type="radio" class="btn-check" name="auth_option" value="email" checked="checked" id="mv_modal_two_factor_authentication_option_1" />
        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="mv_modal_two_factor_authentication_option_1">
            <?php echo theme()->getSvgIcon("icons/duotune/communication/com011.svg", "svg-icon-4x me-4") ?>

            <span class="d-block fw-bold text-start">
                <span class="text-dark fw-bolder d-block fs-3">Email</span>
                <span class="text-gray-400 fw-bold fs-6">
                    We will send a code via Email.
                </span>
            </span>
        </label>
        <!--end::Option-->

        <!--begin::Option-->
        <input type="radio" class="btn-check" name="auth_option" value="sms" id="mv_modal_two_factor_authentication_option_2" />
        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="mv_modal_two_factor_authentication_option_2">
            <?php echo theme()->getSvgIcon("icons/duotune/communication/com003.svg", "svg-icon-4x me-4") ?>

            <span class="d-block fw-bold text-start">
                <span class="text-dark fw-bolder d-block fs-3">SMS</span>
                <span class="text-gray-400 fw-bold fs-6">We will send a code via SMS.</span>
            </span>
        </label>
        <!--end::Option-->

        <!--begin::Option-->
        <input type="radio" class="btn-check" name="auth_option" value="whatsapp" id="mv_modal_two_factor_authentication_option_3" />
        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center" for="mv_modal_two_factor_authentication_option_3">
            <?php echo theme()->getSvgIcon("icons/duotune/communication/com004.svg", "svg-icon-4x me-4") ?>

            <span class="d-block fw-bold text-start">
                <span class="text-dark fw-bolder d-block fs-3">WhatsApp</span>
                <span class="text-gray-400 fw-bold fs-6">We will send a code via WhatsApp.</span>
            </span>
        </label>
        <!--end::Option-->
    </div>
    <!--end::Options-->

    <!--begin::Action-->
    <button class="btn btn-primary w-100" data-mv-element="options-select">Continue</button>
    <!--end::Action-->
</div>
<!--end::Options-->