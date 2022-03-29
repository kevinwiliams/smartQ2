<!--begin::Modal - Adjust Balance-->
<div class="modal fade" id="mv_modal_export_users" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-650px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">Export Users</h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-users-modal-action="close">
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
					<!--begin::Form-->
					<form id="mv_modal_export_users_form" class="form" action="#">
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--begin::Label-->
							<label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select name="role" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bolder">
								<option></option>
								@foreach($roles as $_role)
								<option value="{{ $_role->name }}">{{ ucwords($_role->name) }}</option>
								@endforeach
							</select>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold form-label mb-2">Select Export Format:</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select name="format" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bolder">
								<option></option>
								<option value="excel">Excel</option>
								<option value="pdf">PDF</option>
								<option value="cvs">CVS</option>
								<option value="zip">ZIP</option>
							</select>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="text-center">
							<button type="reset" class="btn btn-light me-3" data-mv-users-modal-action="cancel">Discard</button>
							<button type="submit" class="btn btn-primary" data-mv-users-modal-action="submit">
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
	<!--end::Modal - New Card-->