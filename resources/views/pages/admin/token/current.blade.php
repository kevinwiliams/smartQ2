<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                {{-- <span class="card-label fw-bolder fs-3 mb-1">Active Tokens </span>
                <span class="text-muted mt-1 fw-bold fs-7">Clients waiting: {{ $waiting }}</span> --}}
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-token-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Active Tokens">
                </div>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click create a new token">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_token">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                <!--end::Svg Icon-->New Token</a>
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->   
    
    <!--begin::Modal - Add task-->
		<div class="modal fade" id="kt_modal_add_token" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header">
						<!--begin::Modal title-->
						<h2 class="fw-bolder">Create new token</h2>
						<!--end::Modal title-->
						<!--begin::Close-->
						<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-tokens-modal-action="close">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							{!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div id="output" class="hide alert alert-danger alert-dismissible fade in shadowed mb-1"></div>
						<!--begin::Form-->
                        {{ Form::open(['url' => 'admin/token/create', 'class'=>'manualFrm form', 'id'=>'kt_modal_add_token_form']) }}
                        @csrf <!-- {{ csrf_field() }} -->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
                                {{-- @if($display->sms_alert) --}}
                                <div class="form-group @error('client_mobile') has-error @enderror">
                                    <label class="required fs-6 fw-bold form-label mb-2" for="client_mobile">{{ trans('app.client_mobile') }} </label>
                                    <input type="text" name="client_mobile" class="form-control form-control-solid" placeholder="{{ trans('app.client_mobile') }}"/>  
                                    <span class="text-danger">{{ $errors->first('client_mobile') }}</span>
                                </div>   
                                {{-- @endif --}}
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<div class="form-group @error('department_id') has-error @enderror">
                                    <label class="fs-6 fw-bold form-label mb-2" for="department_id"><span class="required">{{ trans('app.department') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Please assign the correct department"></i></label>
                                    {{ Form::select('department_id', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                </div> 
							</div>
							<!--end::Input group-->
                            <!--begin::Input group-->
							<div class="fv-row mb-7">
								<div class="form-group @error('counter_id') has-error @enderror">
                                    <label class="fs-6 fw-bold form-label mb-2" for="counter_id"><span class="required">{{ trans('app.counter') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Assign user to a counter"></i></label>
                                    {{ Form::select('counter_id', $counters, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                    <span class="text-danger">{{ $errors->first('counter_id') }}</span>
                                </div> 
							</div>
							<!--end::Input group-->
                            <!--begin::Input group-->
							<div class="fv-row mb-7">
								<div class="form-group @error('user_id') has-error @enderror">
                                    <label class="fs-6 fw-bold form-label mb-2" for="user_id"><span class="required">{{ trans('app.officer') }}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Assign user to a officer"></i></label>
                                    {{ Form::select('user_id', $officers, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                </div> 
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
                            {{-- @if($display->show_note) --}}
                                <div class="form-group @error('note') has-error @enderror">
                                    <label class="fs-6 fw-bold form-label mb-2" for="note">{{ trans('app.note') }}</label> 
                                    <textarea name="note" id="note" class="form-control form-control-solid rounded-3"  placeholder="{{ trans('app.note') }}">{{ old('note') }}</textarea>
                                    <span class="text-danger">{{ $errors->first('note') }}</span> 
                                </div>
                            {{-- @endif --}}
							</div>
							<!--end::Input group-->
                            <!--begin::Input group-->
							<div class="fv-row mb-7">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_vip">
                                    <span class="form-check-label fw-bold"> {{ trans('app.is_vip') }}</span>
                                </label>
                            </div>
                            <!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center pt-15">
								<button type="reset" class="btn btn-light me-3" data-kt-tokens-modal-action="cancel">Discard</button>
								<button type="submit" class="btn btn-primary" data-kt-tokens-modal-action="submit" >
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
    {{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            //$('#token-table').DataTable();
            alert('ready');
        } );
    </script>
@endsection
@push('scripts')

@endpush
 

</x-base-layout>