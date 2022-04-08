<!--begin::Lists Widget 19-->
<div class="card">
    <!--begin::Heading-->
    <div class="card-header bg-primary rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('{{ asset('media/svg/shapes/top-green.png') }}')">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column text-white pt-15">
            <span class="fw-bolder fs-2x mb-3">Hello, {{$officer->username}}</span>
            <div class="fs-4 text-white">
                <span class="opacity-75">
                    @can('view report') There are @endcan
                    @cannot('view report') You have @endcan
                <span class="position-relative d-inline-block">
                    <a href="{{ url('token/current/card') }}" class="link-white opacity-75-hover fw-bolder d-block mb-1">{{$officer->pending}} clients</a>
                    <!--begin::Separator-->
                    <span class="position-absolute opacity-50 bottom-0 start-0 border-2 border-white border-bottom w-100"></span>
                    <!--end::Separator-->
                </span>
                <span class="opacity-75">waiting in line</span>
            </div>
        </h3>
        <!--end::Title-->
       
    </div>
    <!--end::Heading-->
    <!--begin::Body-->
    <div class="card-body mt-n20 pb-20">
        <!--begin::Stats-->
        <div class="mt-n20 position-relative">
            @php
                // print_r($officer) ;
            @endphp
            @if (!empty($officer))    
            <!--begin::Row-->
            <div class="row g-3 g-lg-6">
                <!--begin::Col-->
                <div class="col-6">
                    <!--begin::Items-->
                    <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-30px me-5 mb-8">
                            <span class="symbol-label">
                                <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/medicine/med005.svg", "svg-icon-1 svg-icon-primary") !!}
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Stats-->
                        <div class="m-0">
                            <!--begin::Number-->
                            <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{$officer->pending}}</span>
                            <!--end::Number-->
                            <!--begin::Desc-->
                            <span class="text-gray-500 fw-bold fs-6">Pending</span>
                            <!--end::Desc-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-6">
                    <!--begin::Items-->
                    <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-30px me-5 mb-8">
                            <span class="symbol-label">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/finance/fin001.svg", "svg-icon-1 svg-icon-primary") !!}
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Stats-->
                        <div class="m-0">
                            <!--begin::Number-->
                            <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $officer->complete }}</span>
                            <!--end::Number-->
                            <!--begin::Desc-->
                            <span class="text-gray-500 fw-bold fs-6">Completed</span>
                            <!--end::Desc-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-6">
                    <!--begin::Items-->
                    <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-30px me-5 mb-8">
                            <span class="symbol-label">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/general/gen020.svg", "svg-icon-1 svg-icon-primary") !!}
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Stats-->
                        <div class="m-0">
                            <!--begin::Number-->
                            <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $officer->stop }}</span>
                            <!--end::Number-->
                            <!--begin::Desc-->
                            <span class="text-gray-500 fw-bold fs-6">Cancels</span>
                            <!--end::Desc-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-6">
                    <!--begin::Items-->
                    <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-30px me-5 mb-8">
                            <span class="symbol-label">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-1 svg-icon-primary") !!}
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Stats-->
                        <div class="m-0">
                            <!--begin::Number-->
                            <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $officer->booked }}</span>
                            <!--end::Number-->
                            <!--begin::Desc-->
                            <span class="text-gray-500 fw-bold fs-6">Booked</span>
                            <!--end::Desc-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            @endif
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Body-->
</div>
<!--end::Lists Widget 19-->

