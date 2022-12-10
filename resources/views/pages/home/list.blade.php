<x-base-layout>
    <input type="hidden" name="department_id" id="department_id" value="{{ !empty($token->department)?$token->department->id:null }}">
    <div class="d-flex flex-wrap flex-stack pb-5 pe-5">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">

            <!--end::Search-->
        </div>
        <!--end::Title-->
        <div class="">
            <a href="{{ theme()->getPageUrl("home/home") }}" class="btn btn-sm btn-success">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                <!--end::Svg Icon-->New Token
            </a>
        </div>
    </div>
    <!--begin::Row-->
    <div class="row g-5 g-xl-8 m-auto">
        @php
        $tokens = auth()->user()->clientpendingtokens;
        @endphp
        @foreach($tokens as $token)
        <!--begin::Col-->
        <div class="col-xl-4 m-auto">

            <!--begin::Mixed Widget 1-->
            <div class="card card-xl-stretch mb-xl-8 mb-sm-3">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <!--begin::Header-->
                    <div class="px-9 pt-7 card-rounded h-150px w-100 {{ ($token->status==3)? "bg-gray-400" :"bg-primary" }} ">
                        <!-- <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="{{ $token->location->company->logo_url }}" alt="image">
                        </div> -->
                        <!--begin::Balance-->
                        <!-- <div class="d-flex text-center flex-column text-white pt-3">
                            <span class="fw-bold fs-7">TOKEN NUMBER</span>
                            <span class="fw-bolder fs-4tx pt-1">{{$token->token_no}}</span>
                        </div> -->
                        <!--end::Balance-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Items-->
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -120px">
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
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Status</a>
                                    <div class="text-gray-400 fw-bold fs-7">{{ ($token->status == 0)?"Checked In":"Booked" }}</div>
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

    <!--end::Modal - Add Company-->
    @section('scripts')


    @include('pages.home._firebase-js')

    @endsection
</x-base-layout>