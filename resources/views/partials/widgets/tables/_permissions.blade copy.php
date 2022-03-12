	<!--begin::Card-->
	<div class="card">
		<!--begin::Card header-->
		<div class="card-header mt-6">
			<!--begin::Card title-->
			<div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1 me-5">
					<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
					{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1") !!}
					<!--end::Svg Icon-->
					<input type="text" data-kt-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Permissions" />
				</div>
				<!--end::Search-->
			</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Button-->
				<button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_permission">
				<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen035.svg", "svg-icon-3") !!}
				<!--end::Svg Icon-->Add Permission</button>
				<!--end::Button-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
		<!--begin::Card body-->
		<div class="card-body pt-0">
			<!--begin::Table-->
			<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
				<!--begin::Table head-->
				<thead>
					<!--begin::Table row-->
					<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
						<th class="min-w-125px">Name</th>
						<th class="min-w-250px">Assigned to</th>
						<th class="min-w-125px">Created Date</th>
						<th class="text-end min-w-100px">Actions</th>
					</tr>
					<!--end::Table row-->
				</thead>
				<!--end::Table head-->
				<!--begin::Table body-->
				<tbody class="fw-bold text-gray-600">
					<tr>
						<!--begin::Name=-->
						<td>User Management</td>
						<!--end::Name=-->
						<!--begin::Assigned to=-->
						<td>
							<a href="#" class="badge badge-light-primary fs-7 m-1">Administrator</a>
							<a href="#" class="badge badge-light-danger fs-7 m-1">Developer</a>
							<a href="#" class="badge badge-light-success fs-7 m-1">Analyst</a>
							<a href="#" class="badge badge-light-info fs-7 m-1">Support</a>
							<a href="#" class="badge badge-light-warning fs-7 m-1">Trial</a>
						</td>
						<!--end::Assigned to=-->
						<!--begin::Created Date-->
						<td>15 Apr 2021, 11:30 am</td>
						<!--end::Created Date-->
						<!--begin::Action=-->
						<td class="text-end">
							<!--begin::Update-->
							<button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
								<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
								{!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-3") !!}
								<!--end::Svg Icon-->
							</button>
							<!--end::Update-->
							<!--begin::Delete-->
							<button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row">
								<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
								{!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}

								<!--end::Svg Icon-->
							</button>
							<!--end::Delete-->
						</td>
						<!--end::Action=-->
					</tr>
			
		
				</tbody>
				<!--end::Table body-->
			</table>
			<!--end::Table-->
		</div>
		<!--end::Card body-->
	</div>
	<!--end::Card-->
	<!--begin::Modals-->
	<!--begin::Modal - Add permissions-->
	<div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-650px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">Add a Permission</h2>
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
					<!--begin::Form-->
					<form id="kt_modal_add_permission_form" class="form" action="#">
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
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Checkbox-->
							<label class="form-check form-check-custom form-check-solid me-9">
								<input class="form-check-input" type="checkbox" value="" name="permissions_core" id="kt_permissions_core" />
								<span class="form-check-label" for="kt_permissions_core">Set as core permission</span>
							</label>
							<!--end::Checkbox-->
						</div>
						<!--end::Input group-->
						<!--begin::Disclaimer-->
						<div class="text-gray-600">Permission set as a
						<strong class="me-1">Core Permission</strong>will be locked and
						<strong class="me-1">not editable</strong>in future</div>
						<!--end::Disclaimer-->
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
	<!--end::Modal - Add permissions-->
	<!--begin::Modal - Update permissions-->
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
								<strong class="me-1">Warning!</strong>By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.</div>
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
	<!--end::Modal - Update permissions-->
	<!--end::Modals-->