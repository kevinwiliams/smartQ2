    <div class="modal fade" id="mv_modal_scheduledreports_history" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Report History</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-scheduledreports-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <!-- <div id="output" class="hide alert alert-danger alert-dismissible fade in shadowed mb-1"></div> -->
                    <div class="row">
                        <div class="col">
                            <!--begin::List Widget 6-->
                            <div class="card card-xl-stretch">
                                <!--begin::Body-->
                                <div class="card-body pt-0">
                                    <div class="scroll h-400px">
                                        <div id="mv_repeater_history">
                                            <div style="display:none">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center rounded p-5 mb-5" id="mv-repeater-item">
                                                    {!! theme()->getSvgIcon("icons/duotune/files/fil002.svg", "svg-icon svg-icon-dark svg-icon-1 me-5") !!}
                                                    <!--begin::Title-->
                                                    <div class="flex-grow-1 me-2">
                                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary fs-6" id="mv-repeater-date">Product goals strategy</a>
                                                        <span class="text-muted fw-semibold d-block" id="mv-repeater-notified">Due in 7 Days</span>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Item-->
                                            </div>

                                            <div id="mv-repeater-content">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3" data-mv-scheduledreports-modal-action="cancel">Close</button>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 6-->
                        </div>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>