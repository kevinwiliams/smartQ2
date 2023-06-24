<div class="modal fade" id="mv_modal_add_alert" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.add_alert') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-alert-modal-action="close">
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
                {{ Form::open(['url' => 'alerts/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_alert_form']) }}
                @csrf
                <!-- {{ csrf_field() }} -->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('title') has-error @enderror">
                        <label for="title">{{ trans('app.title') }} <i class="text-danger">*</i></label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="{{ trans('app.title') }}" value="{{ old('title') }}">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('message') has-error @enderror">
                        <label for="message">{{ trans('app.message') }} <i class="text-danger">*</i></label>
                        <textarea type="text" name="message" id="message" class="form-control" placeholder="{{ trans('app.message') }}">{{ old('message') }}</textarea>
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>
                </div>
                <!--end::Input group-->

                <div class="row">
                    <div class="col">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('start_date') has-error @enderror">
                                <label for="start_date">{{ trans('app.start_date') }} <i class="text-danger">*</i></label>
                                <input type="text" name="start_date" id="start_date" class="form-control datetimepicker" value="{{ \Carbon\Carbon::now()->format('d-m-Y h:i A') }}">
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('end_date') has-error @enderror">
                                <label for="end_date">{{ trans('app.end_date') }} <i class="text-danger">*</i></label>
                                <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" value="{{ \Carbon\Carbon::now()->addHours(8)->format('d-m-Y h:i A') }}">
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>
                <label for="">{{ trans('app.image') }}</label>
                <br />
                <br />
                <!--begin::Image input-->
                <div class="image-input image-input-outline" data-mv-image-input="true" style="background-image: url('{{ asset(theme()->getMediaUrlPath() . 'icons/duotune/general/gen006.svg') }}')">
                    <!--begin::Preview existing avatar-->
                    <div class="image-input-wrapper w-250px h-250px" style="background-image: url('{{ asset(theme()->getMediaUrlPath() . 'icons/duotune/general/gen006.svg') }}');"></div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-mv-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--begin::Inputs-->
                        <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="logo_remove" />
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->
                    <!--begin::Cancel-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-mv-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Cancel-->
                    <!--begin::Remove-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-mv-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Remove-->
                </div>
                <!--end::Image input-->
                <br />
                <br />
                @can('choose location')
                <div class="fv-row mb-7">
                    <div class="form-group @error('location_id') has-error @enderror">
                        <label class="fs-6 form-label fw-bolder text-dark">Location</label>
                        <!--begin::Select-->
                        <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Location" tabindex="-1" aria-hidden="true" name="location_id" id="location_id" multiple="multiple" data-close-on-select="false">
                            @foreach($locations as $_location)
                            <option value="{{ $_location->id }}" {{ in_array($_location->id, explode(",", auth()->user()->location_id))?"selected":"" }}>{{ $_location->name }}</option>
                            @endforeach
                        </select>                        
                        <!--end::Select-->
                        <span class="text-danger">{{ $errors->first('location_id') }}</span>
                    </div>
                </div>
                @else
                <div class="fv-row mb-7">
                    <div class="form-group @error('location_id') has-error @enderror">
                        <label class="fs-6 form-label fw-bolder text-dark">Location</label>
                        <input class="form-control form-control-solid" placeholder="Location" name="location" value="{{  auth()->user()->location->name }}" readonly />
                        <input type="hidden" name="location_id" id="location_id" value="{{ auth()->user()->location_id }}" />
                        <span class="text-danger">{{ $errors->first('location_id') }}</span>
                    </div>
                </div>
                @endcan
                <input type="hidden" name="locations" id="locations" value="" />
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <div class="form-group @error('active') has-error @enderror">
                        <label for="name">{{ trans('app.active') }}</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="active" id="active" checked>
                        </div>
                        <span class="text-danger">{{ $errors->first('active') }}</span>
                    </div>
                </div>
                <!--end::Input group-->


                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-alert-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-alert-modal-action="submit">
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