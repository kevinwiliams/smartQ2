<input type="hidden" name="id" value="{{ $department->id}}">
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('name') has-error @enderror">
        <label for="name">{{ trans('app.name') }} <i class="text-danger">*</i></label>
        <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('app.name') }}" value="{{ old('name')?old('name'):$department->name}}">
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('description') has-error @enderror">
        <label for="description">{{ trans('app.description') }} </label> 
        <textarea name="description" id="description" class="form-control" placeholder="{{ trans('app.description') }}">{{ old('description')?old('description'):$department->description}}</textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('key') has-error @enderror">
        <label for="key">{{ trans('app.key_for_keyboard_mode') }} </label><br/>
        {{ Form::select('key', $keyList, (old("key")?old("key"):$department->key), ['data-placeholder' => trans('app.select_option'), 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}<br/>
        <span class="text-danger">{{ $errors->first('key') }}</span>
    </div>
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('status') has-error @enderror">
        <label for="status">{{ trans('app.status') }} <i class="text-danger">*</i></label>
        <div id="status"> 
            <label class="radio-inline">
                <input type="radio" name="status" value="1" {{ ((old('status') || $department->status)==1)?"checked":"" }}> {{ trans('app.active') }}
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" {{ ((old('status') || $department->status)==0)?"checked":"" }}> {{ trans('app.deactive') }}
            </label> 
        </div>
    </div>  
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="fv-row mb-7">
    <div class="form-group @error('avg_wait_time') has-error @enderror">
        <label for="name">{{ trans('app.avg_wait_time') }} <i class="text-danger">*</i></label>
        <input type="number" name="avg_wait_time" id="avg_wait_time" class="form-control" placeholder="{{ trans('app.avg_wait_time') }}" value="{{ old('avg_wait_time')?old('avg_wait_time'):$department->avg_wait_time }}">
        <span class="text-danger">{{ $errors->first('avg_wait_time') }}</span>
    </div>
</div>
<!--end::Input group-->
<!--begin::Actions-->
<div class="text-center pt-15">
    <button type="reset" class="btn btn-light me-3" data-mv-dept-edit-modal-action="cancel">Discard</button>
    <button type="submit" class="btn btn-primary" data-mv-dept-edit-modal-action="submit" >
        <span class="indicator-label">Submit</span>
        <span class="indicator-progress">Please wait...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>