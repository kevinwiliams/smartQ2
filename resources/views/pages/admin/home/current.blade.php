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
                            <h3 class="m-0 text-white fw-bolder fs-3" id="tkn_position">Position: {{$position}}</h3>
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
                        <div class="d-flex text-center flex-column text-white pt-8">
                            <span class="fw-bold fs-7">TOKEN NUMBER</span>
                            <span class="fw-bolder fs-5tx pt-1">{{$token->token_no}}</span>
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
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen025.svg", "svg-icon-1") !!}

                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">
                                        @if ($wait != "00:00")
                                        Potential Wait
                                        @else
                                            You are next!
                                        @endif
                                    </a>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                @if ($wait != "00:00")
                                <div class="d-flex align-items-center">
                                    <div class="fw-bolder fs-5 text-gray-800 pe-1">
                                        <span id="span_wait">{{ $wait }}</span>
                                    </div>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-info ms-1") !!}
                                    <!--end::Svg Icon-->
                                </div>
                                @endif
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
                                    {{-- <div class="text-gray-400 fw-bold fs-7">{{$token->created_at}}</div> --}}
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
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Notes</a>
                                    <div class="text-gray-400 fw-bold fs-7">{{ !empty($token->notes)? $token->notes : 'No notes were provided'}}</div>
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
                        <!--start::Separator-->  
                        <div class="separator separator-dashed my-4"></div>
                        <!--end::Separator-->  
                        <!--start::QR Code -->  
                        <div class="text-center">
                            {!! QrCode::style('round')->eyeColor(0, 0,178,0, 1,162,217)->size(250)->color(1,162,217)->generate(url("admin/token/checkin/$token->id")) !!}
                        </div>
                        <!--end::QR Code -->  
                        @endif
                    </div>
                    <!--end::Items-->

                    <div class="p-5">
                    @if($token->status==3)  
                        <a href="#" class="btn btn-primary w-100 py-3" data-id="{{ $token->id }}" name="check_in">Check In</a>
                    @elseif($token->status==0)  
                        <a href="#" class="btn btn-danger w-100 py-3" data-id="{{ $token->id }}" name="cancel_token">Cancel Token</a>
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
        }

        function getCurrentPosition() {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '{{ URL::to("admin/home/currentposition") }}',            
                success: function(data) {
                    // console.log(data);
                    $("#tkn_position").text("Position: " + data.position);
                    $("#span_wait").text(data.wait);
                }
            });
        }


        $(document).ready(function() {
            getCurrentPosition(); 
        });

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
                        url: '{{ URL::to("admin/token/stopedclient") }}/' + id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire({
                                text:  "Token cancelled!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                location.reload(true);

                            });
                            
                        }
                    });
                }
            });
    

    });

    $('[name=check_in]').on('click', function(e) {
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
                        url: '{{ URL::to("admin/token/checkin") }}/' + id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            document.location.href = '/admin/home/current';
                        }
                    });
                }
            });
    });

   
    function checkIn(id) {
        // alert(id);
        // var _url = '{{ URL::to("client/token/stoped") }}/' + id;
        // alert(_url);
        // return;
        Swal.fire({
                text: 'Are you sure?',
                icon: 'warning',
                buttons: {
                    cancel: "Oops!!!",
                    ok: true
                }
            })
            .then((value) => {
                if (value.isConfirmed) {
                    $.ajax({
                        url: '{{ URL::to("admin/home/checkin") }}/' + id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            document.location.href = '/admin/home';
                        }
                    });
                }
            });
    }
</script>    
@endsection
</x-base-layout>