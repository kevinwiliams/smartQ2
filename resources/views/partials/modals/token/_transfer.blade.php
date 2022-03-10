<div class="modal fade" id="kt_modal_transfer_token" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        {{ Form::open(['url' => 'admin/token/transfer', 'class'=>'transferFrm']) }}
        <!--begin::Form-->
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.transfer_a_token_to_another_counter') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-tokens-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
            {{-- <div class="alert hide"></div> --}}
            <input type="hidden" name="id">
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <label class="form-label fs-6 fw-bold">Department:</label>
                        {{ Form::select('department_id', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-kt-report-table-filter' => 'departments' ,'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-sm fw-bold']) }}

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <label class="form-label fs-6 fw-bold">Counter:</label>
                        {{ Form::select('counter_id', $counters, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-kt-report-table-filter' => 'counters', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-sm fw-bold']) }}

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <label class="form-label fs-6 fw-bold">Officers:</label>
                        {{ Form::select('user_id', $officers, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-kt-report-table-filter' => 'officers', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-sm fw-bold']) }}
                    </div>
                    <!--end::Input group-->
                </div>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="reset" class="btn btn-light me-3" data-kt-token-modal-action="cancel">Discard</button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" class="btn btn-primary" data-kt-token-modal-action="submit">
                    <span class="indicator-label">{{ trans('app.transfer') }}</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
         <!--end::Form-->
         {{ Form::close() }}
    </div>
    <!--end::Modal dialog-->
</div>