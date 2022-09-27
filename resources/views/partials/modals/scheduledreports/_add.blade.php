<div class="modal fade" id="mv_modal_add_scheduledreport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Title-->
                <h2>Create Scheduled Report</h2>
                <!--end::Title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="mv_create_scheduledreport_stepper" data-mv-stepper="true">
                    <!--begin::Nav-->
                    <div class="stepper-nav py-5">
                        <!--begin::Step 1-->
                        <div class="stepper-item current" data-mv-stepper-element="nav">
                            <h3 class="stepper-title">Report Type</h3>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item" data-mv-stepper-element="nav">
                            <h3 class="stepper-title">Schedule Type</h3>
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div class="stepper-item" data-mv-stepper-element="nav">
                            <h3 class="stepper-title">Report Parameters</h3>
                        </div>
                        <!--end::Step 3-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto mw-600px w-100 py-10 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="mv_create_account_form" action="/reports/scheduled/create" method="post">
                        <!--begin::Step 1-->
                        <div class="current" data-mv-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                {{-- <div class="pb-10 pb-lg-15">
                                    <!--begin::Title-->
                                    <h2 class="fw-bold d-flex align-items-center text-dark">Choose Account Type
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Billing is issued based on your selected account type" data-mv-initialized="1"></i>
                                    </h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-semibold fs-6">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bold">Help Page</a>.
                                    </div>
                                    <!--end::Notice-->
                                </div> --}}
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="form-label mb-3 required">Schedule Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control  form-control-solid" name="name" placeholder="" value="">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="form-label mb-3 required">Report</label>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Report" tabindex="-1" aria-hidden="true" name="report_id" id="report_id">
                                        <option value=""></option>
                                        @php
                                        $groups = array_unique(array_column(\App\Core\Data::getReportList(), 'group'));
                                        @endphp
                                        @foreach($groups as $_group)
                                        <optgroup label="{{ $_group }}">
                                            @foreach(\App\Core\Data::getReportList() as $key => $value)
                                            @if($value['group'] == $_group)
                                            <option value="{{ $value['id'] }}" {{ ($value['status'])?"":"disabled"}}> {{ $value['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div data-mv-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label mb-3 required">Specify Schedule Type</label>
                                    <!--end::Label-->
                                    <!--begin::Row-->
                                    <div class="row mb-2" data-mv-buttons="true" data-mv-initialized="1">
                                        @php
                                        $groups = \App\Core\Data::getScheduledReportTypes();
                                        $selected = true;
                                        @endphp


                                        @foreach(\App\Core\Data::getScheduledReportTypes() as $key => $value)
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Option-->
                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 {{ ($selected) ? 'active':''}}">
                                                <input type="radio" class="btn-check" name="schedule_type" value="{{ $key }}" {{ ($selected) ? 'checked="checked"':''}}>
                                                <span class="fw-bold fs-3">{{ $value }}</span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->
                                        @php
                                        $selected = false;
                                        @endphp
                                        @endforeach
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Hint-->
                                    <!-- <div class="form-text">Customers will see this shortened version of your statement descriptor</div> -->
                                    <!--end::Hint-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="form-label mb-3 required">Start Date</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control  form-control-solid" name="start_date" id="start_date" placeholder="Pick a date" value="">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <div id="daily_schedule_div" style="display: none;">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Recurs every</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group input-group-solid mb-5">
                                            <input type="number" step="1" class="form-control  form-control-solid" name="daily_recurs" id="daily_recurs" placeholder="Enter number of days" value="" min="1">
                                            <span class="input-group-text" id="basic-addon2">day(s)</span>
                                        </div>
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <!--end::Input group-->
                                      <!--begin::Input group-->
                                      <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3 required">End Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control  form-control-solid" name="daily_end_date" id="daily_end_date" placeholder="Pick a date" value="">
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div id="weekly_schedule_div" style="display: none;">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Recurs every</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group input-group-solid mb-5">
                                            <input type="number" step="1" class="form-control  form-control-solid" name="weekly_recurs" id="weekly_recurs" placeholder="Enter number of weeks" value="" min="1">
                                            <span class="input-group-text" id="basic-addon2">week(s)</span>
                                        </div>
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">on</label>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Weekday" tabindex="-1" aria-hidden="true" name="weekly_dayname[]" id="weekly_dayname" multiple="multiple">
                                            <option value=""></option>
                                            @php
                                            $weekdays = \App\Core\Data::getDayNames();
                                            @endphp
                                            @foreach($weekdays as $_weekday)
                                            <option value="{{ $_weekday }}"> {{ $_weekday }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Select-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3 required">End Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control  form-control-solid" name="weekly_end_date" id="weekly_end_date" placeholder="Pick a date" value="">
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div id="monthly_schedule_div" style="display: none;">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Months</label>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Month" tabindex="-1" aria-hidden="true" name="monthly_months[]" id="monthly_months" multiple="multiple">
                                            <option value=""></option>
                                            @php
                                            $months = \App\Core\Data::getMonthNames();
                                            @endphp
                                            @foreach($months as $_month)
                                            <option value="{{ $_month }}"> {{ $_month }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Select-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="form-check form-check-custom form-check-solid mt-10">
                                                <input class="form-check-input" type="radio" value="days" id="monthly_months_on1" name="monthly_months_on" checked />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="form-label mb-3">Days</label>
                                                <!--end::Label-->
                                                <!--begin::Select-->
                                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Days" tabindex="-1" aria-hidden="true" name="monthly_days[]" id="monthly_days" multiple="multiple">
                                                    <option value=""></option>
                                                    @php
                                                    $counter = 1;
                                                    @endphp
                                                    @for($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                        <option value="Last">Last</option>
                                                </select>
                                                <!--end::Select-->
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="form-check form-check-custom form-check-solid mt-10">
                                                <input class="form-check-input" type="radio" value="ordinals" id="monthly_months_on2" name="monthly_months_on" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="form-label mb-3">Ordinal</label>
                                                <!--end::Label-->
                                                <!--begin::Select-->
                                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Days" tabindex="-1" aria-hidden="true" name="monthly_ordinal[]" id="monthly_ordinal" multiple="multiple">
                                                    <option value=""></option>
                                                    @php
                                                    $months = \App\Core\Data::getOrdinals();
                                                    @endphp
                                                    @foreach($months as $_month)
                                                    <option value="{{ $_month }}"> {{ $_month }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select-->
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="form-label mb-3">Weekday</label>
                                                <!--end::Label-->
                                                <!--begin::Select-->
                                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Days" tabindex="-1" aria-hidden="true" name="monthly_weekday[]" id="monthly_weekday" multiple="multiple">
                                                    <option value=""></option>
                                                    @php
                                                    $weekdays = \App\Core\Data::getDayNames();
                                                    @endphp
                                                    @foreach($weekdays as $_weekday)
                                                    <option value="{{ $_weekday }}"> {{ $_weekday }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select-->
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3 required">End Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control  form-control-solid" name="monthly_end_date" id="monthly_end_date" placeholder="Pick a date" value="">
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div data-mv-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="form-label required">Date Range</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control  form-control-solid" name="date_range" id="date_range" placeholder="Pick a date range" value="" tabindex="-1">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Location</span>
                                    </label>
                                    <!--end::Label-->
                                    @can('choose location')
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Location" tabindex="-1" aria-hidden="true" name="location_id[]" id="location_id" multiple="multiple">
                                        @foreach($locations as $_location)
                                        <option value="{{ $_location->id }}">{{ $_location->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                    @else
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Location" name="location" value="{{  auth()->user()->location->name }}" readonly />
                                    <input type="hidden" name="location_id" id="location_id" value="{{ auth()->user()->location_id }}" />
                                    <!--end::Input-->
                                    @endcan
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--end::Label-->
                                    <label class="form-label required">Notify</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea name="notify" id="notify" class="form-control  form-control-solid" rows="3"></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-15">
                            <!--begin::Wrapper-->
                            <div class="mr-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-mv-stepper-action="previous">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr063.svg", "svg-icon svg-icon-4 me-1") !!}
                                    <!--end::Svg Icon-->Back
                                </button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                <button type="button" class="btn btn-lg btn-primary me-3" data-mv-stepper-action="submit">
                                    <span class="indicator-label">Submit
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon svg-icon-3 ms-2 me-0") !!}
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <button type="button" class="btn btn-lg btn-primary" data-mv-stepper-action="next">Continue
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon svg-icon-4 ms-1 me-0") !!}
                                    <!--end::Svg Icon-->
                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>