
<!--begin::Calendar Widget 1-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder text-dark">My Calendar</span>
            <span class="text-muted mt-1 fw-bold fs-7">Preview monthly events</span>
        </h3>
        <div class="card-toolbar">
            <a href="#" class="btn btn-primary">Manage Calendar</a>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Calendar-->
        <div id="mv_calendar_widget_1"></div>
        <!--end::Calendar-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Calendar Widget 1-->
<!--begin::Modals-->

<!--begin::Modal - New Product-->
<div class="modal fade" id="mv_modal_add_event" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="mv_modal_add_event_form">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder" data-mv-calendar="title">Add Event</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" id="mv_modal_add_event_close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold required mb-2">Event Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold mb-2">Event Description</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold mb-2">Event Location</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" id="mv_calendar_datepicker_allday" />
                            <span class="form-check-label fw-bold" for="mv_calendar_datepicker_allday">All Day</span>
                        </label>
                        <!--end::Checkbox-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row row-cols-lg-2 g-10">
                        <div class="col">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2 required">Event Start Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="mv_calendar_datepicker_start_date" />
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col" data-mv-calendar="datepicker">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Event Start Time</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="mv_calendar_datepicker_start_time" />
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row row-cols-lg-2 g-10">
                        <div class="col">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="mv_calendar_datepicker_end_date" />
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col" data-mv-calendar="datepicker">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Event End Time</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="mv_calendar_datepicker_end_time" />
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="mv_modal_add_event_cancel" class="btn btn-light me-3">Cancel</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="mv_modal_add_event_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - New Product-->


<!--begin::Modal - New Product-->
<div class="modal fade" id="mv_modal_view_event" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header border-0 justify-content-end">
                <!--begin::Edit-->
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="mv_modal_view_event_edit">
                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-2") !!}

                    <!--end::Svg Icon-->
                </div>
                <!--end::Edit-->
                <!--begin::Edit-->
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="mv_modal_view_event_delete">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-2") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Edit-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-20 px-lg-17">
                <!--begin::Row-->
                <div class="d-flex">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen014.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <div class="mb-9">
                        <!--begin::Event name-->
                        <div class="d-flex align-items-center mb-2">
                            <span class="fs-3 fw-bolder me-3" data-mv-calendar="event_name"></span>
                            <span class="badge badge-light-success" data-mv-calendar="all_day"></span>
                        </div>
                        <!--end::Event name-->
                        <!--begin::Event description-->
                        <div class="fs-6" data-mv-calendar="event_description"></div>
                        <!--end::Event description-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center mb-2">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/abstract/abs050.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Event start date/time-->
                    <div class="fs-6">
                        <span class="fw-bolder">Starts</span>
                        <span data-mv-calendar="event_start_date"></span>
                    </div>
                    <!--end::Event start date/time-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center mb-9">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/abstract/abs050.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Event end date/time-->
                    <div class="fs-6">
                        <span class="fw-bolder">Ends</span>
                        <span data-mv-calendar="event_end_date"></span>
                    </div>
                    <!--end::Event end date/time-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Event location-->
                    <div class="fs-6" data-mv-calendar="event_location"></div>
                    <!--end::Event location-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - New Product-->

<!--end::Modals-->
