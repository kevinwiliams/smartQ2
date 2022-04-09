<div class="modal fade" id="mv_modal_add_location" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-9">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.add_location') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-location-modal-action="close">
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
                {{ Form::open(['url' => 'location/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_location_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row fv-row mb-7 fv-plugins-icon-container">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('company_id') has-error @enderror">
                                <label for="company_id">{{ trans('app.company') }} <i class="text-danger">*</i></label>
                                <input type="text" name="company" id="company" class="form-control" placeholder="{{ trans('app.name') }}" value="{{ $company->name }}" disabled>
                                <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                                <span class="text-danger">{{ $errors->first('company_id') }}</span>
                            </div>
                        </div>
                        <!--end::Input group-->

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
                        <label for="address">{{ trans('app.address') }} <i class="text-danger">*</i></label>
                            <div class="input-group @error('address') has-error @enderror">                                
                                <input type="text" name="address" id="address-add" class="form-control" placeholder="{{ trans('app.address') }}" value="{{ old('address') }}" aria-label="{{ trans('app.address') }}" aria-describedby="address-search-addon">
                                <span class="input-group-text" id="address-search-addon">
                                    <i class="fas fa-location-arrow fs-4"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <div class="form-group @error('lat') has-error @enderror">
                                        <label for="lat">{{ trans('app.lat') }} <i class="text-danger">*</i></label>
                                        <input type="text" name="lat" id="lat" class="form-control" placeholder="{{ trans('app.lat') }}" value="{{ old('lat') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('lat') }}</span>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <div class="form-group @error('lng') has-error @enderror">
                                        <label for="lng">{{ trans('app.lng') }} <i class="text-danger">*</i></label>
                                        <input type="text" name="lng" id="lng" class="form-control" placeholder="{{ trans('app.lng') }}" value="{{ old('lng') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('lng') }}</span>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <span class="text-gray=500">Please use the map below to set the coordinates</span> <br>


                        <!--start::Google map-->
                        <div id="map" style="height:400px; width: 600px;" class="my-3"></div>
                        <!--end::Google map-->
                    </div>
                    <!--end::Col-->
                </div>



                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-location-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-location-modal-action="submit">
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