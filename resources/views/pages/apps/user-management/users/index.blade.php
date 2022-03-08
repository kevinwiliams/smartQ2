<x-base-layout>

    <!--begin::Card-->
    <div class="card">
			<!--begin::Card header-->
	<div class="card-header border-0 pt-6">
		<!--begin::Card title-->
		<div class="card-title">
			<!--begin::Search-->
			<div class="d-flex align-items-center position-relative my-1">
				<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
				<!--end::Svg Icon-->
				<input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
				<!--begin::Filter-->
				<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
				<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen031.svg", "svg-icon-2") !!}
				<!--end::Svg Icon-->Filter</button>
				<!--begin::Menu 1-->
				<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
					<!--begin::Header-->
					<div class="px-7 py-5">
						<div class="fs-5 text-dark fw-bolder">Filter Options</div>
					</div>
					<!--end::Header-->
					<!--begin::Separator-->
					<div class="separator border-gray-200"></div>
					<!--end::Separator-->
					<!--begin::Content-->
					<div class="px-7 py-5" data-kt-user-table-filter="form">
						<!--begin::Input group-->
						<div class="mb-10">
							<label class="form-label fs-6 fw-bold">Role:</label>
							<select class="form-select form-select-solid fw-bolder" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
								<option></option>
								<option value="Administrator">Administrator</option>
								<option value="Analyst">Analyst</option>
								<option value="Developer">Developer</option>
								<option value="Support">Support</option>
								<option value="Trial">Trial</option>
							</select>
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="mb-10">
							<label class="form-label fs-6 fw-bold">Two Step Verification:</label>
							<select class="form-select form-select-solid fw-bolder" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="two-step" data-hide-search="true">
								<option></option>
								<option value="Enabled">Enabled</option>
							</select>
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="d-flex justify-content-end">
							<button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
							<button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Menu 1-->
				<!--end::Filter-->
				<!--begin::Export-->
				<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
				{!! theme()->getSvgIcon("icons/duotune/arrows/arr078.svg", "svg-icon-2") !!}
				<!--end::Svg Icon-->Export</button>
				<!--end::Export-->
				<!--begin::Add user-->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
				{!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-2") !!}
				<!--end::Svg Icon-->Add User</button>
				<!--end::Add user-->
			</div>
			<!--end::Toolbar-->
			<!--begin::Group actions-->
			<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
				<div class="fw-bolder me-5">
				<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
				<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
			</div>
			<!--end::Group actions-->
			
		</div>
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-6">
            @include('pages.apps.user-management.users._table')
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
<!--begin::Modal - Adjust Balance-->
<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
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
							<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
							<form id="kt_modal_export_users_form" class="form" action="#">
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="role" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bolder">
										<option></option>
										<option value="Administrator">Administrator</option>
										<option value="Analyst">Analyst</option>
										<option value="Developer">Developer</option>
										<option value="Support">Support</option>
										<option value="Trial">Trial</option>
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
									<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
									<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
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
			<!--begin::Modal - Add task-->
			<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
				<!--begin::Modal dialog-->
				<div class="modal-dialog modal-dialog-centered mw-650px">
					<!--begin::Modal content-->
					<div class="modal-content">
						<!--begin::Modal header-->
						<div class="modal-header" id="kt_modal_add_user_header">
							<!--begin::Modal title-->
							<h2 class="fw-bolder">Add User</h2>
							<!--end::Modal title-->
							<!--begin::Close-->
							<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
							<form id="kt_modal_add_user_form" class="form" action="#">
								<!--begin::Scroll-->
								<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
									<!--begin::Input group-->
									<div class="fv-row mb-7">
										<!--begin::Label-->
										<label class="d-block fw-bold fs-6 mb-5">Avatar</label>
										<!--end::Label-->
										<!--begin::Image input-->
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset(theme()->getMediaUrlPath() . 'svg/avatars/blank.svg') }}')">
											<!--begin::Preview existing avatar-->
											<div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset(theme()->getMediaUrlPath() . 'avatars/300-6.jpg') }}');"></div>
											<!--end::Preview existing avatar-->
											<!--begin::Label-->
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7"></i>
												<!--begin::Inputs-->
												<input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
												<input type="hidden" name="avatar_remove" />
												<!--end::Inputs-->
											</label>
											<!--end::Label-->
											<!--begin::Cancel-->
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Cancel-->
											<!--begin::Remove-->
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Remove-->
										</div>
										<!--end::Image input-->
										<!--begin::Hint-->
										<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
										<!--end::Hint-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="fv-row mb-7">
										<!--begin::Label-->
										<label class="required fw-bold fs-6 mb-2">Full Name</label>
										<!--end::Label-->
										<!--begin::Input-->
										<input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="Emma Smith" />
										<!--end::Input-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="fv-row mb-7">
										<!--begin::Label-->
										<label class="required fw-bold fs-6 mb-2">Email</label>
										<!--end::Label-->
										<!--begin::Input-->
										<input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="e.smith@kpmg.com.au" />
										<!--end::Input-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="mb-7">
										<!--begin::Label-->
										<label class="required fw-bold fs-6 mb-5">Role</label>
										<!--end::Label-->
										<!--begin::Roles-->
										<!--begin::Input row-->
										<div class="d-flex fv-row">
											<!--begin::Radio-->
											<div class="form-check form-check-custom form-check-solid">
												<!--begin::Input-->
												<input class="form-check-input me-3" name="user_role" type="radio" value="0" id="kt_modal_update_role_option_0" checked='checked' />
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_0">
													<div class="fw-bolder text-gray-800">Administrator</div>
													<div class="text-gray-600">Best for business owners and company administrators</div>
												</label>
												<!--end::Label-->
											</div>
											<!--end::Radio-->
										</div>
										<!--end::Input row-->
										<div class='separator separator-dashed my-5'></div>
										<!--begin::Input row-->
										<div class="d-flex fv-row">
											<!--begin::Radio-->
											<div class="form-check form-check-custom form-check-solid">
												<!--begin::Input-->
												<input class="form-check-input me-3" name="user_role" type="radio" value="1" id="kt_modal_update_role_option_1" />
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_1">
													<div class="fw-bolder text-gray-800">Developer</div>
													<div class="text-gray-600">Best for developers or people primarily using the API</div>
												</label>
												<!--end::Label-->
											</div>
											<!--end::Radio-->
										</div>
										<!--end::Input row-->
										<div class='separator separator-dashed my-5'></div>
										<!--begin::Input row-->
										<div class="d-flex fv-row">
											<!--begin::Radio-->
											<div class="form-check form-check-custom form-check-solid">
												<!--begin::Input-->
												<input class="form-check-input me-3" name="user_role" type="radio" value="2" id="kt_modal_update_role_option_2" />
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_2">
													<div class="fw-bolder text-gray-800">Analyst</div>
													<div class="text-gray-600">Best for people who need full access to analytics data, but don't need to update business settings</div>
												</label>
												<!--end::Label-->
											</div>
											<!--end::Radio-->
										</div>
										<!--end::Input row-->
										<div class='separator separator-dashed my-5'></div>
										<!--begin::Input row-->
										<div class="d-flex fv-row">
											<!--begin::Radio-->
											<div class="form-check form-check-custom form-check-solid">
												<!--begin::Input-->
												<input class="form-check-input me-3" name="user_role" type="radio" value="3" id="kt_modal_update_role_option_3" />
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_3">
													<div class="fw-bolder text-gray-800">Support</div>
													<div class="text-gray-600">Best for employees who regularly refund payments and respond to disputes</div>
												</label>
												<!--end::Label-->
											</div>
											<!--end::Radio-->
										</div>
										<!--end::Input row-->
										<div class='separator separator-dashed my-5'></div>
										<!--begin::Input row-->
										<div class="d-flex fv-row">
											<!--begin::Radio-->
											<div class="form-check form-check-custom form-check-solid">
												<!--begin::Input-->
												<input class="form-check-input me-3" name="user_role" type="radio" value="4" id="kt_modal_update_role_option_4" />
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_4">
													<div class="fw-bolder text-gray-800">Trial</div>
													<div class="text-gray-600">Best for people who need to preview content data, but don't need to make any updates</div>
												</label>
												<!--end::Label-->
											</div>
											<!--end::Radio-->
										</div>
										<!--end::Input row-->
										<!--end::Roles-->
									</div>
									<!--end::Input group-->
								</div>
								<!--end::Scroll-->
								<!--begin::Actions-->
								<div class="text-center pt-15">
									<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
									<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
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
			<!--end::Modal - Add task-->

		
		</x-base-layout>
