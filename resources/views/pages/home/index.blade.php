<x-base-layout>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
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
                <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="mv_create_token_form" action="autotoken" method="post">
                    <!--begin::Step 1-->
                    <div class="current" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">Choose where you want Queue
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
                                </h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <div class="form-group @error('company_id') has-error @enderror">
                                    <!-- <label for="company_id">{{ trans('app.company') }} <i class="text-danger">*</i></label> -->
                                    {{ Form::select('company_id', $companies, null, ['data-placeholder' => 'Select Company','placeholder' => 'Select Option' ,'data-control' => 'select2' , 'id' => 'company_id', 'class'=>'form-select form-select-solid form-select-lg fw-bold filter']) }}
                                    <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Repeater-->


                            <div class="fv-row">
                                <div id="mv_repeater_locations" class="row">
                                    <div style="display:none" id="mv-repeater-item">
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="location" value="" id="mv-repeater-location" />
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10" for="location_">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                            {!! theme()->getSvgIcon("icons/duotune/communication/com011.svg", "svg-icon-3x me-5") !!}
                                            <!--end::Svg Icon-->
                                            <!--begin::Info-->
                                            <span class="d-block fw-bold text-start">
                                                <span class="text-dark fw-bolder d-block fs-4 mb-2" id="mv-repeater-name">Company</span>
                                                <span class="text-muted fw-bold fs-6" id="mv-repeater-address">Address</span>
                                            </span>
                                            <!--end::Info-->
                                        </label>
                                        <!--end::Option-->
                                    </div>

                                    <div id="mv-repeater-content" class="row">

                                    </div>
                                </div>
                            </div>
                            <!--end::Repeater-->
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
                                <h2 class="fw-bolder d-flex align-items-center text-dark">Choose how we should contact you
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
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
                                    <div class="col-lg-6">
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="alert_type" value="email" id="alert_type_email" />
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10" for="alert_type_email">
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
                                    <div class="col-lg-6">
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
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-12 text-center">
                                        {{-- @if($smsalert) --}}
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
                                                <div class="d-flex flex-wrap flex-stack">
                                                    <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                </div>
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
                                        {{-- @else --}}
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
                                                <div class="d-flex flex-wrap flex-stack">
                                                    <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                    <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                                </div>
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
                                        {{-- @endif --}}
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
                                    <div class="d-flex flex-wrap flex-stack">
                                        <input name="otp_code_1" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="{{ $otparray[0] }}" inputmode="text">
                                        <input name="otp_code_2" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="{{ $otparray[1] }}" inputmode="text">
                                        <input name="otp_code_3" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="{{ $otparray[2] }}" inputmode="text">
                                        <input name="otp_code_4" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                        <input name="otp_code_5" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                        <input name="otp_code_6" type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-4 my-2" value="" inputmode="text">
                                    </div>
                                    <!--begin::Input group-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Submit-->
                                <div class="d-flex flex-center">
                                    <button type="button" id="{{(auth()->user()->otp_type == 'email')?'activate-step-2-email':'activate-step-2'}}" class="btn btn-lg btn-primary fw-bolder">
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
                                <h2 class="fw-bolder d-flex align-items-center text-dark">Choose below how we can be of assistance.
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
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
                                        <div class="mb-0 fv-row">
                                            <!--begin::Label-->
                                            {{-- <label class="d-flex align-items-center form-label mb-5">Select a department you wish to visit
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select a department below to automate the queue"></i></label>
                                            <!--end::Label--> --}}
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
                                            <div class="mb-0">
                                                @if (!empty($departments))
                                                @foreach ($departments as $department)
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
                                                            <span class="fw-bolder text-gray-800 text-hover-primary fs-5">{{ $department->name}}</span>
                                                            <span class="fs-6 fw-bold text-muted">{{ $department->description}}</span>
                                                        </span>
                                                        <!--end:Description-->
                                                    </span>
                                                    <!--end:Label-->
                                                    <!--begin:Input-->
                                                    <span class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" name="department_id" value="{{$department->id}}" />
                                                    </span>
                                                    <!--end:Input-->
                                                </label>
                                                <!--end::Option-->
                                                @endforeach
                                                @endif
                                                {{-- <span>Potential wait time <i class="fa fa-clock"></i>&nbsp;<span id="span_wait"></span></span> --}}

                                            </div>
                                            <!--end::Options-->
                                            @if($shownote == 1)
                                            <!--begin::Notes-->
                                            <div class="mb-0">
                                                <label for="userNote" class="form-label">Note</label>
                                                <textarea class="form-control" id="userNote" aria-describedby="userNote" name="userNote">{{ old('userNote') }}</textarea>
                                            </div>
                                            <!--end::Notes-->
                                            @endif
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
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
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
                                <div class="fs-6 text-gray-600 mb-5">Writing headlines for blog posts is as much an art as it is a science and probably warrants its own post, but for all advise is with what works for your great &amp; amazing audience.</div>
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
    @section('scripts')
    <script>
        $(function() {
            $("[name^=otp_code]").on("keypress", function(e){
                $(this).next().trigger("focus");
            });

            //disable stepper until verified
            $('[data-mv-stepper-action="next"]').addClass('disabled');
            //show/hide email and sms confirmation fields
            $('[name="alert_type"]').on('click', function(e) {
                var alrtType = e.target.value;
                console.log(e);

                if (alrtType == 'email') {
                    $('[name="emailFld"]').show();
                    $('[name="smsFld"]').hide();
                    $('[name="smsFldCode"]').hide();

                } else {
                    $('[name="smsFld"]').show();
                    $('[name="emailFld"]').hide();
                    $('[name="emailFldCode"]').hide();
                }
            });

            $('#btnConfirmEmail').on('click', function(e) {

                var email = $("#emailAddress").val();

                var msg = "My email is: " + email;

                Swal.fire({
                    html: msg + "<br>Are you sure?.",
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-light"
                    }
                }).then(function(value) {
                    if (value.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: '{{ URL::to("home/confirmEmail") }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'phone': email,
                                '_token': '<?php echo csrf_token() ?>'
                            },
                            success: function(data) {
                                $("#emailCard").hide();
                                $("#eCodeCard").show();
                            }
                        });
                    }


                });



            });

            $('#btnConfirm').on('click', function(e) {
                var phone = $("#phone").val();
                if (phone == "") {

                    Swal.fire({
                        text: "Enter your contact number",
                        icon: "error",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    });

                    return;
                }


                var msg = "My number is: " + phone;


                Swal.fire({
                    html: msg + "<br>Are you sure?.",
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-light"
                    }
                }).then(function(value) {
                    if (value.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: '{{ URL::to("home/confirmMobile") }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'phone': phone,
                                '_token': '<?php echo csrf_token() ?>'
                            },
                            success: function(data) {
                                $("#phoneCard").hide();
                                $("#codeCard").show();
                            }
                        });
                    }
                });



            });

            $('#btnConfirm2').on('click', function(e) {
                // alert('ok');
            });

            $('#activate-step-2').on('click', function(e) {
                var phone = $("#phone").val();
                var code = $("#code").val();

                if (code == "" || code == undefined) {
                    code = collateOTPCode('otp_code_');
                }

                if (phone == "") {
                    Swal.fire({
                        text: 'Enter your contact number',
                        icon: 'error',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    });
                    return;
                }

                if (code == "") {
                    Swal.fire({
                        text: 'Enter your OTP code',
                        icon: 'error',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    });

                    return;
                }
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to("home/confirmOTP") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'phone': phone,
                        'code': code,
                        '_token': '<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == true) {
                            $('[data-mv-stepper-action="next"]').removeClass('disabled');
                            $('[data-mv-stepper-action="next"]').trigger('click');
                            $(this).remove();
                        } else {
                            Swal.fire({
                                text: 'Invalid Code',
                                icon: 'error'
                            });
                        }

                    }
                });

                // $(this).remove();
            });

            $('#activate-step-2-email').on('click', function(e) {
                var phone = $("#emailAddress").val();
                var code = $("#emailCode").val();
                if (code == "" || code == undefined) {
                    code = collateOTPCode('otp_code_');
                }

                if (code == "") {
                    Swal.fire({
                        text: 'Enter your OTP code',
                        icon: 'error',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    });

                    return;
                }
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to("home/confirmEmailOTP") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'phone': phone,
                        'code': code,
                        '_token': '<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == true) {
                            $('[data-mv-stepper-action="next"]').removeClass('disabled');
                            $('[data-mv-stepper-action="next"]').trigger('click');
                            $(this).remove();
                        } else {
                            Swal.fire({
                                text: 'Invalid Code',
                                icon: 'error'
                            });
                        }

                    }
                });

            });



            $('input:radio[name=department_id]').on('click', function(e) {
                console.log(e);
                var dept = $(this).find(":checked").val();
                var dept = e.target.value;
                // if (phone == "") {
                //     Swal.fire({
                //         title: 'Enter your contact number',
                //         icon: 'error'
                //     });
                //     return;
                // }

                $.ajax({
                    type: 'post',
                    url: '{{ URL::to("home/getwaittime") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'id': dept,
                        '_token': '<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        console.log(data);
                        $("#span_wait").text(data);
                    }
                });

            });

            $('#cancel_otp').on('click', function(e) {
                e.preventDefault();
                console.log(e.target.dataset);
                var cancelType = e.target.dataset.cancel;
                
                if (cancelType == 'sms') {
                    // $('[name="emailFld"]').show();
                    $('[name="smsFld"]').show();
                    $('[name="smsFldCode"]').hide();

                } else {
                    // $('[name="smsFld"]').show();
                    $('[name="emailFld"]').show();
                    $('[name="emailFldCode"]').hide();
                }
            });

            $('#company_id').on('change', function(e) {
                var company = $("#company_id").find(":selected").val();

                var repItem = $('#mv-repeater-item');
                var content = $('#mv-repeater-content');

                // console.log(repItem);
                // repItem.find("#mv-repeater-name")
                $('[data-mv-stepper-action="next"]').addClass('disabled');
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to("company/getLocations") }}' + "/" + company,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        content.html("")
                        var cntr = 1;
                        data.forEach(element => {
                            var _clone = repItem.clone();
                            _clone.removeAttr("id");
                            var name = _clone.find("#mv-repeater-name");
                            name.text(element.name);

                            var address = _clone.find("#mv-repeater-address");
                            address.text(element.address);

                            var radio = _clone.find("#mv-repeater-location");
                            radio.val(element.id);

                            //update ids
                            var __id = radio.attr('id');
                            radio.attr('id', __id + element.id);
                            var label = _clone.find('label');
                            label.attr('for', __id + element.id);



                            _clone.css('display', 'inline-block');
                            _clone.addClass("col-lg-6");
                            if (cntr % 2 == 1) {
                                // _clone.addClass("mr-5");
                            }

                            _clone.on('click', function(e) {
                                $('[data-mv-stepper-action="next"]').removeClass('disabled');
                            });

                            content.append(_clone);
                            cntr++;
                        });


                    }
                });
            });

        });


        function collateOTPCode(prefix) {
            var str = "";
            $('input[name^="' + prefix + '"]').each(function() {
                console.log($(this).val());
                str = str + $(this).val();
            });

            return (str.length != 6) ? "" : str;
        }
    </script>
    @endsection
</x-base-layout>