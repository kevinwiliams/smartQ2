<div class="modal fade" id="mv_modal_edit_reasonforvisitcounter" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.reason_for_visit') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-visitreasoncounter-edit-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                <!--begin::Form-->
                {{ Form::open(['url' => 'location/visitreasoncounter/edit', 'class'=>'manualFrm form', 'id'=>'mv_modal_edit_reasonforvisitcounter_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->
                
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('id') has-error @enderror">
                        <label for="id">{{ trans('app.reason_for_visit') }}</label><br />
                        <input type="hidden" name="counter_id" id="counter_id" class="form-control" value="">
                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Reason for Visit" tabindex="-1" aria-hidden="true" name="reason_id[]" id="reason_id" multiple="multiple" data-close-on-select="false"></select>
                        <span class="text-danger">{{ $errors->first('id') }}</span>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-visitreasoncounter-edit-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-visitreasoncounter-edit-modal-action="submit">
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