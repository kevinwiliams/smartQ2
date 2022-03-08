<div class="modal fade" id="kt_modal_add_counter" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.add_counter') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-counter-modal-action="close">
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
                {{ Form::open(['url' => 'admin/counter/create', 'class'=>'manualFrm form', 'id'=>'kt_modal_add_counter_form']) }}
                @csrf <!-- {{ csrf_field() }} -->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">{{ trans('app.name') }} <i class="text-danger">*</i></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('app.name') }}" value="{{ old('name') }}">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description">{{ trans('app.description') }} </label> 
                            <textarea name="description" id="description" class="form-control" placeholder="{{ trans('app.description') }}">{{ old('description') }}</textarea>
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <div class="form-group @error('status') has-error @enderror">
                            <label for="status">{{ trans('app.status') }} <i class="text-danger">*</i></label>
                            <div id="status"> 
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ (old("status")==1)?"checked":"" }}> {{ trans('app.active') }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (old("status")==0)?"checked":"" }}> {{ trans('app.deactive') }}
                                </label> 
                            </div>
                        </div>  
                    </div>
                    <!--end::Input group-->
                   
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-counter-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-counter-modal-action="submit" >
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