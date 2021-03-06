<!--begin::Card toolbar-->
<div class="flex-row-fluid justify-content-end gap-5">
    <!--begin::Toolbar-->
    <div class="d-flex justify-content-end" data-mv-report-table-toolbar="base">
        <!--begin::Daterangepicker-->
        <input autocomplete="off" class="form-control form-control-solid w-100 mw-250px mx-5" placeholder="Pick date range" id="mv_token_report_daterangepicker">
        <!--end::Daterangepicker-->
        <!--begin::Filter-->
        <button type="button" class="btn btn-light-primary me-3" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
        {!! theme()->getSvgIcon("icons/duotune/general/gen031.svg", "svg-icon-2") !!}

        <!--end::Svg Icon-->Filter</button>
        <!--begin::Menu 1-->
        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-mv-menu="true">
            <!--begin::Header-->
            <div class="px-7 py-5">
                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
            </div>
            <!--end::Header-->
            <!--begin::Separator-->
            <div class="separator border-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Content-->
            <div class="px-7 py-5" data-mv-report-table-filter="form">
                <!--begin::Input group-->
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">Status:</label>
                    {{ Form::select('report_status', ["'0'"=>trans("app.pending"), '1'=>trans("app.complete"), '2'=>trans("app.stop"), '3'=>"Booked"],  null,  ['id'=> 'status', 'data-placeholder' => trans("app.status"), 'placeholder' => trans("app.status"), 'data-mv-report-table-filter' => 'status', 'data-control' => 'select2', 'class'=>'form-select form-select-solid form-select-sm fw-bold filter']) }} 
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">Department:</label>
                    {{ Form::select('report_department_id', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-mv-report-table-filter' => 'departments' ,'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-sm fw-bold filter']) }}

                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">Counter:</label>
                    {{ Form::select('report_counter_id', $counters, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-mv-report-table-filter' => 'counters', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-sm fw-bold filter']) }}

                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">Officers:</label>
                    {{ Form::select('report_user_id', $officers, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-mv-report-table-filter' => 'officers', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-sm fw-bold filter']) }}
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                {{-- <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">Date:</label>
                    <input class="form-control form-control-solid" placeholder="Pick date range" id="report_date_range"/>
                </div> --}}
                <!--end::Input group-->							
                <!--begin::Actions-->
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-mv-menu-dismiss="true" data-mv-report-table-filter="reset">Reset</button>
                    <button type="submit" class="btn btn-primary fw-bold px-6" data-mv-menu-dismiss="true" data-mv-report-table-filter="filter">Apply</button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Menu 1-->
        <!--end::Filter-->
        <!--begin::Export-->
        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#mv_modal_export_users">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
        {!! theme()->getSvgIcon("icons/duotune/arrows/arr078.svg", "svg-icon-2") !!}

        <!--end::Svg Icon-->Export</button>
        <!--end::Export-->
        
    </div>
    <!--end::Toolbar-->
    <!--begin::Group actions-->
    <div class="d-flex justify-content-end align-items-center d-none" data-mv-report-table-toolbar="selected">
        <div class="fw-bolder me-5">
        <span class="me-2" data-mv-report-table-select="selected_count"></span>Selected</div>
        <button type="button" class="btn btn-danger" data-mv-report-table-select="delete_selected">Delete Selected</button>
    </div>
    <!--end::Group actions-->
    <!--begin::Modal - Adjust Balance-->
    <div class="modal fade" id="mv_modal_export_users" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Export Users</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-report-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}

                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="mv_modal_export_users_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="role" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                <option></option>
                                <option value="Administrator">Administrator</option>
                                <option value="Analyst">Analyst</option>
                                <option value="Developer">Developer</option>
                                <option value="Support">Support</option>
                                <option value="Trial">Trial</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold form-label mb-2">Select Export Format:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="format" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                <option></option>
                                <option value="excel">Excel</option>
                                <option value="pdf">PDF</option>
                                <option value="cvs">CVS</option>
                                <option value="zip">ZIP</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3" data-mv-users-modal-action="cancel">Discard</button>
                            <button type="submit" class="btn btn-primary" data-mv-users-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Card-->

</div>
<!--end::Card toolbar-->
<input type="hidden"  name="start_date" id="start_date">
<input type="hidden"  name="end_date" id="end_date">