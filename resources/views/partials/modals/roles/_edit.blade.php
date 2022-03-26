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
						{!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body scroll-y mx-5 my-7">
					<!--begin::Form-->
					{{ Form::open(['url' => 'apps/user-management/roles/update/', 'class'=>'manualFrm form', 'id'=>'kt_modal_update_role_form']) }}
					@csrf
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
							<input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" id="role_name" value="" />
							<input type="hidden" name="role_id" id="role_id" value="" />
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
							<textarea class="form-control form-control-solid" placeholder="Enter a role description" name="role_description" id="role_description"></textarea>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<div class="form-group @error('permissions') has-error @enderror">
								<label class="fs-6 fw-bolder form-label mb-2" for="permissions"><span class="required">{{ trans('app.permissions') }}</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Please select valid permissions"></i></label>
								{{ Form::select('permissions[]', $permissions, null, ['data-placeholder' => 'Select Permissions', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold' ,'multiple'=>'multiple' , 'id'=>'ddlPermissions']) }}
								<span class="text-danger">{{ $errors->first('permissions') }}</span>
							</div>
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Checkbox-->
							<label class="form-check form-check-custom form-check-solid me-9">
								<input class="form-check-input" type="checkbox" value="1" name="role_core" id="kt_roles_core" />
								<span class="form-check-label" for="kt_roles_core">Set as core role</span>
							</label>
							<!--end::Checkbox-->
						</div>
						<!--end::Input group-->
						<!--begin::Disclaimer-->
						<div class="text-gray-600">Role set as a
							<strong class="me-1">Core Role</strong>will be locked and
							<strong class="me-1">not deletable</strong>in future
						</div>
						<!--end::Disclaimer-->
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
					{{ Form::close() }}
					<!--end::Form-->
				</div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - Update role-->