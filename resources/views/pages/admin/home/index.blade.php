<x-base-layout>
<!--begin::Card-->
<div class="card">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Stepper-->
        <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_token_stepper">
            <!--begin::Nav-->
			<div class="stepper-nav mb-5">
                <!--begin::Step 1-->
                <div class="stepper-item current" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">How can we contact you?</h3>
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div class="stepper-item " data-kt-stepper-element="nav">
                    <h3 class="stepper-title">How can we help?</h3>
                </div>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div class="stepper-item " data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Joined the Q</h3>
                </div>
                <!--end::Step 3-->
            </div>
            <!--end::Nav-->
            <!--begin::Form-->
			<form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_create_token_form" action="autotoken" method="post">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
					<div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-15">
                            <!--begin::Title-->
                            <h2 class="fw-bolder d-flex align-items-center text-dark">Choose how we should contact you
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i></h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-bold fs-6">If you need more info, please check out
                            <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row">
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
                                    <div class="col-md-12 card p-3" id="phoneCard" name="smsFld" style="display: none;>                            
                                        <span class="text-muted fw-bold fs-6 pb-3">What number should we text to alert you?</span>
                                        <div class="form-group">
                                          
                                            <input type="phone" class="form-control form-control-user" id="phone" aria-describedby="phoneHelp" name="phone" placeholder="(555)555-1234 " value="{{ old('phone', auth()->user()->mobile) }}" autocomplete="off">
            
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                        <div class="d-flex flex-stack pt-3">
                                            <div class="mr-2">
                                                {{-- <button id="btnConfirm" class="button btn btn-primary">Next</button> --}}
                                                <button id="btnConfirm" type="button" class="btn btn-lg btn-primary">Next
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                    <!--end::Svg Icon--></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 card p-3" id="codeCard"  name="smsFldCode" style="display: none;">
                                        <span>Confirm the SMS code we sent below:</span>
                                        <input type="text" class="form-control form-control-user" id="code" aria-describedby="codeHelp" name="code" placeholder="555555" value="{{ old('code') }}" autocomplete="off">
            
                                        <span>It might take a few minutes, please be patient</span>
                                        
                                        <div class="form-group">
                                            <button type="button" id="activate-step-2" class=" button btn btn-primary mr-3">Next</button>
                                            <button class=" button btn btn-warning">Cancel</button>
                                        </div>
                                    </div>
                                    {{-- @else --}}
                                    <div class="col-md-12 card p-3" id="emailCard" name="emailFld" style="display: none;>                            
                                        <span class="text-muted fw-bold fs-6 pb-3">We'll send a password to your email</span>
                                        <div class="form-group">
                                            <span>{{ $maskedemail }}</span>
                                            <input type="hidden" id="phone" name="phone" value="{{ $maskedemail }}">
                                        </div>
                                        {{-- <button id="btnConfirm" class="button btn btn-primary">Next</button> --}}
                                        <div class="d-flex flex-stack pt-3">
                                            <div class="my-2">
                                                {{-- <button id="btnConfirm" class="button btn btn-primary">Next</button> --}}
                                                <button id="btnConfirm" type="button" class="btn btn-lg btn-primary">Next
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                                    <!--end::Svg Icon--></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 card p-3" id="eCodeCard" name="emailFldCode" style="display: none;">
                                        <span>Confirm the OTP code we sent below:</span>
                                        <input type="text" class="form-control form-control-user" id="code" aria-describedby="codeHelp" name="code" placeholder="555555" value="{{ old('code') }}" autocomplete="off">
            
                                        <span>It might take a few minutes, please be patient</span>
                                        
                                        <div class="form-group">
                                            <button type="button" id="activate-step-2" class=" button btn btn-primary mr-3">Next</button>
                                            <button class=" button btn btn-warning">Cancel</button>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->



                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div class="" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
					<div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-15">
                            <!--begin::Title-->
                            <h2 class="fw-bolder d-flex align-items-center text-dark">Choose below how we can be of assistance.
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i></h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-bold fs-6">If you need more info, please check out
                            <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
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
                                    <label class="d-flex align-items-center form-label mb-5">Select a department you wish to visit
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Monthly billing will be based on your account plan"></i></label>
                                    <!--end::Label-->
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
                            <span>Potential wait time <i class="fa fa-clock"></i>&nbsp;<span id="span_wait"></span></span>

                                    </div>
                                    <!--end::Options-->
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
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div class="" data-kt-stepper-element="content">
                     <!--begin::Wrapper-->
					<div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-8 pb-lg-10">
                            <!--begin::Title-->
                            <h2 class="fw-bolder d-flex align-items-center text-dark">You are queued!
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i></h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-bold fs-6">If you need more info, please check out
                            <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
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
                <!--end::Step 3-->
                <!--begin::Actions-->
                <div class="d-flex flex-stack pt-15">
                    <!--begin::Wrapper-->
                    <div class="mr-2">
                        <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr063.svg", "svg-icon-4 me-1") !!}
                        <!--end::Svg Icon-->Back</button>
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Wrapper-->
                    <div>
                        <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                            <span class="indicator-label">Finish!
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-3 ms-2 me-0") !!}
                            <!--end::Svg Icon--></span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                        <!--end::Svg Icon--></button>
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
$(function () {
    $('[data-kt-stepper-action="next"]').addClass('disabled');

    $('[name="alert_type"]').on('click', function(e) {
        var alrtType = e.target.value;
        console.log(e);

        if(alrtType == 'email'){
            $('[name="emailFld"]').show();
            $('[name="smsFld"]').hide();
            $('[name="smsFldCode"]').hide();

        }else{
            $('[name="smsFld"]').show();
            $('[name="emailFld"]').hide();
            $('[name="emailFldCode"]').hide();
        }
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

            var _smsalert = '{{ $smsalert }}';
            var msg = ""
            if (parseInt(_smsalert) == 1){
                msg = "My number is: " + phone;
            }else{
                msg = "My email is: " + phone;
            }
            
            Swal.fire({
                html: msg+ "<br>Are you sure?.",
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-light"
                }
            }).then(function (value) {
                if(value.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '{{ URL::to("admin/home/confirmMobile") }}',
                        type:'POST',
                        dataType: 'json',
                        data: {
                            'phone' : phone,
                            '_token':'<?php echo csrf_token() ?>'
                        },
                        success: function(data) {
                            $("#phoneCard").hide();
                            $("#codeCard").show();
                        }
                    });

                    
                    }

                    
            });

            
            
        });

        $('#activate-step-2').on('click', function(e) {
            var phone = $("#phone").val();
            var code = $("#code").val();

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
                url: '{{ URL::to("admin/home/confirmOTP") }}',
                type:'POST',
                dataType: 'json',
                data: {
                    'phone' : phone,
                    'code' : code,
                    '_token':'<?php echo csrf_token() ?>'
                },
                success: function(data) {
                    console.log(data);
                    if(data.status == true){
                        $('[data-kt-stepper-action="next"]').removeClass('disabled');
                        $('[data-kt-stepper-action="next"]').trigger('click');
                        $(this).remove();
                    }else{
                        Swal.fire({
                            text: 'Invalid Code',
                            icon: 'error'
                        });
                    }
                                             
                }
            });
        
            $(this).remove();
        });


        $('#activate-step-3').on('click', function(e) {
            var dept = $("#department_id").find(':checked').val();            

            if (dept == "") {
                Swal.fire({
                    title: 'Select a department',
                    icon: 'error'
                });
                return;
            }

            

        
            //$(this).remove();
        });

        $('input:radio[name=department_id]').on('click', function(e) {
            console.log(e);
            var dept = $(this).find(":checked").val();
            var dept = e.target.value;
            if (phone == "") {
                Swal.fire({
                    title: 'Enter your contact number',
                    icon: 'error'
                });
                return;
            }
 
            $.ajax({
                type: 'post',
                url: '{{ URL::to("admin/home/getwaittime") }}',
                type:'POST',
                dataType: 'json',
                data: {
                    'id' : dept,
                    '_token':'<?php echo csrf_token() ?>'
                },
                success: function(data) {
                    console.log(data);
                  $("#span_wait").text(data);                                             
                }
            });

        });
    
});
</script>    
@endsection
</x-base-layout>

