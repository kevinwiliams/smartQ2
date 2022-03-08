<input type="hidden" name="id" value="{{ $counter->id}}">
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('name') has-error @enderror">
        <label for="name">{{ trans('app.name') }} <i class="text-danger">*</i></label>
        <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('app.name') }}" value="{{ old('name')?old('name'):$counter->name }}">
        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
    </div>
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('description') has-error @enderror">
        <label for="description">{{ trans('app.description') }} </label> 
        <textarea name="description" id="description" class="form-control" placeholder="{{ trans('app.description') }}">{{ old('description')?old('description'):$counter->description }}</textarea>
        <span class="help-block text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('status') has-error @enderror">
        <label for="status">{{ trans('app.status') }} <i class="text-danger">*</i></label>
        <div id="status"> 
            <label class="radio-inline">
                <input type="radio" name="status" value="1" {{ ((old('status') || $counter->status)==1)?"checked":"" }}> {{ trans('app.active') }}
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" {{ ((old('status') || $counter->status)==0)?"checked":"" }}> {{ trans('app.deactive') }}
            </label> 
        </div>
    </div>  
</div>
<!--end::Input group-->


<!--begin::Actions-->
<div class="text-center pt-15">
    <button type="reset" class="btn btn-light me-3" data-kt-counter-edit-modal-action="cancel">Discard</button>
    <button type="submit" class="btn btn-primary" data-kt-counter-edit-modal-action="submit" >
        <span class="indicator-label">Submit</span>
        <span class="indicator-progress">Please wait...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>