<x-base-layout>
    <div class="d-flex flex-wrap flex-stack pb-5 pe-5">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">

            <!--end::Search-->
        </div>
        <!--end::Title-->
        @php
        $tokens = auth()->user()->clientpendingtokens;
        @endphp
        <div class="">
            <button type="button" class="btn btn-sm btn-success" id="btnCalculateRoute" name="btnCalculateRoute" data-bs-toggle="modal" data-bs-target="#mv_modal_calculate_route" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to Calculate Route">
                {!! theme()->getSvgIcon("icons/duotune/technology/teh003.svg", "svg-icon-3") !!}
                Calculate Best Route
            </button>
            <a href="{{ theme()->getPageUrl("home/home") }}" class="btn btn-sm btn-success">
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                New Token
            </a>
        </div>
    </div>
    <input type="hidden" id="mv_data_locations" value="" />
    <input type="hidden" id="mv_data_tokens" value="" />
    <input type="hidden" id="mv_data_routes" value="" />

    <div class="row row-cols-1 row-cols-md-3 g-4" id="mv_repeater_content">

    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5" id="mv_route_details">

    </div>
    <div style="display:none;">
        <div class="col" id="mv_step_repeater_item">
            <div class="card border border-secondary m-auto mb-6">
                <div class="card-body">
                    <h6 class="card-title text-danger" id="rptStep">First step</h6>
                    <h5 class="card-title" id="rptTitle">From xxxx to yyyy</h5>
                    <p class="card-text" id="rptDescription">13 mins - 15km</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    <!-- card-xl-stretch mb-xl-8 mb-sm-3 -->
                    <!-- m-auto mb-6 -->
                </div>
            </div>
        </div>
        <div class="col" id="mv_repeater_item">
            <div class="card h-100">
                <div class="card-body p-0">
                    <div class="px-9 pt-7 card-rounded h-150px w-100" id="rptTokenHeader">
                    </div>
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-3 px-6 py-6 position-relative z-index-1" style="margin-top: -120px">
                        <div class="d-flex align-items-center mb-6">
                            <div class="symbol symbol-45px w-40px me-5">
                                <img class="mw-80px mw-lg-95px" src="" alt="image" id="rptTokenLogo" />
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder" id="rptTokenLocation"></a>
                                    <div class="text-gray-400 fw-bold fs-7" id="rptTokenLocationAddress"></div>
                                </div>
                                <div class="d-flex align-items-center">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-6">

                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen056.svg", "svg-icon-1") !!}
                                </span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Status</a>
                                    <div class="text-gray-400 fw-bold fs-7" id="rptTokenStatus"></div>
                                </div>
                                <div class="d-flex align-items-center">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-6">
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    {!! theme()->getSvgIcon("icons/duotune/electronics/elc005.svg", "svg-icon-1") !!}
                                </span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">

                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Booked </a>
                                    <div class="text-gray-600  fs-6" id="rptTokenDate"></div>
                                </div>

                                <div class="d-flex align-items-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <a href="" class="btn btn-primary w-100 py-3" data-id="" name="check_in" id="rptTokenButton">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ theme()->getView('partials/modals/home/_calcroute') }}

    @section('scripts')
    <script src="{{ asset('demo1/plugins/custom/flatpickr/flatpickr.bundle.js') }}" type="application/javascript"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_maps')}}&libraries=geometry" type="text/javascript"></script>
    @include('pages.home._firebase-js')
    @include('pages.home._calculate-route-js')

    @endsection
</x-base-layout>