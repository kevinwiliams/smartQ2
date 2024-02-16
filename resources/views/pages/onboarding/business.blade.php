<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_add_company">
    {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Business Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            <h5>Tell us about your business</h5>
            <br />
            <!--begin::Form-->
            {{ Form::open(['url' => 'onboarding/createCompany', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_company_form']) }}
            @csrf
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ trans('app.logo') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline {{ isset($company) && $company->logo ? '' : 'image-input-empty' }}" data-mv-image-input="true" style="background-image: url({{ asset(theme()->getMediaUrlPath() . 'icons/duotune/general/gen006.svg') }})">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset(theme()->getMediaUrlPath() . 'icons/duotune/general/gen006.svg') }}');"></div>
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

                    <!--begin::Hint-->
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.business_category_id') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    {{ Form::select('business_category_id', $categories->pluck('name', 'id'), (isset($company) && $company->business_category_id ? $company->business_category_id : null), ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold', 'id' => 'business_category_id']) }}
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.name') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="name" id="name" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.name') }}" value="{{ old('name', $company->name) }}">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="">{{ trans('app.shortname') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="shortname" id="shortname" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.shortname') }}" value="{{ old('shortname', $company->shortname) }}">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.address') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="address" id="address" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.address') }}" value="{{ old('address', $company->address) }}">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="">{{ trans('app.website') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="website" id="website" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.website') }}" value="{{ old('website', $company->website) }}">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.email') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="email" name="email" id="email" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.email') }}" value="{{ old('email', $company->email) }}">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.phone') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="phone" id="phone" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.phone') }}" value="{{ old('phone', $company->phone) }}" data-inputmask="'mask': '1 (999) 999-9999'">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.contact_person') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="contact_person" id="contact_person" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.contact_person') }}" value="{{ old('contact_person', auth()->user()->name) }}">
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ trans('app.description') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <textarea name="description" id="description" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.description') }}">{{ old('description', $company->description) }}</textarea>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <input type="hidden" value="1" name="active" id="active">            
            <input type="hidden" value="{{ $company->id }}" name="id" id="id">       

            {{ Form::close() }}
            <!--end::Form-->
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary" data-mv-company-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <!-- <a>Skip for now >></a> -->
            </div>
        </div>
    </div>
    @section('scripts')


    @endsection
</x-base-layout>