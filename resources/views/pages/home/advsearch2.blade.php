<x-base-layout>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-3">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="mv_create_token_stepper">
                <!--begin::Nav-->
                <div class="stepper-nav mb-5  ">
                    <!--begin::Step 1-->
                    <div class="stepper-item current" data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">Where would you like to go?</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">1.</h3>
                    </div>
                    <!--end::Step 1-->
                    <!--begin::Step 2-->
                    <div class="stepper-item" data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">How can we contact you?</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">2.</h3>
                    </div>
                    <!--end::Step 2-->
                    <!--begin::Step 3-->
                    <div class="stepper-item " data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">How can we help?</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">3.</h3>
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div class="stepper-item " data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">Joined the Q</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">Q'd!</h3>
                    </div>
                    <!--end::Step 5-->
                </div>
                <!--end::Nav-->
                <!--begin::Form-->
                <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="mv_create_token_form" action='{{ URL::to("home/autotoken") }}' method="post">
                    <!--begin::Step 1-->
                    <div class="current" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">Where would you like to Queue?
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select the business and location"></i>
                                </h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Default example-->
                            <div class="fv-row mb-7">
                                <div class="input-group input-group-solid flex-nowrap">
                                    <span class="input-group-text"><i class="bi bi-bookmark-check fs-4"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select id="category_id" class="form-select form-select-solid form-select-lg fw-bold filter rounded-start-0" name="category_id" data-placeholder="Please select Category">
                                            <option></option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" data-mv-rich-content-icon="{{ $category->logo_url }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="fv-row mb-7">
                                <div class="input-group input-group-solid flex-nowrap">
                                    <span class="input-group-text"><i class="bi bi-building fs-4"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select id="company_id" class="form-select form-select-solid form-select-lg fw-bold filter rounded-start-0" name="company_id" data-placeholder="Please select company">
                                            <option></option>
                                            @foreach($companies as $company)
                                            <option value="{{ $company->id }}" data-mv-rich-content-icon="{{ $company->logo_url }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!--end::Default example-->
                            <div class="fv-row mb-7">
                                <div class="input-group input-group-solid flex-nowrap">
                                    <span class="input-group-text"><i class="bi bi-geo fs-4"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select id="mv_location_list" class="form-select form-select-solid form-select-lg fw-bold filter rounded-start-0" name="location" data-placeholder="Please select location">
                                            <option></option>
                                        </select>
                                        <div class="pt-3" style="display:none;" id="locationSuggestions">
                                            <span class="text-gray-700">Closest:</span>

                                            <span class="text-danger">
                                                <span class="cursor-pointer" data-suggestion-id="" id="mv_location_suggestion"></span>
                                            </span>
                                        </div>
                                        <div class="pt-3" style="display:none;" id="locationDirections">
                                            <a href="#googlemaps" class="text-primary cursor-pointer" data-fslightbox="lightbox" data-class="fslightbox-source"><i class="las la-directions"></i> Directions</a>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('location') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div id="locationHours" style="display:none;">
                                <h4 class="fw-bolder d-flex align-items-center text-dark pb-2">Opening Hours</h4>
                                <div class="card-body pt-0">
                                    <div>
                                        <div class="d-flex align-items-sm-center mb-7">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1 me-2">
                                                    <span class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ \App\Core\Data::getWeekDays()[\Carbon\Carbon::now()->dayOfWeek] }}</span>
                                                    &#x2022;
                                                    <span class="text-muted fw-semibold fs-6" id="mv_location_hours">Closed</span>
                                                </div>
                                                <a href="#" class="badge badge-light fw-bold my-2" id="mv_location_more_hours" data-bs-toggle="modal" data-bs-target="#mv_modal_view_openhours" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add view opening hours"> More hours</a>
                                                <!-- <span class="badge badge-light fw-bold my-2" id="mv-servicesrepeater-price">+82$</span> -->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="div_services" style="display: none;">
                                <h4 class="fw-bolder d-flex align-items-center text-dark pb-5">Services</h4>
                                <div class="card-body pt-5">
                                    <div id="mv-servicesrepeater-content">
                                    </div>
                                    <div style="display:none">
                                        <div id="mv-servicesrepeater-item">
                                            <div class="d-flex align-items-sm-center mb-7">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                    <div class="flex-grow-1 me-2">
                                                        <span class="text-gray-800 text-hover-primary fs-6 fw-bold" id="mv-servicesrepeater-name">Top Authors</span>

                                                        <span class="text-muted fw-semibold d-block fs-7" id="mv-servicesrepeater-description">Mark, Rowling, Esther</span>
                                                    </div>

                                                    <span class="badge badge-light fw-bold my-2" id="mv-servicesrepeater-price">+82$</span>
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ theme()->getView('partials/widgets/charts/_visithours') }}
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 1-->
                    <!--begin::Step 2-->
                    <div class="" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            @if(auth()->user()->getCurrentOTP() == '')
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">

                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">How we should contact you?
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="How would you like for us to contact you?"></i>
                                </h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                </div>
                                <!--end::Notice-->

                            </div>
                            <!--end::Heading-->
                            @endif
                            <!--begin::Input group-->
                            <div class="fv-row">
                                @if(auth()->user()->getCurrentOTP() == '')
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="alert_type" value="email" id="alert_type_email" />
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="alert_type_email">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                            {!! theme()->getSvgIcon("icons/duotune/communication/com011.svg", "svg-icon-3x me-5") !!}
                                            <!--end::Svg Icon-->
                                            <!--begin::Info-->
                                            <span class="d-block fw-bold text-start">
                                                <span class="text-dark fw-bolder d-block fs-4 mb-2">Email</span>
                                                <span class="text-muted fw-bold fs-6">We will email you a code to confirm.</span>
                                            </span>
                                            <!--end::Info-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="alert_type" value="sms" id="alert_type_sms" />
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center" for="alert_type_sms">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                            {!! theme()->getSvgIcon("icons/duotune/communication/com003.svg", "svg-icon-3x me-5") !!}
                                            <!--end::Svg Icon-->
                                            <!--begin::Info-->
                                            <span class="d-block fw-bold text-start">
                                                <span class="text-dark fw-bolder d-block fs-4 mb-2">SMS</span>
                                                <span class="text-muted fw-bold fs-6">We will send you a code via SMS to confirm.</span>
                                            </span>
                                            <!--end::Info-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12" id="dvWhatsApp">
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="alert_type" value="whatsapp" id="alert_type_whatsapp" />
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5  mt-5" for="alert_type_whatsapp">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                            {!! theme()->getSvgIcon("icons/duotune/communication/com004.svg", "svg-icon-3x me-5") !!}
                                            <!--end::Svg Icon-->
                                            <!--begin::Info-->
                                            <span class="d-block fw-bold text-start">
                                                <span class="text-dark fw-bolder d-block fs-4 mb-2">WhatsApp</span>
                                                <span class="text-muted fw-bold fs-6">We will send you a code via WhatsApp to confirm.</span>
                                            </span>
                                            <!--end::Info-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-12 text-center">

                                        <div class="col-md-12 card p-3" id="phoneCard" name="smsFld" style="display: none;">
                                            <!--begin::Heading-->
                                            <div class="text-center mb-10">
                                                <!--begin::Title-->
                                                <h1 class="text-dark mb-3">OTP Verification</h1>
                                                <!--end::Title-->
                                                <!--begin::Sub-title-->
                                                <div class="text-muted fw-bold fs-5 mb-5">What number should we text to alert you?</div>
                                                <!--end::Sub-title-->

                                                <div class="form-group">

                                                    <input type="phone" class="form-control form-control-user" id="phone" aria-describedby="phoneHelp" name="phone" placeholder="(555)555-1234 " value="{{ old('phone', auth()->user()->mobile) }}" autocomplete="off">

                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                </div>
                                            </div>
                                            <!--end::Heading-->

                                            <div class="d-flex flex-stack pt-3">
                                                <div class="mr-2">
                                                    {{-- <button id="btnConfirm" class="button btn btn-primary">Next</button> --}}
                                                    <button id="btnConfirm" type="button" class="btn btn-lg btn-primary">Next
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 card p-3" id="codeCard" name="smsFldCode" style="display: none;">
                                            <!-- <span>Confirm the SMS code we sent below:</span>
                                            <input type="text" class="form-control form-control-user" id="code" aria-describedby="codeHelp" name="code" placeholder="555555" value="{{ old('code') }}" autocomplete="off"> -->

                                            <!--begin::Section-->
                                            <div class="mb-10 px-md-6">
                                                <!--begin::Label-->
                                                <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div>
                                                <!--end::Label-->
                                                <!--begin::Input group-->
                                                <!-- <div class="d-flex flex-wrap flex-stack">
                                                    <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                </div> -->
                                                <input name="otp_code" id="otp_code_sms" type="text" data-inputmask="'mask': '999999', 'placeholder': '______'" maxlength="6" class="form-control form-control-solid h-60px fs-2qx text-center border-primary mx-1 my-2" value="" inputmode="text">
                                                <!--begin::Input group-->
                                            </div>
                                            <!--end::Section-->

                                            <span class="pt-5">It might take a few minutes, please be patient</span>

                                            <div class="form-group">
                                                <button type="button" class="button btn btn-warning" id="cancel_otp" data-cancel="sms">Cancel</button>
                                                <button type="button" id="activate-step-2" class=" button btn btn-primary mr-3">Next
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                    <!--end::Svg Icon-->
                                                </button>

                                            </div>
                                        </div>

                                        <div class="col-md-12 card p-3" id="emailCard" name="emailFld" style="display: none;">
                                            <!--begin::Heading-->
                                            <div class="text-center mb-10">
                                                <!--begin::Title-->
                                                <h1 class="text-dark mb-3">OTP Verification</h1>
                                                <!--end::Title-->
                                                <!--begin::Sub-title-->
                                                <div class="text-muted fw-bold fs-5 mb-5">We'll send a password to your email</div>
                                                <!--end::Sub-title-->

                                                <!--begin::Mobile no-->
                                                <div class="fw-bolder text-dark fs-3">{{ $maskedemail }}</div>
                                                <!--end::Mobile no-->
                                                <input type="hidden" id="emailAddress" name="emailAddress" value="{{ auth()->user()->email }}">
                                            </div>
                                            <!--end::Heading-->
                                            <div class="d-flex flex-stack pt-3">
                                                <div class="my-2">
                                                    <button id="btnConfirmEmail" type="button" class="btn btn-lg btn-primary">Next
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 card p-3" id="eCodeCard" name="emailFldCode" style="display: none;">
                                            <!-- <span>Confirm the OTP code we sent below:</span>
                                            <input type="text" class="form-control form-control-user" id="emailCode" aria-describedby="codeHelp" name="code" placeholder="555555" value="{{ old('code') }}" autocomplete="off"> -->
                                            <!--begin::Section-->
                                            <div class="mb-10 px-md-6">
                                                <!--begin::Label-->
                                                <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div>
                                                <!--end::Label-->
                                                <!--begin::Input group-->
                                                <!-- <div class="d-flex flex-wrap flex-stack">
                                                    <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                </div> -->
                                                <input name="otp_code" id="otp_code_email" type="text" data-inputmask="'mask': '999999', 'placeholder': '______'" maxlength="6" class="form-control form-control-solid h-60px fs-2qx text-center border-primary mx-1 my-2" value="" inputmode="text">
                                                <!--begin::Input group-->
                                            </div>
                                            <!--end::Section-->

                                            <span class="pt-5">It might take a few minutes, please be patient</span>

                                            <div class="form-group">
                                                <button type="button" class="button btn btn-warning" id="cancel_otp" data-cancel="email">Cancel</button>
                                                <button type="button" id="activate-step-2-email" class=" button btn btn-primary mr-3">Next
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-md-12 card p-3" id="whatsappCard" name="whatsappFld" style="display: none;">
                                            <!--begin::Heading-->
                                            <div class="text-center mb-10">
                                                <!--begin::Title-->
                                                <h1 class="text-dark mb-3">OTP Verification</h1>
                                                <!--end::Title-->
                                                <!--begin::Sub-title-->
                                                <div class="text-muted fw-bold fs-5 mb-5">What number should we text to alert you?</div>
                                                <!--end::Sub-title-->

                                                <div class="form-group">

                                                    <input type="phone" class="form-control form-control-user" id="waphone" aria-describedby="phoneHelp" name="phone" placeholder="(555)555-1234 " value="{{ old('phone', auth()->user()->mobile) }}" autocomplete="off">

                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                </div>
                                            </div>
                                            <!--end::Heading-->

                                            <div class="d-flex flex-stack pt-3">
                                                <div class="mr-2">
                                                    {{-- <button id="btnConfirm" class="button btn btn-primary">Next</button> --}}
                                                    <button id="btnConfirmWhatsapp" type="button" class="btn btn-lg btn-primary">Next
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 card p-3" id="wCodeCard" name="whatsappFldCode" style="display: none;">
                                            <!-- <span>Confirm the SMS code we sent below:</span>
                                            <input type="text" class="form-control form-control-user" id="code" aria-describedby="codeHelp" name="code" placeholder="555555" value="{{ old('code') }}" autocomplete="off"> -->

                                            <!--begin::Section-->
                                            <div class="mb-10 px-md-6">
                                                <!--begin::Label-->
                                                <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div>
                                                <!--end::Label-->
                                                <!--begin::Input group-->
                                                <!-- <div class="d-flex flex-wrap flex-stack">
                                                    <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                </div> -->
                                                <input name="otp_code" id="otp_code_whatsapp" type="text" data-inputmask="'mask': '999999', 'placeholder': '______'" maxlength="6" class="form-control form-control-solid h-60px fs-2qx text-center border-primary mx-1 my-2" value="" inputmode="text">
                                                <!--begin::Input group-->
                                            </div>
                                            <!--end::Section-->

                                            <span class="pt-5">It might take a few minutes, please be patient</span>

                                            <div class="form-group">
                                                <button type="button" class="button btn btn-warning" id="cancel_otp" data-cancel="sms">Cancel</button>
                                                <button type="button" id="activate-step-2-whatsapp" class=" button btn btn-primary mr-3">Next
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                    <!--end::Svg Icon-->
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                @else
                                <!--begin::Icon-->
                                <!-- <div class="text-center mb-10">
									<img alt="Logo" class="mh-125px" src=" {{ asset(theme()->getMediaUrlPath() . 'svg/misc/smartphone.svg') }} ">
								</div> -->
                                <!--end::Icon-->
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-3">OTP Verification</h1>
                                    <!--end::Title-->
                                    <!--begin::Sub-title-->
                                    <div class="text-muted fw-bold fs-5 mb-5">Enter the verification code we sent to</div>
                                    <!--end::Sub-title-->
                                    @if(auth()->user()->otp_type == 'email')
                                    <!--begin::Mobile no-->
                                    <div class="fw-bolder text-dark fs-3">{{ $maskedemail }}</div>
                                    <!--end::Mobile no-->
                                    @else
                                    <!--begin::Mobile no-->
                                    <div class="fw-bolder text-dark fs-3">{{ Str::mask(auth()->user()->mobile,'*', 0, strlen(auth()->user()->mobile) - 4) }}</div>
                                    <!--end::Mobile no-->
                                    @endif
                                </div>
                                <!--end::Heading-->
                                <!--begin::Section-->
                                <div class="mb-10 px-md-6">
                                    <!--begin::Label-->
                                    <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div>
                                    <!--end::Label-->
                                    <!--begin::Input group-->
                                    @php
                                    $otparray = str_split(auth()->user()->getCurrentOTP());
                                    @endphp
                                    <!-- <div class="d-flex flex-wrap flex-stack">
                                        <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="{{ $otparray[0] }}" inputmode="text">
                                        <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="{{ $otparray[1] }}" inputmode="text">
                                        <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="{{ $otparray[2] }}" inputmode="text">
                                        <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                        <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                        <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                    </div> -->
                                    <input name="otp_code" id="otp_code{{(auth()->user()->otp_type == 'email')?'_email':'_sms'}}" type="text" data-inputmask="'mask': '999999', 'placeholder': '______'" maxlength="6" class="form-control form-control-solid h-60px fs-2qx text-center border-primary mx-1 my-2" value="{{ substr(auth()->user()->getCurrentOTP(),0,3) }}" inputmode="text">
                                    <!--begin::Input group-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Submit-->
                                <div class="d-flex flex-center">
                                    @php
                                    $step = "";
                                    if(auth()->user()->otp_type == "email"){
                                    $step = "activate-step-2-email";
                                    } else if(auth()->user()->otp_type == "sms"){
                                    $step = "activate-step-2";
                                    }else if(auth()->user()->otp_type == "whatsapp"){
                                    $step = "activate-step-2-whatsapp";
                                    }
                                    @endphp
                                    <button type="button" id="{{ $step }}" class="btn btn-lg btn-primary fw-bolder">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Submit-->
                                @endif
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->
                    <!--begin::Step 3-->
                    <div class="" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">How we can be of assistance?
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select the department you wish to visit or the reason for your visit"></i>
                                </h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                {{-- <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                </div> --}}
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col">

                                        <!--begin::Input group-->
                                        <div class="mb-0">
                                            <div class="d-flex align-items-center bg-light-info rounded p-5 mb-7">
                                                <!--begin::Icon-->
                                                <span class="svg-icon svg-icon-info me-5">
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/general/gen012.svg", "svg-icon-1") !!}
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <!--end::Icon-->

                                                <!--begin::Title-->
                                                <div class="flex-grow-1 me-2">
                                                    <a href="#" class="fw-bolder text-gray-800 text-hover-warning fs-6">Potential wait time</a>
                                                    <span id="span_wait" class="text-muted fw-bold d-block"></span>
                                                </div>
                                                <!--end::Title-->


                                            </div>
                                            <!--begin::Options-->
                                            <div id="mv-departmentrepeater-content" class="mb-0" style="display: none;">
                                                <input class="form-check-input" type="radio" name="department_id" value="" id="mv-departmentrepeater-id" />
                                            </div>
                                            <div id="mv_reasonforvisit">
                                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Reason for Visit" tabindex="-1" aria-hidden="true" name="reason_id" value="" id="reason_id"></select>
                                                <br />
                                            </div>
                                            <div id="mv_repeater_department" class="row">
                                                <div style="display:none" id="mv-departmentrepeater-item">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                        <!--begin:Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Icon-->
                                                            <span class="symbol symbol-50px me-6">
                                                                <span class="symbol-label">
                                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                                    {!! theme()->getSvgIcon("icons/duotune/general/gen017.svg", "svg-icon-1 svg-icon-gray-600") !!}
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </span>
                                                            <!--end::Icon-->
                                                            <!--begin::Description-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder text-gray-800 text-hover-primary fs-5" id="mv-departmentrepeater-name"></span>
                                                                <span class="fs-6 fw-bold text-muted" id="mv-departmentrepeater-description"></span>
                                                            </span>
                                                            <!--end:Description-->
                                                        </span>
                                                        <!--end:Label-->
                                                        <!--begin:Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" name="department_id" value="" id="mv-departmentrepeater-id" />
                                                        </span>
                                                        <!--end:Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                            </div>
                                            <!--end::Options-->
                                            <input type="hidden" id="visitreason" name="visitreason" value="" />
                                            <input type="hidden" id="lat" name="lat" value="" />
                                            <input type="hidden" id="lng" name="lng" value="" />


                                            <!--begin::Notes-->
                                            <div class="mb-0" id="shownote">
                                                <label for="userNote" class="form-label">Note</label>
                                                <textarea class="form-control" id="userNote" aria-describedby="userNote" name="userNote">{{ old('userNote') }}</textarea>
                                            </div>
                                            <!--end::Notes-->

                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div class="" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-8 pb-lg-10">
                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">You are queued!
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Awesome!!! You are queued. Check in at the location"></i>
                                </h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div class="mb-0">
                                <!--begin::Text-->
                                <div class="fs-6 text-gray-600 mb-5">
                                    Thank you for using {{ config('app.name') }}. We are pleased to inform you that your place in the queue has been successfully reserved. In order to complete your check-in, please visit the location indicated on your reservation confirmation. When you arrive, please make sure to have your confirmation number or scan the available QR code. Thank you for choosing our system, and we look forward to serving you soon.
                                </div>
                                <!--end::Text-->
                                <!--begin::Alert-->
                                <!--begin::Notice-->
                                <div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen026.svg", "svg-icon-2tx svg-icon-success me-4") !!}

                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">You're token number is <span id="tkn_number"></span> </h4>
                                            <input type="hidden" value="" id="tkn_id" />
                                            <div class="fs-6 text-gray-700" id="tkn_position">
                                                {{-- <a href="#" class="fw-bolder">Create Team Platform</a> --}}
                                            </div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--end::Alert-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 4-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3" data-mv-stepper-action="previous">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr063.svg", "svg-icon-4 me-1") !!}
                                <!--end::Svg Icon-->Back
                            </button>
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Wrapper-->
                        <div>
                            <button type="button" class="btn btn-lg btn-primary me-3" data-mv-stepper-action="submit">
                                <span class="indicator-label">Finish!
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-3 ms-2 me-0") !!}
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary" data-mv-stepper-action="next">Continue
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                <!--end::Svg Icon-->
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <div class="mapWrapper">
        <iframe width="800" height="500" id="googlemaps" class="fslightbox-source" frameBorder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" allow="autoplay; fullscreen" allowFullScreen>
        </iframe>
    </div>

    @section('scripts')    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_maps')}}&callback=geoSuccess&libraries=geometry" type="text/javascript"></script>
    @include('pages.home._firebase-js')

    @endsection
</x-base-layout>