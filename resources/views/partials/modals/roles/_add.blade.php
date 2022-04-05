	<!--begin::Modal - Add role-->
	<div class="modal fade" id="mv_modal_add_role" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-750px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">Add a Role</h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-roles-modal-action="close">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						{!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body scroll-y mx-lg-5 my-7">
					<!--begin::Form-->
					{{ Form::open(['url' => 'apps/user-management/roles', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_role_form']) }}
					@csrf
					<!-- {{ csrf_field() }} -->
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y me-n7 pe-7" id="mv_modal_add_role_scroll" data-mv-scroll="true" data-mv-scroll-activate="{default: false, lg: true}" data-mv-scroll-max-height="auto" data-mv-scroll-dependencies="#mv_modal_add_role_header" data-mv-scroll-wrappers="#mv_modal_add_role_scroll" data-mv-scroll-offset="300px">
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--begin::Label-->
							<label class="fs-5 fw-bolder form-label mb-2">
								<span class="required">Role name</span>
							</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--begin::Label-->
							<label class="fs-5 fw-bolder form-label mb-2">
								<span class="required">Role description</span>
							</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea class="form-control form-control-solid" placeholder="Enter a role description" name="role_description"></textarea>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Checkbox-->
							<label class="form-check form-check-custom form-check-solid me-9">
								<input class="form-check-input" type="checkbox" value="1" name="role_core" id="mv_roles_core" />
								<span class="form-check-label" for="mv_roles_core">Set as core role</span>
							</label>
							<!--end::Checkbox-->
						</div>
						<!--end::Input group-->
						<!--begin::Disclaimer-->
						<div class="text-gray-600 pb-5">Role set as a
							<strong class="me-1">Core Role</strong>will be locked and
							<strong class="me-1">not deletable</strong>in future
						</div>
						<!--end::Disclaimer-->
				
						<!--end::Input group-->
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
												<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Allows a full access to the system" aria-label="Allows a full access to the system"></i>
											</td>
											<td colspan="2">
												<!--begin::Checkbox-->
												<label class="form-check form-check-custom form-check-solid me-9">
													<input class="form-check-input" type="checkbox" value="" id="mv_roles_select_all">
													<span class="form-check-label" for="mv_roles_select_all">Select all</span>
												</label>
												<!--end::Checkbox-->
											</td>

											<td>

											</td>
										</tr>
										<!--end::Table row-->
										@for($i = 0; $i < count($permissions); $i++) 
											@if($i % 2 == 0)
											 <tr>
											@endif								
											<!--begin::Label-->
											<td class="text-gray-800">
												<label for="chkPermissions{{ $permissions[$i]->id }}">
													{{ ucwords($permissions[$i]->name) }}
													<div class="text-muted">{{ $permissions[$i]->description }}</div>
												</label>
											</td>
											<!--end::Label-->
											<!--begin::Options-->
											<td width="1%">
												<!--begin::Wrapper-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
														<input class="form-check-input" type="checkbox" value="{{ $permissions[$i]->id }}" name="permissions[]" id="chkPermissions{{ $permissions[$i]->id }}">
													</label>
													<!--end::Checkbox-->
												</div>
												<!--end::Wrapper-->
											</td>
											<!--end::Options-->
											@if($i % 2 == 1)
											</tr>
											@endif
											@endfor

											@if((count($permissions)-1) % 2 == 0)
												<td></td>
												<td></td>
											</tr>
											@endif							

									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Table wrapper-->
						</div>
					</div>
					<!--end::Scroll-->
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-mv-roles-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-mv-roles-modal-action="submit">
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
	<!--end::Modal - Add role-->