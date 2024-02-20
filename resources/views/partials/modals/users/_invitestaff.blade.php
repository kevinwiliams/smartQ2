	<!--begin::Modal - Add task-->
	<div class="modal fade" id="mv_modal_add_staff" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-650px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header" id="mv_modal_add_staff_header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">Invite User</h2>
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
					{{ Form::open(['url' => 'invitation/inviteStaff', 'class'=>'transferFrm', 'id'=>'mv_modal_add_staff_form', 'enctype'=>'multipart/form-data']) }}
					<input type="hidden" name="location_id" value="{{ $location_id }}" />
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y me-n7 pe-7" id="mv_modal_add_staff_scroll" data-mv-scroll="true" data-mv-scroll-activate="{default: false, lg: true}" data-mv-scroll-max-height="auto" data-mv-scroll-dependencies="#mv_modal_add_staff_header" data-mv-scroll-wrappers="#mv_modal_add_staff_scroll" data-mv-scroll-offset="300px">												
						<span id="error_message" class="text-danger"></span>
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold mb-2">
								<span>Email</span>
								<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Email address must be active"></i>
							</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="mb-7">
							<!--begin::Label-->
							<label class="required fw-bold fs-6 mb-5">Role</label>
							<!--end::Label-->
							<!--begin::Roles-->
							@php
							$cntr = 1;
							$limit = count($roles);
							@endphp
							@foreach($roles as $_role)
							<!--begin::Input row-->
							<div class="d-flex fv-row">
								<!--begin::Radio-->
								<div class="form-check form-check-custom form-check-solid">
									<!--begin::Input-->
									<input class="form-check-input me-3" name="user_role" type="radio" value="{{ $_role->id }}" id="mv_modal_update_role_option_0" {{ ($cntr == 1)?'checked="checked"':''}} />
									<!--end::Input-->
									<!--begin::Label-->
									<label class="form-check-label" for="mv_modal_update_role_option_0">
										<div class="fw-bolder text-gray-800">{{ ucwords($_role->name) }}</div>
										<div class="text-gray-600">{{ $_role->description }}</div>
									</label>
									<!--end::Label-->
								</div>
								<!--end::Radio-->
							</div>
							<!--end::Input row-->
							@if($cntr < $limit) <div class='separator separator-dashed my-5'>
						</div>
						@endif
						@php
						$cntr++;
						@endphp
						@endforeach
						<!--end::Roles-->
					</div>
					<!--end::Input group-->
				</div>
				<!--end::Scroll-->
				<!--begin::Actions-->
				<div class="text-center pt-15">
					<button type="reset" class="btn btn-light me-3" data-mv-users-modal-action="cancel">Discard</button>
					<button type="submit" class="btn btn-primary" data-mv-users-modal-action="submit">
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
	<!--end::Modal - Add task-->