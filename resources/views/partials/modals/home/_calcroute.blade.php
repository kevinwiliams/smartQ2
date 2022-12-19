<div class="modal fade" id="mv_modal_calculate_route" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog p-9">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Calculate Best Route</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-calcroute-modal-action="close">
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
                {{ Form::open(['url' => 'home/computeRoute', 'class'=>'manualFrm form', 'id'=>'mv_modal_calculate_route_form']) }}
                @csrf
                <input type="hidden" id="lat" name="lat" value="" />
                <input type="hidden" id="lng" name="lng" value="" />
                <!-- {{ csrf_field() }} -->
                <div class="row fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Col-->
                    <div class="col">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('start_point') has-error @enderror">
                                <label for="start_point">{{ trans('app.starting_point') }} <i class="text-danger">*</i></label>
                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select starting point" tabindex="-1" aria-hidden="true" name="start_point" id="start_point"></select>
                                <span class="text-danger">{{ $errors->first('start_point') }}</span>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('end_point') has-error @enderror">
                                <label for="end_point">{{ trans('app.end_point') }} <i class="text-danger">*</i></label>
                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select end point" tabindex="-1" aria-hidden="true" name="end_point" id="end_point"></select>
                                <div class="pt-3" style="display:none;" id="locationSuggestions">
                                    <span class="text-gray-700">Furthest:</span>

                                    <span class="text-danger">
                                        <span class="cursor-pointer" data-suggestion-id="" id="mv_location_suggestion"></span>
                                    </span>
                                </div>
                                <span class="text-danger">{{ $errors->first('end_point') }}</span>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('start_time') has-error @enderror">
                                <label for="start_time">{{ trans('app.start_time') }}</label>
                                <input type="text" class="form-control  form-control-solid" name="start_time" id="start_time" tabindex="-1" placeholder="Pick a start time" value="">
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-calcroute-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-calcroute-modal-action="submit">
                        <span class="indicator-label">Calculate</span>
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