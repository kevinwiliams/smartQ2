<x-base-layout>
	<!--begin::Sidebar-->
	<div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
		<!--begin::Card-->
		<div class="card card-flush">
			<!--begin::Card header-->
			<div class="card-header">
				<!--begin::Card title-->
				<div class="card-title">
					<h2 class="mb-0">Developer</h2>
				</div>
				<!--end::Card title-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Permissions-->
				<div class="d-flex flex-column text-gray-600">
					<div class="d-flex align-items-center py-2">
					<span class="bullet bg-primary me-3"></span>Some Admin Controls</div>
					<div class="d-flex align-items-center py-2">
					<span class="bullet bg-primary me-3"></span>View Financial Summaries only</div>
					<div class="d-flex align-items-center py-2">
					<span class="bullet bg-primary me-3"></span>View and Edit API Controls</div>
					<div class="d-flex align-items-center py-2">
					<span class="bullet bg-primary me-3"></span>View Payouts only</div>
					<div class="d-flex align-items-center py-2">
					<span class="bullet bg-primary me-3"></span>View and Edit Disputes</div>
					<div class="d-flex align-items-center py-2 d-none">
						<span class='bullet bg-primary me-3'></span>
						<em>and 3 more...</em>
					</div>
				</div>
				<!--end::Permissions-->
			</div>
			<!--end::Card body-->
			<!--begin::Card footer-->
			<div class="card-footer pt-0">
				<button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
			</div>
			<!--end::Card footer-->
		</div>
		<!--end::Card-->
		<!--begin::Modal-->
		<!--begin::Modal - Update role-->
		<div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-750px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header">
						<!--begin::Modal title-->
						<h2 class="fw-bolder">Update Role</h2>
						<!--end::Modal title-->
						<!--begin::Close-->
						<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
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
					<div class="modal-body scroll-y mx-5 my-7">
						<!--begin::Form-->
						<form id="kt_modal_update_role_form" class="form" action="#">
							<!--begin::Scroll-->
							<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="fs-5 fw-bolder form-label mb-2">
										<span class="required">Role name</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" value="Developer" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Permissions-->
								<div class="fv-row">
									<!--begin::Label-->
									<label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
									<!--end::Label-->
									<!--begin::Table wrapper-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5">
											<!--begin::Table body-->
											<tbody class="text-gray-600 fw-bold">
												<!--begin::Table row-->
												<tr>
													<td class="text-gray-800">Administrator Access
													<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allows a full access to the system"></i></td>
													<td>
														<!--begin::Checkbox-->
														<label class="form-check form-check-sm form-check-custom form-check-solid me-9">
															<input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
															<span class="form-check-label" for="kt_roles_select_all">Select all</span>
														</label>
														<!--end::Checkbox-->
													</td>
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">User Management</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="user_management_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="user_management_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="user_management_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Content Management</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="content_management_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="content_management_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="content_management_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Financial Management</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="financial_management_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="financial_management_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="financial_management_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Reporting</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="reporting_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="reporting_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="reporting_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Payroll</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="payroll_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="payroll_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="payroll_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Disputes Management</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="disputes_management_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="disputes_management_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="disputes_management_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">API Controls</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="api_controls_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="api_controls_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="api_controls_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Database Management</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="database_management_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="database_management_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="database_management_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
												<!--begin::Table row-->
												<tr>
													<!--begin::Label-->
													<td class="text-gray-800">Repository Management</td>
													<!--end::Label-->
													<!--begin::Input group-->
													<td>
														<!--begin::Wrapper-->
														<div class="d-flex">
															<!--begin::Checkbox-->
															<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="repository_management_read" />
																<span class="form-check-label">Read</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
																<input class="form-check-input" type="checkbox" value="" name="repository_management_write" />
																<span class="form-check-label">Write</span>
															</label>
															<!--end::Checkbox-->
															<!--begin::Checkbox-->
															<label class="form-check form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="" name="repository_management_create" />
																<span class="form-check-label">Create</span>
															</label>
															<!--end::Checkbox-->
														</div>
														<!--end::Wrapper-->
													</td>
													<!--end::Input group-->
												</tr>
												<!--end::Table row-->
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Table wrapper-->
								</div>
								<!--end::Permissions-->
							</div>
							<!--end::Scroll-->
							<!--begin::Actions-->
							<div class="text-center pt-15">
								<button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
								<button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
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
		<!--end::Modal - Update role-->
		<!--end::Modal-->
	</div>
	<!--end::Sidebar-->
	<!--begin::Content-->
	<div class="flex-lg-row-fluid ms-lg-10">
		<!--begin::Card-->
		<div class="card card-flush mb-6 mb-xl-9">
			<!--begin::Card header-->
			<div class="card-header pt-5">
				<!--begin::Card title-->
				<div class="card-title">
					<h2 class="d-flex align-items-center">Users Assigned
					<span class="text-gray-600 fs-6 ms-1">(14)</span></h2>
				</div>
				<!--end::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<!--begin::Search-->
					<div class="d-flex align-items-center position-relative my-1" data-kt-view-roles-table-toolbar="base">
						<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
						<span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
						<input type="text" data-kt-roles-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Users" />
					</div>
					<!--end::Search-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">Delete Selected</button>
					</div>
					<!--end::Group actions-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
					<!--begin::Table head-->
					<thead>
						<!--begin::Table row-->
						<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
							<th class="w-10px pe-2">
								<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
									<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_roles_view_table .form-check-input" value="1" />
								</div>
							</th>
							<th class="min-w-50px">ID</th>
							<th class="min-w-150px">User</th>
							<th class="min-w-125px">Joined Date</th>
							<th class="text-end min-w-100px">Actions</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID5636</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-6.jpg" alt="Emma Smith" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
									<span>e.smith@kpmg.com.au</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>15 Apr 2021, 6:43 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID1249</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label fs-3 bg-light-danger text-danger">M</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Melody Macy</a>
									<span>melody@altbox.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>10 Mar 2021, 5:20 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID7717</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-1.jpg" alt="Max Smith" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Max Smith</a>
									<span>max@kt.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>21 Feb 2021, 6:43 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID2301</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Sean Bean</a>
									<span>sean@dellito.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>25 Jul 2021, 6:05 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID5031</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-25.jpg" alt="Brian Cox" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Brian Cox</a>
									<span>brian@exchange.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>25 Oct 2021, 2:40 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID3122</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label fs-3 bg-light-warning text-warning">C</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Mikaela Collins</a>
									<span>mikaela@pexcom.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>22 Sep 2021, 11:05 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID9316</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-9.jpg" alt="Francis Mitcham" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Francis Mitcham</a>
									<span>f.mitcham@kpmg.com.au</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>10 Mar 2021, 5:20 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID2530</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label fs-3 bg-light-danger text-danger">O</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Olivia Wild</a>
									<span>olivia@corpmail.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>10 Mar 2021, 11:05 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID5933</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label fs-3 bg-light-primary text-primary">N</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Neil Owen</a>
									<span>owen.neil@gmail.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>10 Nov 2021, 6:43 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID3114</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-23.jpg" alt="Dan Wilson" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Dan Wilson</a>
									<span>dam@consilting.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>15 Apr 2021, 9:23 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID2693</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label fs-3 bg-light-danger text-danger">E</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Bold</a>
									<span>emma@intenso.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>10 Mar 2021, 10:10 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID8103</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Ana Crown</a>
									<span>ana.cf@limtel.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>24 Jun 2021, 5:20 pm</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID6259</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label fs-3 bg-light-info text-info">A</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Robert Doe</a>
									<span>robert@benko.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>15 Apr 2021, 10:30 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>ID4744</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="../../demo1/dist/apps/user-management/users/view.html">
										<div class="symbol-label">
											<img src="assets/media/avatars/300-13.jpg" alt="John Miller" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">John Miller</a>
									<span>miller@mapple.com</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>24 Jun 2021, 6:43 am</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
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
	</div>
</x-base-layout>		
			