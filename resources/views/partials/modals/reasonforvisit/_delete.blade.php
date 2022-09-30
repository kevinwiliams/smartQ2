<div class="modal fade" id="mv_modal_delete_reasonforvisit" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.delete_reason_for_visit') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-visitreason-delete-modal-action="close">
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
                {{ Form::open(['url' => 'location/visitreason/delete', 'class'=>'manualFrm form', 'id'=>'mv_modal_delete_reasonforvisit_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('department_id') has-error @enderror">
                        <label for="department_id">{{ trans('app.department') }} <i class="text-danger">*</i></label><br />
                        {{ Form::select('department_id_display', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                        <input type="hidden" name="department_id" id="department_id" class="form-control" value="">
                        <span class="text-danger">{{ $errors->first('department_id') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('id') has-error @enderror">
                        <label for="id">{{ trans('app.reason') }} <i class="text-danger">*</i></label><br />
                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Reason for Visit" tabindex="-1" aria-hidden="true" name="id" id="delete_id"></select>                        
                        <span class="text-danger">{{ $errors->first('id') }}</span>
                    </div>
                </div>
                <!--end::Input group-->             

                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-visitreason-delete-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-danger" data-mv-visitreason-delete-modal-action="submit">
                        <span class="indicator-label">Delete</span>
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