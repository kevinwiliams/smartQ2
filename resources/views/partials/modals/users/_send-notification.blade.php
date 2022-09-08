<div class="modal fade" id="mv_modal_send_notification" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bolder">Send Notification</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-users-modal-action="close">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
					{!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
					<!--end::Svg Icon-->
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				<!--begin::Form-->

				{{ Form::open(['url' => 'apps/user-management/users/sendnotification/', 'class'=>'transferFrm', 'id'=>'mv_modal_send_notification_form']) }}
				
				<!--begin::Input group-->
				<div class="fv-row mb-7">
					<!--begin::Label-->
					<label class="fs-6 fw-bold form-label mb-2">
						<span class="required">Notification Type</span>
					</label>
					<!--end::Label-->
					<div class="d-flex align-items-center mt-3">
						<input type="hidden" value="{{ $user->id }}" id="user_id" name="user_id"  />
						@if($user->email && $user->email_verified_at)
						<div class="form-check form-check-custom form-check-solid me-5">
							<input class="form-check-input" type="radio" value="email" id="flexRadioDefault" name="notification_type"  />
							<label class="form-check-label" for="flexRadioDefault">
							{{ trans('app.email') }}
							</label>
						</div>
						@endif

						@if($user->mobile)
						<div class="form-check form-check-custom form-check-solid me-5">
							<input class="form-check-input" type="radio" value="sms" id="flexRadioChecked"  name="notification_type" />
							<label class="form-check-label" for="flexRadioChecked">
							{{ trans('app.sms') }}
							</label>
						</div>
						@endif
						@if($user->user_token && $user->push_notifications)
						<div class="form-check form-check-custom form-check-solid">
							<input class="form-check-input" type="radio" value="push"  id="flexRadioDisabled"  name="notification_type"/>
							<label class="form-check-label" for="flexRadioDisabled">
							{{ trans('app.push_notification') }}
							</label>
						</div>
						@endif
					</div>
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="fv-row mb-7">
					<!--begin::Label-->
					<label class="fs-6 fw-bold form-label mb-2">
						<span class="required">{{ trans('app.message') }}</span>
					</label>
					<!--end::Label-->
					<!--begin::Input-->
					<textarea name="message" id="message" class="form-control" placeholder="{{ trans('app.message') }}"></textarea>					
					<!--end::Input-->
				</div>
				<!--end::Input group-->
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