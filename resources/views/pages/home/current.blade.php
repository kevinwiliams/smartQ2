<x-base-layout>
    <input type="hidden" name="department_id" id="department_id" value="{{ !empty($token->department)?$token->department->id:null }}">
    <!--begin::Row-->
    <div class="row g-5 g-xl-8 m-auto">
        <!--begin::Col-->
        <div class="col-xl-4 m-auto">
            <!--begin::Mixed Widget 1-->
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <!--begin::Header-->
                    <div class="px-9 pt-7 card-rounded h-275px w-100 {{ ($token->status==3)? "bg-gray-400" :"bg-primary" }} ">
                        <!--begin::Heading-->
                        <div class="d-flex flex-stack">
                            <!-- <h3 class="m-0 text-white fw-bolder fs-3" id="tkn_position">Position: {{$position}}</h3> -->
                            <div class="ms-1">
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-primary border-0 me-n3" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-mv-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Options</div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" name="cancel_token">Cancel</a>
                                    </div>
                                    <!--end::Menu item-->

                                </div>
                                <!--end::Menu 3-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Balance-->
                        <div class="d-flex text-center flex-column text-white pt-3">
                            <span class="fw-bold fs-7">TOKEN NUMBER</span>
                            <span class="fw-bolder fs-4tx pt-1">{{$token->token_no}}</span>
                        </div>
                        <!--end::Balance-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Items-->
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <img class="mw-80px mw-lg-95px" src="{{ $token->location->company->logo_url }}" alt="image" />
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">{{ !empty($token->location)?$token->location->name:null }}</a>
                                    <div class="text-gray-400 fw-bold fs-7">{{ !empty($token->location)?$token->location->address: null }}</div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">
                                    {{-- <div class="fw-bolder fs-5 text-gray-800 pe-1">$2,5b</div> --}}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->

                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen056.svg", "svg-icon-1") !!}
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">{{ !empty($token->department)?$token->department->name:null }}</a>
                                    <div class="text-gray-400 fw-bold fs-7">{{ !empty($token->department)?$token->department->description: null }}</div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">
                                    {{-- <div class="fw-bolder fs-5 text-gray-800 pe-1">$2,5b</div> --}}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->

                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/text/txt010.svg", "svg-icon-1") !!}

                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">
                                        Position
                                    </a>

                                    <div class="text-gray-600 fw-bold fs-6" id="tkn_position"># {{$position}}</div>

                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">

                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-1") !!}

                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">
                                        <span id="span_wait_title">{{ ($wait != "00:00")?"Potential Wait":"You are next!" }}</span>
                                    </a>

                                    <div class="text-gray-400 fw-bold fs-7">

                                        <span id="span_wait">{{ $wait }}</span>

                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                        {!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-info ms-1") !!}
                                        <!--end::Svg Icon-->
                                    </div>

                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->

                                <div class="d-flex align-items-center">

                                </div>

                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc005.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/electronics/elc005.svg", "svg-icon-1") !!}

                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Booked </a>
                                    {{-- <div class="text-gray-400 fw-bold fs-7">{{$token->created_at}}
                                </div> --}}
                                <div class="text-gray-600  fs-6">{{ Carbon\Carbon::parse($token->created_at)->format('D M d Y h:i a');}}</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                {{-- <div class="fw-bolder fs-5 text-gray-800 pe-1">$8,8m</div> --}}

                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px w-40px me-5">
                            <span class="symbol-label bg-lighten">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/general/gen005.svg", "svg-icon-1") !!}

                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Description-->
                        <div class="d-flex align-items-center flex-wrap w-100">
                            <!--begin::Title-->
                            <div class="mb-1 pe-3 flex-grow-1">
                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Reason for Visit</a>
                                <div class="text-gray-800 fw-bold fs-7">{{ !empty($token->reason_for_visit)? $token->reason_for_visit : 'Reason not specified'}}</div>
                                <div class="text-gray-600 fw-bold fs-7">{{ !empty($token->note)?"Note: ".  $token->note : 'No notes were provided'}}</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                {{-- <div class="fw-bolder fs-5 text-gray-800 pe-1">$270m</div> --}}

                            </div>
                            <!--end::Label-->

                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Item-->
                    @if($token->status==3)
                    <!--begin::Item-->
                    <div class="d-flex align-items-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px w-40px me-5">
                            <span class="symbol-label bg-lighten">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/maps/map003.svg", "svg-icon-1") !!}

                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Description-->
                        <div class="d-flex align-items-center flex-wrap w-100">
                            <!--begin::Title-->
                            <div class="mb-1 pe-3 flex-grow-1">
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $token->location->lat }},{{ $token->location->lon }}" target="_blank" class="fs-5 text-success text-hover-primary fw-bolder">Directions</a>

                                <div class="text-danger fw-bold fs-7" id="divDistance"></div>

                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                {{-- <div class="fw-bolder fs-5 text-gray-800 pe-1">$270m</div> --}}
                            </div>
                            <!--end::Label-->

                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Item-->
                    @endif
                    @if($token->status==3)
                    <!--start::Separator-->
                    <div class="separator separator-dashed my-4"></div>
                    <!--end::Separator-->
                    @if($qrcheckin)
                    <!--start::QR Code -->
                    <div class="text-center">
                        <!-- {!! QrCode::style('round')->eyeColor(0, 0,178,0, 1,162,217)->size(250)->color(1,162,217)->generate(url("token/checkin/$token->id")) !!} -->
                    </div>
                    <!--end::QR Code -->
                    <div class="text-gray-800 fw-bolder fs-6">Enter Check-In Code</div>
                    <input name="checkin_code" id="checkin_code" type="text" data-inputmask="'mask': '9999', 'placeholder': '____'" maxlength="4" class="form-control form-control-solid h-60px fs-2qx text-center border-primary mx-1 my-2" value="" inputmode="text">
                    @else
                    <!--start::Check In Code -->
                    <div class="text-gray-800 fw-bolder fs-6">Enter Check-In Code</div>
                    <input name="checkin_code" id="checkin_code" type="text" data-inputmask="'mask': '9999', 'placeholder': '____'" maxlength="4" class="form-control form-control-solid h-60px fs-2qx text-center border-primary mx-1 my-2" value="" inputmode="text">
                    @endif
                    @endif
                </div>
                <!--end::Items-->

                <div class="p-5">
                    @if($token->status==3)
                    @if($qrcheckin)
                    <!-- <a href="#" class="btn btn-primary w-100 py-3" data-id="{{ $token->id }}" name="check_in_qr">Check In</a> -->
                    <a href="#" class="btn btn-primary w-100 py-3" data-id="{{ $token->id }}" name="check_in">Check In</a>
                    <button type="button" class="btn btn-secondary w-100 py-3 mt-3" id="btnScanBarcode" data-id="{{ $token->id }}" name="check_in_qr_scan" data-bs-toggle="modal" data-bs-target="#mv_modal_check_in" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to check in">Scan Barcode</button>
                    @else
                    <a href="#" class="btn btn-primary w-100 py-3" data-id="{{ $token->id }}" name="check_in">Check In</a>
                    @endif
                    @elseif($token->status==0)
                    <a href="#" class="btn btn-danger w-100 py-3" data-id="{{ $token->id }}" name="cancel_token">Cancel Token</a>
                    @endif
                    @if(count(auth()->user()->clientpendingtokens) > 1)
                    <a href="{{ theme()->getPageUrl("home/list") }}" class="btn btn-primary w-100 py-3 mt-3" data-id="{{ $token->id }}">View List</a>
                    @endif
                </div>
                <input type="hidden" name="tokenID" id="tokenID" value="{{ $token->id }}" />
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 1-->
    </div>
    <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Modal - Add Company -->
    {{ theme()->getView('partials/modals/home/_checkin') }}
    @include('pages.home._qrscanner-js')
    <!--end::Modal - Add Company-->
    @section('scripts')
    <script type="text/javascript">
        (function() {
            if (window.addEventListener) {
                window.addEventListener("load", loadHandler, false);
            } else if (window.attachEvent) {
                window.attachEvent("onload", loadHandler);
            } else {
                window.onload = loadHandler;
            }

            function loadHandler() {
                setTimeout(getCurrentPosition, 60000);
                getLocation();
            }

            function getCurrentPosition() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '{{ URL::to("home/currentposition") }}',
                    success: function(data) {
                        // console.log(data);
                        $("#tkn_position").text("# " + data.position);
                        $("#span_wait").text(data.wait);
                        $("#span_wait_title").text((data.wait == "0:00") ? "You're Next!" : "Potential Wait");
                    }
                });
            }


            $(document).ready(function() {
                getCurrentPosition();
            });

            // $("[name^=checkin_code]").on("keyup", function(e) {
            //     $(this).next().trigger("focus");
            // });

        })();


        $('[name=cancel_token]').on('click', function(e) {
            // console.log(e.target.dataset.id);
            var id = $('#tokenID').val();
            Swal.fire({
                    text: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, I am",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                })
                .then((value) => {
                    if (value.isConfirmed) {
                        $.ajax({
                            url: '{{ URL::to("token/stopedclient") }}/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire({
                                    text: "Token cancelled!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function() {
                                    // location.reload(true);
                                    document.location.href = '/home/list/';

                                });

                            }
                        });
                    }
                });


        });

        $('[name=check_in_qr]').on('click', function(e) {
            var id = e.target.dataset.id;

            Swal.fire({
                    text: 'Are you ready to check-in?',
                    icon: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, I am",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                })
                .then((value) => {
                    if (value.isConfirmed) {
                        $.ajax({
                            url: '{{ URL::to("token/checkin") }}/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.location.href = '/home/current/' + id;
                            }
                        });
                    }
                });
        });


        $('[name=check_in]').on('click', function(e) {
            var id = e.target.dataset.id;
            var otp = $("#checkin_code").val(); //collateOTPCode('checkin_code');
            console.log(otp);
            if (otp.length < 4) {
                Swal.fire({
                    text: "Invalid Code",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                });
                return;
            }
            checkInOTP(id, otp);
        });


        // function checkIn(id) {
        //     // alert(id);
        //     // var _url = '{{ URL::to("client/token/stoped") }}/' + id;
        //     // alert(_url);
        //     // return;
        //     Swal.fire({
        //             text: 'Are you sure?',
        //             icon: 'warning',
        //             buttons: {
        //                 cancel: "Oops!!!",
        //                 ok: true
        //             }
        //         })
        //         .then((value) => {
        //             if (value.isConfirmed) {
        //                 $.ajax({
        //                     url: '{{ URL::to("home/checkin") }}/' + id,
        //                     type: 'get',
        //                     dataType: 'json',
        //                     success: function(data) {
        //                         document.location.href = '/home';
        //                     }
        //                 });
        //             }
        //         });
        // }


        function checkInOTP(id, code) {
            Swal.fire({
                    text: 'Are you ready to check-in?',
                    icon: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, I am",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                })
                .then((value) => {
                    if (value.isConfirmed) {
                        $.ajax({
                            url: '{{ URL::to("token/checkinotp") }}',
                            type: 'post',
                            data: {
                                'id': id,
                                'code': code,
                                '_token': '<?php echo csrf_token() ?>'
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.status) {
                                    document.location.href = '/home/current/' + id;
                                } else {
                                    Swal.fire({
                                        text: data.message,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });

                                }

                            }
                        });
                    }
                });
        }

        function collateOTPCode(prefix) {
            var str = "";
            $('input[name^="' + prefix + '"]').each(function() {
                console.log($(this).val());
                str = str + $(this).val();
            });

            return (str.length != 4) ? "" : str;
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function geoSuccess(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            $('#lat').val(lat);
            $('#lng').val(lng);

            closestLocation(position);
        }

        function geoError() {
            console.log("Geocoder failed.");
            $("#locationSuggestions").hide();
        }

        function closestLocation(position) {
            var originArray = [];
            var destinationArray = [];
            var idArray = [];
            // build request
            const origin1 = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            
            originArray.push({
                lat: position.coords.latitude,
                lng: position.coords.longitude
            });

            destinationArray.push({
                lat: parseFloat('{{ $token->location->lat }}'),
                lng: parseFloat('{{ $token->location->lon }}')
            });

            // console.log(destinationArray);
            // return;
            const request = {
                origins: originArray,
                destinations: destinationArray,
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
            };

            const service = new google.maps.DistanceMatrixService();
            // get distance matrix response
            service.getDistanceMatrix(request).then((response) => {
                // show on map
                const origins = response.originAddresses;
                const destinations = response.destinationAddresses;

                var results = response.rows[0].elements[0];
                // var _lowresult;
                // var _lastdistance;
                // var key = 0;
                // for (var j = 0; j < results.length; j++) {
                //     var element = results[j];
                // }
                var text = results.distance.text + " (ETA: " + results.duration.text + ")";
                console.log(text);
                $("#divDistance").html(text);
                // console.log(results[0]);
                // console.log(response);
                // var currentid = $('#mv_location_list > option:selected').val();

                // if (currentid != idArray[key]) {
                //     var _option = $('#mv_location_list > option[value="' + idArray[key] + '"]');
                //     console.log(_option.text());
                //     $("#mv_location_suggestion").data('id', idArray[key]);
                //     var _text = _option.text() + " - " + _lowresult.distance.text + " (ETA: " + _lowresult.duration.text + ")";
                //     $("#mv_location_suggestion").text(_text);
                //     // locationSuggestions
                //     $("#locationSuggestions").show();
                // } else {
                //     $("#locationSuggestions").hide();
                // }

            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_maps')}}&callback=geoSuccess&libraries=geometry" type="text/javascript"></script>

    @include('pages.home._firebase-js')

    @endsection
</x-base-layout>