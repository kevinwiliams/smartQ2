<x-base-layout>
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('Customise Display Settings') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

        <!--begin::Card body-->
        <div class="card-body">
            {{ Form::open(['url' => 'admin/settings/display', 'class'=>'row']) }}

        <input type="hidden" name="id" value="{{ $setting->id }}">
     
        <div class="col-md-6 col-lg-6">
            <div class="fv-row mb-7">
                <div class="form-group @error('display') has-error @enderror">
                    <?php 
                        $display = [
                            '1' => trans('app.display_1'),
                            '2' => trans('app.display_2'),
                            '3' => trans('app.display_3'), 
                            '4' => trans('app.display_4'), 
                            '5' => trans('app.display_5')
                        ]; 
                    ?>
                    <label for="display">{{ trans('app.display') }} </label><br/>
                    {{ Form::select('display', $display , $setting->display , ['placeholder' => trans('app.select_option'), 'class'=>'select2 form-control']) }}<br/>
                    <span class="text-danger">{{ $errors->first('display') }}</span>
                </div> 
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('message') has-error @enderror">
                    <label for="message">{{ trans('app.message') }}</label> 
                    <textarea type="text" name="message" id="message" class="form-control" placeholder="{{ trans('app.message') }}">{{ $setting->message }}</textarea>
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                </div> 
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('direction') has-error @enderror">
                    <label for="direction">{{ trans('app.direction') }}</label>
                    <div id="direction">  
                        <label class="radio-inline">
                            <input type="radio" name="direction" value="left" {{ (($setting->direction)=='left')?"checked":"" }}> {{ trans('app.left') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="direction" value="right" {{ (($setting->direction)=='right')?"checked":"" }}> {{ trans('app.right') }}
                        </label> 
                    </div>
                </div> 
            </div>
    
            <div class="fv-row mb-7">
                <div class="form-group @error('time_format') has-error @enderror">
                    <label for="time_format">{{ trans('app.time_format') }} </label><br/>
                    {{ Form::select('time_format', ['h:i:s A' => '12 Hour', 'H:i:s' => '24 Hour'], $setting->time_format , ['id'=>'time_format', 'class'=>'select2 form-control']) }}<br/>
                    <span class="text-danger">{{ $errors->first('time_format') }}</span>
                </div> 
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('date_format') has-error @enderror">
                    <?php 
                        $dates = [
                            'd M, Y' => date('d M, Y'),
                            'F j, Y' => date('F j, Y'),
                            'd/m/Y'  => date('d/m/Y'),
                            'm.d.y'  => date('m.d.y') 
                        ]; 
                    ?>
                    <label for="date_format">{{ trans('app.date_format') }} </label><br/>
                    {{ Form::select('date_format', $dates , $setting->date_format , ['placeholder' => trans('app.select_option'), 'id'=>'date_format', 'class'=>'select2 form-control']) }}<br/>
                    <span class="text-danger">{{ $errors->first('date_format') }}</span>
                </div> 
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('color') has-error @enderror">
                    <label for="color">{{ trans('app.color') }}</label> 
                    <input type="color" name="color" id="color" class="form-control" placeholder="{{ trans('app.color') }}" value="{{ $setting->color }}">
                    <span class="text-danger">{{ $errors->first('color') }}</span>
                </div>
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('background_color') has-error @enderror">
                    <label for="background_color">{{ trans('app.background_color') }}</label> 
                    <input type="color" name="background_color" class="form-control" id="background_color" placeholder="{{ trans('app.background_color') }}" value="{{ $setting->background_color }}">
                    <span class="text-danger">{{ $errors->first('background_color') }}</span>
                </div>
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('border_color') has-error @enderror">
                    <label for="border_color">{{ trans('app.border_color') }}</label>
                    <input type="color" name="border_color" id="border_color" class="form-control" placeholder="{{ trans('app.border_color') }}" value="{{ $setting->border_color }}"> 
                    <span class="text-danger">{{ $errors->first('border_color') }}</span>
                </div>
            </div>
        </div>
  

        <div class="col-md-6 col-lg-6">

            <div class="fv-row mb-7">
                <div class="form-group">
                    <h2 for="corn_info">Cron Job Setting for SMS Alert</h2>
                    <div class="bg-light card p-2" id="corn_info">
                        You only need to add the following Cron entry to your server to activate schedule sms.  
                        <p class="text-success">* * * * * wget -q -t 5 -O - "http://yourdomain.com/<strong class="text-danger" title="Actual Path of Artisan file">jobs/sms/</strong> </p> 
                    </div>
                </div>
            </div>
            
            <div class="fv-row mb-7">
                <div class="form-group @error('alert_position') has-error @enderror">
                    <label for="alert_position">{{ trans('app.alert_position') }} <span>(Position of Waiting Before Process)</span></label>
                    <input type="text" name="alert_position" id="alert_position" class="form-control" placeholder="{{ trans('app.alert_position') }}" value="{{ $setting->alert_position }}">
                    <span class="text-danger">{{ $errors->first('alert_position') }}</span>
                </div>
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('sms_alert') has-error @enderror">
                    <label for="sms_alert">{{ trans('app.sms_alert') }}</label>
                    <div id="sms_alert">  
                        <label class="radio-inline">
                            <input type="radio" name="sms_alert" value="1" {{ (($setting->sms_alert)=='1')?"checked":"" }}> {{ trans('app.active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sms_alert" value="0" {{ (($setting->sms_alert)=='0')?"checked":"" }}> {{ trans('app.deactive') }}
                        </label> 
                    </div>
                </div> 
            </div>
            
            <div class="fv-row mb-7">
                <div class="form-group @error('show_officer') has-error @enderror">
                    <label for="show_officer">{{ trans('app.show_officer') }}</label>
                    <div id="show_officer">  
                        <label class="radio-inline">
                            <input type="radio" name="show_officer" value="1" {{ (($setting->show_officer)=='1')?"checked":"" }}> {{ trans('app.active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="show_officer" value="0" {{ (($setting->show_officer)=='0')?"checked":"" }}> {{ trans('app.deactive') }}
                        </label> 
                    </div>
                </div> 
            </div>

            <div class="fv-row mb-7">         
                <div class="form-group @error('show_department') has-error @enderror">
                    <label for="show_department">{{ trans('app.show_department') }}</label>
                    <div id="show_department">  
                        <label class="radio-inline">
                            <input type="radio" name="show_department" value="1" {{ (($setting->show_department)=='1')?"checked":"" }}> {{ trans('app.active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="show_department" value="0" {{ (($setting->show_department)=='0')?"checked":"" }}> {{ trans('app.deactive') }}
                        </label> 
                    </div>
                </div> 
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('show_note') has-error @enderror">
                    <label for="show_note">{{ trans('app.show_note') }}</label>
                    <div id="show_note">  
                        <label class="radio-inline">
                            <input type="radio" name="show_note" value="1" {{ (($setting->show_note)=='1')?"checked":"" }}> {{ trans('app.active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="show_note" value="0" {{ (($setting->show_note)=='0')?"checked":"" }}> {{ trans('app.deactive') }}
                        </label> 
                    </div>
                </div> 
            </div>

            <div class="fv-row mb-7">
                <div class="form-group @error('keyboard_mode') has-error @enderror">
                    <label for="keyboard_mode">{{ trans('app.keyboard_mode') }}</label>
                    <div id="keyboard_mode">  
                        <label class="radio-inline">
                            <input type="radio" name="keyboard_mode" value="1" {{ (($setting->keyboard_mode)=='1')?"checked":"" }}> {{ trans('app.active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="keyboard_mode" value="0" {{ (($setting->keyboard_mode)=='0')?"checked":"" }}> {{ trans('app.deactive') }}
                        </label> 
                    </div>
                </div>
            </div>

            <div class="fv-row mb-7">
                <div class="form-group">
                    <button class="button btn btn-info" type="reset"><span>{{ trans('app.reset') }}</span></button>
                    <button class="button btn btn-success" type="submit"><span>{{ trans('app.update') }}</span></button> 
                </div>
            </div>

        </div>
        
        {{ Form::close() }}
        </div>
    </div>
</x-base-layout>