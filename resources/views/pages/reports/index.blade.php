<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            <!--begin::Navbar-->
            <form action="#" id="mv_report_search_form">
                <!--begin::Card-->
                <div class="card mb-7">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <div class="col-xxl-5">
                            <div class="d-flex flex-row">
                                <div class="fv-row m-2 col-4">
                                    <div class="form-group @error('report') has-error @enderror">
                                        <label class="fs-6 form-label fw-bolder text-dark">Report Type</label>
                                        <!--begin::Select-->
                                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Report" tabindex="-1" aria-hidden="true" name="report" id="report">
                                            <option value=""></option>
                                            <optgroup label="Visit Reports">
                                                <option value="1" {{ ($data->report == "1")?"selected":"" }}>Hourly</option>
                                                <option value="2" {{ ($data->report == "2")?"selected":"" }}>Daily</option>
                                                <option value="3" {{ ($data->report == "3")?"selected":"" }}>Weekly</option>
                                                <option value="4" {{ ($data->report == "4")?"selected":"" }}>Monthly</option>
                                            </optgroup>
                                            <optgroup label="KPI Reports">
                                                <option value="5" {{ ($data->report == "5")?"selected":"" }} disabled>Wait Time</option>
                                                <option value="6" {{ ($data->report == "6")?"selected":"" }} disabled>Service Time</option>
                                            </optgroup>
                                            <optgroup label="Stat Reports">
                                                <option value="7" {{ ($data->report == "7")?"selected":"" }} disabled>Customers Served</option>
                                                <option value="8" {{ ($data->report == "8")?"selected":"" }} disabled>No Shows</option>
                                            </optgroup>
                                        </select>
                                        <!--end::Select-->
                                        <span class="text-danger">{{ $errors->first('report') }}</span>
                                    </div>
                                </div>
                                <div class="fv-row m-2 col-12">
                                    <div class="form-group @error('location_id') has-error @enderror">
                                        <label class="fs-6 form-label fw-bolder text-dark">Location</label>
                                        <!--begin::Select-->
                                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Location" tabindex="-1" aria-hidden="true" name="location_id" id="location_id" multiple="multiple">
                                            @foreach($locations as $_location)
                                            <option value="{{ $_location->id }}" {{ in_array($_location->id, explode(",",$data->location_id))?"selected":"" }}>{{ $_location->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Select-->
                                        <span class="text-danger">{{ $errors->first('location_id') }}</span>
                                    </div>
                                </div>
                                <div class="fv-row m-2 col-6">
                                    <div class="form-group @error('daterange') has-error @enderror">
                                        <label class="fs-6 form-label fw-bolder text-dark">Date</label>
                                        <!--begin::Select-->
                                        <input class="form-control form-control-solid" placeholder="Pick date rage" id="mv_daterangepicker" name="daterange" value="{{ $data->daterange }}" />
                                        <!--end::Select-->
                                        <span class="text-danger">{{ $errors->first('daterange') }}</span>
                                    </div>
                                </div>
                                <div class="fv-row m-2 col-1">
                                    <div class="form-group">
                                        <label class="fs-6 form-label fw-bolder text-dark">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary me-5" data-mv-search-action="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </form>
            <!--end::Navbar-->

            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                <div class="col-lg-12">

                    <!--begin::Summary-->
                    <div class="card card-flush h-lg-100">
                        @if($data->data != null)
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                @php
                                $name = "";
                                switch ($data->report){
                                    case '1':
                                        $name = "Visit Report - Hourly";
                                        break;
                                    case '2':
                                        $name = "Visit Report - Daily";
                                        break;
                                    case '3':
                                        $name = "Visit Report - Weekly";
                                        break;
                                    case '4':
                                        $name = "Visit Report - Monthly";
                                        break;

                                }


                                @endphp
                                <h1>{{ $name }}</h1>
                                <!--begin::Search-->
                                <!-- <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">...</span>
                                    <input type="text" data-mv-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
                                </div> -->
                                <!--end::Search-->
                                <!--begin::Export buttons-->
                                <div id="kt_datatable_example_1_export" class="d-none">
                                </div>
                                <!--end::Export buttons-->
                            </div>
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!--begin::Export dropdown-->
                                <button type="button" class="btn btn-light-primary" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr078.svg", "svg-icon-3") !!}
                                    Export Report
                                </button>
                                <!--begin::Menu-->
                                <div id="kt_datatable_example_1_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-mv-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-mv-export="copy">
                                            Copy to clipboard
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-mv-export="excel">
                                            Export as Excel
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-mv-export="csv">
                                            Export as CSV
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-mv-export="pdf">
                                            Export as PDF
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Export dropdown-->                                
                            </div>
                        </div>
                        @endif
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-5">
                            @if($data->data == null)
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut risus vitae mi feugiat molestie non at tellus. Integer elementum mattis lectus id tempus. Integer tristique gravida fermentum. Integer nec tortor nunc.</div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            @else
                            @if($data->report == '1')
                            {{ theme()->getView('partials/reports/hourly-token-report', array('data' => $data->data)) }}
                            @elseif($data->report == '2')
                            {{ theme()->getView('partials/reports/daily-token-report', array('data' => $data->data)) }}
                            @elseif($data->report == '3')
                            {{ theme()->getView('partials/reports/weekly-token-report', array('data' => $data->data)) }}
                            @elseif($data->report == '4')
                            {{ theme()->getView('partials/reports/monthly-token-report', array('data' => $data->data)) }}
                            @endif
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Summary-->

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    @section('scripts')

    @include('pages.reports._action-js')

    @endsection
</x-base-layout>