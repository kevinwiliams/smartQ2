@php
$chartColor = $chartColor ?? 'primary';
$chartHeight = $chartHeight ?? '175px';
@endphp

<!--begin::Mixed Widget 2-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0 bg-{{ $chartColor }} py-5">
        <h3 class="card-title fw-bolder text-white">Queue Statistics</h3>

        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-{{ $color ?? '' }} border-0 me-n3" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">
                {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
            </button>
            {{ theme()->getView('partials/menus/_menu-4') }}
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-0">
        <!--begin::Chart-->
        <div class="daily-performance-chart card-rounded-bottom bg-{{ $chartColor }}" data-mv-color="white" style="height: {{ $chartHeight }}"></div>
        <!--end::Chart-->

        <!--begin::Stats-->
        <div class="card-p mt-n20 position-relative">
            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    {!! theme()->getSvgIcon("icons/duotune/general/gen032.svg", "svg-icon-3x svg-icon-warning d-block my-2") !!}
                    @php
                        $location_id = auth()->user()->location_id;
                        $dt = \Carbon\Carbon::now();                        
                        $end_date = $dt->format('m/d/Y');
                        $start_date = $dt->subDays(7)->format('m/d/Y');
                        $url = "reports?report=3&location_id=" . $location_id . "&daterange=" . $start_date . " - " . $end_date;
                    @endphp
                    <a href='{{theme()->getPageUrl($url)}}' target="_blank" class="text-warning fw-bold fs-6">
                        Weekly Visits
                    </a>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                    {!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-3x svg-icon-primary d-block my-2") !!}
                    @php                        
                        $url = "reports?report=5&location_id=" . $location_id . "&daterange=" . $start_date . " - " . $end_date;
                    @endphp
                    <a href="{{theme()->getPageUrl($url)}}" target="_blank" class="text-primary fw-bold fs-6">
                        Wait Time
                    </a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                    {!! theme()->getSvgIcon("icons/duotune/technology/teh002.svg", "svg-icon-3x svg-icon-danger d-block my-2") !!}
                    @php                        
                        $url = "reports?report=7&location_id=" . $location_id . "&daterange=" . $start_date . " - " . $end_date;
                    @endphp
                    <a href="{{theme()->getPageUrl($url)}}" target="_blank" class="text-danger fw-bold fs-6 mt-2">
                        Customers Served
                    </a>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col bg-light-success px-6 py-8 rounded-2">
                    {!! theme()->getSvgIcon("icons/duotune/graphs/gra001.svg", "svg-icon-3x svg-icon-success d-block my-2") !!}
                    @php                        
                        $url = "reports?report=10&location_id=" . $location_id . "&daterange=" . $start_date . " - " . $end_date;
                    @endphp
                    <a href="{{theme()->getPageUrl($url)}}" target="_blank" class="text-success fw-bold fs-6 mt-2">
                        Performance
                    </a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 2-->