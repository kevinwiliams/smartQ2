<div class="modal fade" id="mv_modal_check_in" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-9">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.check_in') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-checkin-modal-action="close">
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
                <!--begin::Form-->
                {{ Form::open(['url' => 'checkin/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_check_in_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="fv-row mb-7 fv-plugins-icon-container">
                    <b>Device has camera: </b>
                    <span id="cam-has-camera"></span>
                    <br>
                    <video muted playsinline id="qr-video" class="h-200"></video>
                </div>
                <b>Detected QR code: </b>
                <span id="cam-qr-result">None</span>
                <br>
                <b>Last detected at: </b>
                <span id="cam-qr-result-timestamp"></span>
                <hr>


                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-checkin-modal-action="cancel">Discard</button>
                    <!-- <button type="submit" class="btn btn-primary" data-mv-checkin-modal-action="submit">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button> -->
                </div>
                <!--end::Actions-->
                {{ Form::close() }}
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>