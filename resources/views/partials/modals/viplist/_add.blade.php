<div class="modal fade" id="mv_modal_add_viplist" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.add_viplist') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-viplist-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                <!-- <div id="output" class="hide viplist viplist-danger viplist-dismissible fade in shadowed mb-1"></div> -->
                <!--begin::Form-->
                {{ Form::open(['url' => 'viplist/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_viplist_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->
                <input type="hidden" name="location_id" id="location_id" />
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('client_id') has-error @enderror">
                        <label for="client_id">{{ trans('app.client') }} <i class="text-danger">*</i></label>
                        <select class="form-select form-select-solid " data-dropdown-parent="#mv_modal_add_viplist" tabindex="-1" aria-hidden="true" name="client_id" id="client_id">
                        </select>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('reason') has-error @enderror">
                        <label for="reason">{{ trans('app.reason') }} <i class="text-danger">*</i></label>
                        <textarea type="text" name="reason" id="reason" class="form-control" placeholder="{{ trans('app.reason') }}">{{ old('reason') }}</textarea>
                        <span class="text-danger">{{ $errors->first('reason') }}</span>
                    </div>
                </div>
                <!--end::Input group-->               
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-viplist-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-viplist-modal-action="submit">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
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