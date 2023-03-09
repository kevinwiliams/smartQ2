<x-base-layout>
    <input type="hidden" name="department_id" id="department_id" value="{{ !empty($token->department)?$token->department->id:null }}">
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
            &nbsp;
            <a href="{{ theme()->getPageUrl("home/home") }}" class="btn btn-sm btn-success">
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                New Token
            </a>
        </div>
    </div>
    <input type="hidden" id="mv_data_locations" value="" />    
    <!--begin::Row-->
    <div class="row g-5 g-xl-8 m-auto">

        @foreach($tokens as $token)
        <!--begin::Col-->
        <div class="col-xl-4 m-auto mb-6">

            <!--begin::Mixed Widget 1-->
            <div class="card card-xl-stretch mb-xl-8 mb-sm-3">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <!--begin::Header-->
                    <div class="px-9 pt-7 card-rounded h-150px w-100 {{ ($token->status==3)? "bg-gray-400" :"bg-primary" }} ">

                    </div>
                    <!--end::Header-->
                    <!--begin::Items-->
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-3 px-6 py-6 position-relative z-index-1" style="margin-top: -120px">
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
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Status</a>
                                    <div class="text-gray-400 fw-bold fs-7">{{ ($token->status == 0)?"Checked In":"Booked" }}</div>
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

                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Item-->

                </div>
                <!--end::Items-->

                <div class="p-5">
                    <a href="{{ theme()->getPageUrl("home/current/" . $token->id) }}" class="btn btn-primary w-100 py-3" data-id="{{ $token->id }}" name="check_in">View</a>
                </div>
                <input type="hidden" name="tokenID" id="tokenID" value="{{ $token->id }}" />
            </div>
            <!--end::Body-->

        </div>
        <!--end::Mixed Widget 1-->

    </div>
    <!--end::Col-->
    @endforeach
    </div>
    <!--end::Row-->
    <!--begin::Modal - Add Company -->
    {{ theme()->getView('partials/modals/home/_calcroute') }}

    <!--end::Modal - Add Company-->
    @section('scripts')
    <script src="{{ asset('qsmart/plugins/custom/flatpickr/flatpickr.bundle.js') }}" type="application/javascript"></script>

    @include('pages.home._firebase-js')
    @include('pages.home._calculate-route-js')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_maps')}}" type="text/javascript"></script>
    @endsection
</x-base-layout>