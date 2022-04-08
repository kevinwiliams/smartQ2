	<!--begin::Modal - Add role-->
	<div class="modal fade" id="mv_modal_add_staff_note" tabindex="-1" aria-hidden="true">
	    <!--begin::Modal dialog-->
	    <div class="modal-dialog modal-dialog-centered mw-750px">
	        <!--begin::Modal content-->
	        <div class="modal-content">
	            <!--begin::Modal header-->
	            <div class="modal-header">
	                <!--begin::Modal title-->
	                <h2 class="fw-bolder">Add a Note </h2>
	                <!--end::Modal title-->
	                <!--begin::Close-->
	                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-notes-modal-action="close">
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
	                {{ Form::open(['url' => 'token/addnote', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_staff_note_form']) }}
	                @csrf
	                <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="id" value="{{$tokens[0]->id}}">
	                <!--begin::Scroll-->
	                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="mv_modal_add_staff_note_scroll" data-mv-scroll="true" data-mv-scroll-activate="{default: false, lg: true}" data-mv-scroll-max-height="auto" data-mv-scroll-dependencies="#mv_modal_add_staff_note_header" data-mv-scroll-wrappers="#mv_modal_add_staff_note_scroll" data-mv-scroll-offset="300px">
	                    <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="form-group @error('officer_note') has-error @enderror">
                                <label for="officer_note">{{ trans('app.officer_note') }} </label> 
                                <textarea name="officer_note" id="officer_note" class="form-control h-200px" placeholder="{{ trans('app.officer_note') }}">{{ old('officer_note')?old('officer_note'):$tokens[0]->officer_note }}</textarea>
                                {{-- <div id="officer_note" name="officer_note">{{ old('officer_note')?old('officer_note'):$tokens[0]->officer_note }}</div> --}}
                                <span class="help-block text-danger">{{ $errors->first('officer_note') }}</span>
                            </div>
                        </div>
                        <!--end::Input group-->   
	                </div>
	                <!--end::Scroll-->
	                <!--begin::Actions-->
	                <div class="text-center pt-15">
	                    <button type="reset" class="btn btn-light me-3" data-mv-notes-modal-action="cancel">Discard</button>
	                    <button type="submit" class="btn btn-primary" data-mv-notes-modal-action="submit">
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