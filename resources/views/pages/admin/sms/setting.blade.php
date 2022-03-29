<x-base-layout>

        <div class="row">
            <div class="col-5">
                {!! Form::open(['url' => 'admin/sms/setting', 'class' => '']) !!}
            @csrf <!-- {{ csrf_field() }} --> 
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">{{ __('SMS API Details') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        {!! Form::hidden('id', $setting->id) !!}

                        <div class="form-group @error('provider') has-error @enderror">
                            <label for="provider">{{ trans('app.provider') }}<i class="text-danger">*</i></label><br/>
                            {{ Form::select('provider', ["nexmo"=>"Nexmo", "clickatell"=>"Click A Tell", "robi"=>"Robi","budgetsms"=>"Budget SMS", "campaigntag"=>"Campaign Tag"], (old('provider')?old('provider'):$setting->provider), ["id"=>"provider", "class"=>"select2 form-control"]) }}<br/>
                            <span class="text-danger">{{ $errors->first('provider') }}</span>
                        </div>

                        <div class="form-group @error('api_key') has-error @enderror">
                            <label for="api_key">{{ trans('app.api_key') }}<i class="text-danger">*</i></label>
                            <input type="text" name="api_key" id="api_key" class="form-control" placeholder="{{ trans('app.api_key') }}" value="{{ old('api_key')?old('api_key'):$setting->api_key }}">
                            <span class="text-danger">{{ $errors->first('api_key') }}</span>
                        </div>
                        
                        <div class="form-group @error('username') has-error @enderror">
                            <label for="username">{{ trans('app.username') }}<i class="text-danger">*</i></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="{{ trans('app.username') }}" value="{{ old('username')?old('username'):$setting->username }}">
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        </div>

                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password">{{ trans('app.password') }}<i class="text-danger">*</i></label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="{{ trans('app.password') }}" value="{{ old('password')?old('password'):$setting->password }}">
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                        
                        <div class="form-group @error('from') has-error @enderror">
                            <label for="from">{{ trans('app.from') }}<i class="text-danger">*</i></label>
                            <input type="text" name="from" id="from" class="form-control" placeholder="{{ trans('app.from') }}" value="{{ old('form')?old('form'):$setting->from }}">
                            <span class="text-danger">{{ $errors->first('from') }}</span>
                            <span class="text-info">(number for click-a-tell and any string for others)</span>
                        </div>

                        <div class="form-group text-center pt-15">
                            <button class="btn btn-light me-3" type="reset"><span>{{ trans('app.reset') }}</span></button>
                            <button class="button btn btn-success" type="submit"><span>{{ trans('app.update') }}</span></button> 
                        </div>
                    </div>
                </div>
            
            </div>
        
            <div class="col-sm-7">
                <div class="card card-body">
                    <label >Available variables for SMS</label>
                    <div class=" card card-body bg-light pb-0">
                       
                        <dl class="row">
                            <dt class="col-sm-3">[TOKEN]</dt><dd class="col-sm-9"> - token no</dd>
                            <dt class="col-sm-3">[MOBILE]</dt><dd class="col-sm-9"> - client mobile</dd>
                            <dt class="col-sm-3">[DEPARTMENT]</dt><dd class="col-sm-9"> - department name</dd>
                            <dt class="col-sm-3">[COUNTER]</dt><dd class="col-sm-9"> - counter name</dd>
                            <dt class="col-sm-3">[OFFICER]</dt><dd class="col-sm-9"> - officer name</dd>
                            <dt class="col-sm-3">[WAIT]</dt><dd class="col-sm-9"> - officer name</dd>
                            <dt class="col-sm-3">[DATE]</dt><dd class="col-sm-9"> - date time</dd>
                        </dl>
                    </div>
    
                    <div class="form-group @error('sms_template') has-error @enderror pt-5" >
                        <label for="sms_template">{{ trans('app.sms_template') }} <i class="text-danger">*</i></label>
                        <textarea name="sms_template" id="sms_template" class="form-control" placeholder="{{ trans('app.sms_template') }}" rows="3">{{ old('sms_template')?old('sms_template'):$setting->sms_template }}</textarea>
                        <span class="text-danger">{{ $errors->first('sms_template') }}</span>
                    </div>
    
                    <div class="form-group @error('recall_sms_template') has-error @enderror pt-5">
                        <label for="recall_sms_template">{{ trans('app.recall_sms_template') }} <i class="text-danger">*</i></label>
                        <textarea name="recall_sms_template" id="recall_sms_template" class="form-control" placeholder="{{ trans('app.recall_sms_template') }}" rows="3">{{ old('recall_sms_template')?old('recall_sms_template'):$setting->recall_sms_template }}</textarea>
                        <span class="text-danger">{{ $errors->first('recall_sms_template') }}</span>
                    </div>  
                </div>


                  
            </div> 
            {{ Form::close() }}
        </div>
 
</x-base-layout>