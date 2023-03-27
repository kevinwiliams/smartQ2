<div class="modal fade" id="mv_modal_edit_category" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.update_department') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-category-edit-modal-action="close">
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
                {{ Form::open(['url' => 'category/edit', 'class'=>'manualFrm form', 'id'=>'mv_modal_edit_category_form']) }}
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="category_edit_id" id="category_edit_id" value="">

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


                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-category-edit-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-category-edit-modal-action="submit">
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