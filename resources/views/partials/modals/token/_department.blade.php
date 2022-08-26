    <div class="modal fade" id="mv_modal_dept_token" tabindex="-1" aria-hidden="true">
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
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-autotokens-modal-action="close">
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
                    {{ Form::open(['url' => 'token/auto', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_auto_token_form']) }}
                    @csrf <!-- {{ csrf_field() }} -->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            {{-- @if($display->sms_alert) --}}
                            <div class="form-group @error('client_mobile') has-error @enderror">
                                <label class="required fs-6 fw-bold form-label mb-2" for="client_mobile">{{ trans('app.client_mobile') }} </label>
                                <input type="text" name="client_mobile" class="form-control form-control-solid phone" placeholder="{{ trans('app.client_mobile') }}" data-inputmask="'mask': '1 (999) 999-9999'"/>  
                                <span class="text-danger">{{ $errors->first('client_mobile') }}</span>
                            </div>   
                            {{-- @endif --}}
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
                        <input type="hidden" name="department_id">
                        <input type="hidden" name="counter_id">
                        <input type="hidden" name="user_id">
                        <input type="hidden" name="location_id" value="{{ auth()->user()->location_id }}">
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-mv-autotokens-modal-action="cancel">Discard</button>
                            <button type="submit" class="btn btn-primary" data-mv-autotokens-modal-action="submit" >
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