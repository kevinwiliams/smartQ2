    <div class="modal fade" id="mv_modal_add_token" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Create new token</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-tokens-modal-action="close">
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
                    {{ Form::open(['url' => 'token/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_token_form']) }}
                    @csrf <!-- {{ csrf_field() }} -->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            {{-- @if($display->sms_alert) --}}
                            <div class="form-group @error('client_mobile') has-error @enderror">
                                <label class="required fs-6 fw-bold form-label mb-2" for="client_mobile">{{ trans('app.client_mobile') }} </label>
                                <input type="text" name="client_mobile" class="form-control form-control-solid" placeholder="{{ trans('app.client_mobile') }}"/>  
                                <span class="text-danger">{{ $errors->first('client_mobile') }}</span>
                            </div>   
                            {{-- @endif --}}
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('department_id') has-error @enderror">
                                <label class="fs-6 fw-bold form-label mb-2" for="department_id"><span class="required">{{ trans('app.department') }}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Please assign the correct department"></i></label>
                                {{ Form::select('department_id', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('department_id') }}</span>
                            </div> 
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('counter_id') has-error @enderror">
                                <label class="fs-6 fw-bold form-label mb-2" for="counter_id"><span class="required">{{ trans('app.counter') }}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Assign user to a counter"></i></label>
                                {{ Form::select('counter_id', $counters, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('counter_id') }}</span>
                            </div> 
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('user_id') has-error @enderror">
                                <label class="fs-6 fw-bold form-label mb-2" for="user_id"><span class="required">{{ trans('app.officer') }}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Assign user to a officer"></i></label>
                                {{ Form::select('user_id', $officers, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            </div> 
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                        {{-- @if($display->show_note) --}}
                            <div class="form-group @error('note') has-error @enderror">
                                <label class="fs-6 fw-bold form-label mb-2" for="note">{{ trans('app.note') }}</label> 
                                <textarea name="note" id="note" class="form-control form-control-solid rounded-3"  placeholder="{{ trans('app.note') }}">{{ old('note') }}</textarea>
                                <span class="text-danger">{{ $errors->first('note') }}</span> 
                            </div>
                        {{-- @endif --}}
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" name="is_vip">
                                <span class="form-check-label fw-bold"> {{ trans('app.is_vip') }}</span>
                            </label>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-mv-tokens-modal-action="cancel">Discard</button>
                            <button type="submit" class="btn btn-primary" data-mv-tokens-modal-action="submit" >
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