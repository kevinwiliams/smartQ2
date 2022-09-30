<div class="modal fade" id="mv_modal_add_reasonforvisit" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.add_reason_for_visit') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-visitreason-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                <div id="output" class="hide alert alert-danger alert-dismissible fade in shadowed mb-1"></div>
                <!--begin::Form-->
                {{ Form::open(['url' => 'location/visitreason/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_reasonforvisit_form']) }}
                @csrf                
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('department_id') has-error @enderror">
                        <label for="department_id">{{ trans('app.department') }} <i class="text-danger">*</i></label><br />
                        {{ Form::select('department_id', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                        <span class="text-danger">{{ $errors->first('department_id') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('reason') has-error @enderror">
                        <label for="reason">{{ trans('app.reason') }} <i class="text-danger">*</i></label>
                        <input type="text" name="reason" id="reason" class="form-control" placeholder="{{ trans('app.reason') }}" value="{{ old('reason') }}">
                        <span class="text-danger">{{ $errors->first('reason') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                

                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-visitreason-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-visitreason-modal-action="submit">
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