	<!--begin::Modal - Add role-->
	<div class="modal fade" id="mv_modal_add_reason_for_visit" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-750px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">{{ empty($tokens[0]->reason_for_visit)? "Add " :"Edit " }} Reason for Visit </h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-reasonforvisit-modal-action="close">
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
					{{ Form::open(['url' => 'token/addreasonforvisit', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_reason_for_visit_form']) }}
					@csrf
					<!-- {{ csrf_field() }} -->
					<input type="hidden" name="id" value="{{$tokens[0]->id}}">
					<!--begin::Input group-->
					<div class="fv-row mb-7">
						<div class="form-group @error('reason_for_visit') has-error @enderror">
							<label for="reason_for_visit">{{ trans('app.reason_for_visit') }}</label><br />
							@if(!empty($reasons))
							<select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Reason for Visit" aria-hidden="true" name="reason_for_visit" id="reason_for_visit" tabindex="-1" data-dropdown-parent="#mv_modal_add_reason_for_visit">
							<option value="">{{ trans('app.reason_for_visit') }}</option>
								@foreach($reasons as $reason)
								<option value="{{ $reason }}" {{ ($tokens[0]->reason_for_visit == $reason)?'selected':'' }}>{{ $reason }}</option>
								@endforeach
							</select>
							@else
							<input type="text" name="reason_for_visit" id="reason_for_visit" class="form-control" placeholder="{{ trans('app.reason') }}" value="{{ $tokens[0]->reason_for_visit }}">
							@endif
							<span class="text-danger">{{ $errors->first('reason_for_visit') }}</span>
						</div>
					</div>
					<!--end::Input group-->
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-mv-reasonforvisit-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-mv-reasonforvisit-modal-action="submit">
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