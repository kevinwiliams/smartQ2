<div class="modal fade" id="mv_modal_add_feedback" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.support') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-feedback-modal-action="close">
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
                {{ Form::open(['url' => 'feedback/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_feedback_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->

                <h4>Hi {{ auth()->user()->firstname }}, how may we help?</h4>
                <br />
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('type') has-error @enderror">
                        <label for="type">{{ trans('app.i_would_like_to') }} <i class="text-danger">*</i></label><br />
                        <select name="type" aria-label="{{ __('Select Type') }}" data-control="select2" data-placeholder="{{ __('Select type..') }}" class="form-select form-select-solid form-select-lg" data-dropdown-parent="#mv_modal_add_feedback">
                            @foreach(\App\Core\Data::getSupportTypeList() as $key => $value)
                            <option value="{{ $key }}" {{ $key === old('type') ? 'selected' :'' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('comment') has-error @enderror">
                        <label for="comment">{{ trans('app.comment') }} <i class="text-danger">*</i></label>
                        <textarea name="comment" id="comment" class="form-control" placeholder="{{ trans('app.comment') }}" maxlength="500">{{ old('comment') }}</textarea>
                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7" id="rating_div">
                    <label for="rating">{{ trans('app.rating') }}</label>
                    <div class="rating">
                        <!--begin::Star 1-->
                        <label class="rating-label" for="mv_rating_input_1">
                            <i class="bi bi-star-fill fs-1"></i>
                        </label>
                        <input class="rating-input" name="rating" value="1" type="radio" id="mv_rating_input_1" />
                        <!--end::Star 1-->

                        <!--begin::Star 2-->
                        <label class="rating-label" for="mv_rating_input_2">
                            <i class="bi bi-star-fill fs-1"></i>
                        </label>
                        <input class="rating-input" name="rating" value="2" type="radio" id="mv_rating_input_2" />
                        <!--end::Star 2-->

                        <!--begin::Star 3-->
                        <label class="rating-label" for="mv_rating_input_3">
                            <i class="bi bi-star-fill fs-1"></i>
                        </label>
                        <input class="rating-input" name="rating" value="3" type="radio" id="mv_rating_input_3" />
                        <!--end::Star 3-->

                        <!--begin::Star 4-->
                        <label class="rating-label" for="mv_rating_input_4">
                            <i class="bi bi-star-fill fs-1"></i>
                        </label>
                        <input class="rating-input" name="rating" value="4" type="radio" id="mv_rating_input_4" />
                        <!--end::Star 4-->

                        <!--begin::Star 5-->
                        <label class="rating-label" for="mv_rating_input_5">
                            <i class="bi bi-star-fill fs-1"></i>
                        </label>
                        <input class="rating-input" name="rating" value="5" type="radio" id="mv_rating_input_5" />
                        <!--end::Star 5-->

                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-feedback-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-feedback-modal-action="submit">
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