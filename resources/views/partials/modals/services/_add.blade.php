<div class="modal fade" id="mv_modal_add_service" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.add_service') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-service-modal-action="close">
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
                {{ Form::open(['url' => 'location/services/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_service_form']) }}
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="location_id" id="location_id" value="{{$location->id}}">
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
                        <label for="description">{{ trans('app.description') }} <i class="text-danger">*</i></label>
                        <textarea name="description" id="description" class="form-control" placeholder="{{ trans('app.description') }}">{{ old('description') }}</textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name">{{ trans('app.price_range') }} <i class="text-danger">*</i></label>
                        <div class="row">

                            <div class="col">
                                <div class="input-group mb-5">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="price_range_start" id="price_range_start" class="form-control" data-inputmask="'alias': 'currency'" placeholder="{{ trans('app.from') }}" value="{{ old('price_range_start') }}">
                                </div>
                            </div>
                            <div class="col">
                            <div class="input-group mb-5">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="price_range_end" id="price_range_end" class="form-control" data-inputmask="'alias': 'currency'" placeholder="{{ trans('app.to') }}" value="{{ old('price_range_end') }}">
                                </div>
                            </div>

                        </div>


                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('status') has-error @enderror">
                        <label for="status">{{ trans('app.status') }}</label>
                        <div id="status">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" checked="checked" name="status" />
                                <span class="form-check-label fw-semibold text-muted">
                                {{ trans('app.active') }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->                
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-service-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-service-modal-action="submit">
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