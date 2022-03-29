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
                            <textarea class="form-control form-control-solid" placeholder="Enter a role description" name="role_description" ></textarea>	                        
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
						<div class="text-gray-600">Role set as a
							<strong class="me-1">Core Role</strong>will be locked and
							<strong class="me-1">not deletable</strong>in future
						</div>
						<!--end::Disclaimer-->
	                    <!--begin::Input group-->
	                    <div class="fv-row mb-7 pt-15">
	                        <div class="form-group @error('permissions') has-error @enderror">
	                            <label class="fs-6 fw-bolder form-label mb-2" for="permissions"><span class="required">{{ trans('app.permissions') }}</span>
	                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Please select valid permissions"></i></label>
	                            {{ Form::select('permissions[]', $permissions, null, ['data-placeholder' => 'Select Permissions', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold' ,'multiple'=>'multiple']) }}
	                            <span class="text-danger">{{ $errors->first('permissions') }}</span>
	                        </div>
	                    </div>
	                    <!--end::Input group-->	     
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