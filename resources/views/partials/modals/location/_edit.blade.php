<div class="modal fade" id="mv_modal_edit_location" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.update_company') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-location-edit-modal-action="close">
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
                {{ Form::open(['url' => 'admin/company/edit', 'class'=>'manualFrm form', 'id'=>'mv_modal_edit_location_form']) }}                
                <!-- {{ csrf_field() }} -->
                <input type="hidden" name="company_edit_id" id="company_edit_id" value="">
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
                    <div class="form-group @error('address') has-error @enderror">
                        <label for="address">{{ trans('app.address') }} <i class="text-danger">*</i></label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="{{ trans('app.address') }}" value="{{ old('address') }}">
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('website') has-error @enderror">
                        <label for="website">{{ trans('app.website') }} <i class="text-danger">*</i></label>
                        <input type="text" name="website" id="website" class="form-control" placeholder="{{ trans('app.website') }}" value="{{ old('website') }}">
                        <span class="text-danger">{{ $errors->first('website') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('email') has-error @enderror">
                        <label for="email">{{ trans('app.email') }} <i class="text-danger">*</i></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="{{ trans('app.email') }}" value="{{ old('email') }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('phone') has-error @enderror">
                        <label for="phone">{{ trans('app.phone') }} <i class="text-danger">*</i></label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ trans('app.phone') }}" value="{{ old('phone') }}">
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('contact_person') has-error @enderror">
                        <label for="contact_person">{{ trans('app.contact_person') }} <i class="text-danger">*</i></label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="{{ trans('app.contact_person') }}" value="{{ old('contact_person') }}">
                        <span class="text-danger">{{ $errors->first('contact_person') }}</span>
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
                    <div class="form-group @error('active') has-error @enderror">
                        <label for="name">{{ trans('app.active') }}</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="active" id="edit_active">
                        </div>
                        <span class="text-danger">{{ $errors->first('active') }}</span>
                    </div>
                </div>
                <!--end::Input group-->


                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-location-edit-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-location-edit-modal-action="submit">
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