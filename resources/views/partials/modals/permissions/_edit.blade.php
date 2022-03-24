<div class="modal fade" id="kt_modal_update_permission" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-650px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">Update Permission</h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
					<!--begin::Notice-->
					<!--begin::Notice-->
					<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
						<!--begin::Icon-->
						<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
						<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
								<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
								<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
						<!--end::Icon-->
						<!--begin::Wrapper-->
						<div class="d-flex flex-stack flex-grow-1">
							<!--begin::Content-->
							<div class="fw-bold">
								<div class="fs-6 text-gray-700">
									<strong class="me-1">Warning!</strong>By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.
								</div>
							</div>
							<!--end::Content-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Notice-->
					<!--end::Notice-->
					<!--begin::Form-->
					<form id="kt_modal_update_permission_form" class="form" action="#">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 fw-bold form-label mb-2">
								<span class="required">Permission Name</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Permission names is required to be unique."></i>
							</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input class="form-control form-control-solid" placeholder="Enter a permission name" name="permission_name" />
                            <input name="permission_id" type="hidden" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="text-center pt-15">
							<button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Discard</button>
							<button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
								<span class="indicator-label">Submit</span>
								<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
						<!--end::Actions-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>