<div class="modal fade" id="mv_modal_view_blacklist" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.view_blocked_client') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-blacklist-view-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                <!-- <div id="output" class="hide blacklist blacklist-danger blacklist-dismissible fade in shadowed mb-1"></div> -->
                <!--begin::Form-->
                {{ Form::open(['url' => 'blacklist/view', 'class'=>'manualFrm form', 'id'=>'mv_modal_view_blacklist_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->
                <input type="hidden" name="blacklist_view_id" id="blacklist_view_id" value="">
                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle me-5">
                        <img alt="Pic" id="clientphoto" src="/metronic8/demo1/assets/media/avatars/300-6.jpg">
                    </div>
                    <!--end::Avatar-->

                    <!--begin::Info-->
                    <div class="fw-semibold">
                        <span class="fs-4 text-gray-800 me-2" id="span_clientname">Emma Smith</span><br />
                        <span class="fs-6 text-gray-800 me-2">From: </span><span class="badge badge-danger" id="span_block_date">Art Director</span>
                        <span id="unblock_date_container">
                        <span class="fs-6 text-gray-800 me-2"> Until </span><span class="badge badge-danger" id="span_unblock_date">Art Director</span></span> 
                    </div>
                    <!--end::Info-->
                </a>
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group">
                        <label for="">{{ trans('app.block_reason') }}</label><br />
                        <span  id="block_reason" class="fw-semibold fs-4"></span>                        
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7" id="unblock_reason_div">
                    <div class="form-group">
                        <label for="reason">{{ trans('app.unblock_reason') }}</label><br />
                        <span  id="unblock_reason" class="fw-semibold fs-4"></span>  
                    </div>
                </div>
                <!--end::Input group-->


                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-blacklist-view-modal-action="cancel">Discard</button>                   
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