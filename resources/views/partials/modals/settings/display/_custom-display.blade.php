<div class="modal fade customDisplayModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px"> 
      {{ Form::open(['url' => 'location/settings/display/custom', 'class'=>'form',  'id'=>'customFrm']) }}
      <!--begin::Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <!--begin::Modal title-->
           <h2 class="fw-bolder"><?= trans('app.custom_display') ?></h2>
           <!--end::Modal title-->
           <!--begin::Close-->
           <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-custom-display-modal-action="close">
               <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
               {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
               <!--end::Svg Icon-->
           </div>
           <!--end::Close-->

        </div>
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">  
          <div class="alert mb-1"></div>
  
          <input type="hidden" name="id" value="">
          <input type="hidden" name="location_id" value="{{$location->id}}">
          <div class="fv-row mb-7">
            <div class="form-group @error('name') has-error @enderror">
                <label class="fs-6 fw-bold form-label mb-2" for="name">{{ trans('app.name') }} <i class="text-danger">*</i></label> 
                <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="eg:- Floor 1">
                <span class="text-danger"></span>
            </div>
          </div>

          <div class="fv-row mb-7">
            <div class="form-group @error('description') has-error @enderror">
                <label for="description">{{ trans('app.description') }}</label> 
                <textarea type="text" name="description" id="description" class="form-control" placeholder="{{ trans('app.description') }}"></textarea>
                <span class="text-danger"></span>
            </div>
          </div>
  

          <div class="fv-row mb-7">
            <div class="form-group @error('name') has-error @enderror">
                <label for="counters">{{ trans('app.counter') }} <i class="text-danger">*</i></label><br/>
                {{-- {{ Form::select('counters[]', $counters, null, ['id'=>'counters', 'class'=>'select2 form-control', 'multiple'=>'true']) }}<br/> --}}
                {{ Form::select('counters[]', $counters, null, ['id'=>'counters', 'multiple'=>'multiple', 'data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                <br>
                <span class="text-danger"></span>
            </div>
          </div> 
     
          
          <div class="fv-row mb-7">
            <div class="form-group @error('status') has-error @enderror">
              <label for="status">{{ trans('app.status') }} <i class="text-danger">*</i></label>
              <div id="status"> 
                  <label class="radio-inline">
                      <input type="radio" name="status" value="1" checked> {{ trans('app.active') }}
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="status" value="0"> {{ trans('app.deactive') }}
                  </label> 
              </div>
              <span class="text-danger"></span>
          </div>
          </div>   
        </div>
        <!--begin::Modal footer-->
        <div class="modal-footer flex-center">
          <!--begin::Button-->
          <button type="reset" class="btn btn-light me-3" data-mv-custom-display-modal-action="cancel">Discard</button>
          <!--end::Button-->
          <!--begin::Button-->
          <button type="submit" class="btn btn-primary" data-mv-custom-display-modal-action="submit">
              <span class="indicator-label">{{ trans('app.save') }}</span>
              <span class="indicator-progress">Please wait...
              <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
          </button>
          <!--end::Button-->
      </div>
      <!--end::Modal footer-->
      </div>
      {{ Form::close() }}
    </div>
  </div> 