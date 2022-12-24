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
                        <div class="row">
                            <div class="fv-row col-3">
                                <div class="form-group @error('report') has-error @enderror">
                                    <label class="fs-6 form-label fw-bolder text-dark">Report Type</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Report" tabindex="-1" aria-hidden="true" name="report" id="report">
                                        <option value=""></option>
                                        @php
                                        $groups = array_unique(array_column(\App\Core\Data::getReportList(), 'group'));
                                        @endphp
                                        @foreach($groups as $_group)
                                        <optgroup label="{{ $_group }}">
                                            @foreach(\App\Core\Data::getReportList() as $key => $value)
                                            @if($value['group'] == $_group)
                                            <option value="{{ $value['id'] }}" {{ ($value['status'])?"":"disabled"}} {{ ($data->report == $value['id'])?"selected":"" }}> {{ $value['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                    <span class="text-danger">{{ $errors->first('report') }}</span>
                                </div>
                            </div>
                            @can('choose location')
                            <div class="fv-row col-5">
                                <div class="form-group @error('location_id') has-error @enderror">
                                    <label class="fs-6 form-label fw-bolder text-dark">Location</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Location" tabindex="-1" aria-hidden="true" name="location_id" id="location_id" multiple="multiple" data-close-on-select="false">
                                        @foreach($locations as $_location)
                                        <option value="{{ $_location->id }}" {{ in_array($_location->id, explode(",",$data->location_id))?"selected":"" }}>{{ $_location->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                    <span class="text-danger">{{ $errors->first('location_id') }}</span>
                                </div>
                            </div>
                            @else
                            <div class="fv-row col-5">
                                <div class="form-group @error('location_id') has-error @enderror">
                                    <label class="fs-6 form-label fw-bolder text-dark">Location</label>
                                    <input class="form-control form-control-solid" placeholder="Location" name="location" value="{{  auth()->user()->location->name }}" readonly />
                                    <input type="hidden" name="location_id" id="location_id" value="{{ auth()->user()->location_id }}" />
                                    <span class="text-danger">{{ $errors->first('location_id') }}</span>
                                </div>
                            </div>

                            @endcan
                            <div class="fv-row col-3">
                                <div class="form-group @error('daterange') has-error @enderror">
                                    <label class="fs-6 form-label fw-bolder text-dark">Date</label>
                                    <!--begin::Select-->
                                    <input class="form-control form-control-solid" placeholder="Pick date rage" id="mv_daterangepicker" name="daterange" value="{{ $data->daterange }}" />
                                    <!--end::Select-->
                                    <span class="text-danger">{{ $errors->first('daterange') }}</span>
                                </div>
                            </div>
                            <div class="fv-row col-1">
                                <div class="form-group">
                                    <label class="fs-6 form-label fw-bolder text-dark">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary me-5" data-mv-search-action="submit">Search</button>
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
                        @if(!$data->home)
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                @php
                                $name = "";
                                $reports = \App\Core\Data::getReportList();
                                $ids = array_column($reports, 'id');
                                $found_key = array_search($data->report, $ids);
                                $name = $reports[$found_key]['title'];
                                $view = $reports[$found_key]['view'];
                                $orientation = $reports[$found_key]['orientation'];
                                $pageSize = $reports[$found_key]['pageSize'];

                                @endphp
                                <h1>{{ $name }}</h1>
                                <input type="hidden" value="{{ $name }}" id="report_title" name="report_title" />
                                <input type="hidden" value="{{ $orientation }}" id="report_orientation" name="report_orientation" />
                                <input type="hidden" value="{{ $pageSize }}" id="report_pageSize" name="report_pageSize" />
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
                            @if(count($data->data) > 0)
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                @if($data->graph)
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#mv_tab_pane_table">Table</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#mv_tab_pane_graph">Graph</a>
                                    </li>
                                </ul>
                                @endif
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
                            @endif
                        </div>
                        @endif
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-5">
                            @if($data->home)
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->

                                    <!-- <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut risus vitae mi feugiat molestie non at tellus. Integer elementum mattis lectus id tempus. Integer tristique gravida fermentum. Integer nec tortor nunc.
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col ps-md-10">
                                            <!--begin::Title-->
                                            <h2 class="text-gray-800 fw-bolder mb-4">Report Generation</h2>
                                            <div class="d-flex mb-9">
                                                <!--begin::Icon-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                                    {!! theme()->getSvgIcon("icons/duotune/graphs/gra011.svg", "svg-icon-3") !!}
                                                </span>
                                                <!--end::Icon-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <!--begin::Content-->
                                                    <div class="fw-semibold">
                                                        <div class="fs-6 text-gray-700">
                                                            Our online reporting platform is designed to provide users with a comprehensive and easy-to-use interface for accessing and analyzing data.<br />
                                                            The platform features a variety of interactive charts and graphs that allow users to visualize their data in a clear and intuitive way.<br />
                                                            Additionally, users can access their data in a tabular format and can easily export it to a variety of formats, including CSV, Excel, and PDF. <br />
                                                            This makes it easy for users to share their data with others or to use it for further analysis. <br />
                                                            Overall, our online reporting platform is a powerful tool for anyone looking to gain insights from their data in an efficient and effective way.<br />
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            @else
                            {{ theme()->getView($view, array('data' => $data->data, 'master' => $data)) }}
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