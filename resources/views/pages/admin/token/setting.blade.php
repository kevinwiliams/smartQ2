<x-base-layout>
    <div class="row">
        <!-- setting form -->
            <div class="col-sm-6 col-lg-5">  
                <div class="card">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('Add Dept to Auto Q') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <div class="card-body p-9">
                {{ Form::open(['url' => 'admin/token/setting']) }}

                    <div class="form-group @error('department_id') has-error @enderror">
                        <label for="department_id">{{ trans('app.department') }} <i class="text-danger">*</i></label><br/>
                        {{ Form::select('department_id', $departmentList, null, ['placeholder' => 'Select Option', 'class'=>'select2 form-control']) }}<br/>
                        <span class="text-danger">{{ $errors->first('department_id') }}</span>
                    </div> 

                    <div class="form-group @error('counter_id') has-error @enderror">
                        <label for="counter">{{ trans('app.counter') }} <i class="text-danger">*</i></label><br/>
                        {{ Form::select('counter_id', $countertList, null, ['placeholder' => 'Select Option', 'class'=>'select2 form-control']) }}<br/>
                        <span class="text-danger">{{ $errors->first('counter_id') }}</span> 
                    </div> 

                    <div class="form-group @error('user_id') has-error @enderror">
                        <label for="officer">{{ trans('app.officer') }} <i class="text-danger">*</i></label><br/>
                        {{ Form::select('user_id', $userList, null, ['placeholder' => 'Select Option', 'class'=>'select2 form-control']) }}<br/>
                        <span class="text-danger">{{ $errors->first('user_id') }}</span>
                    </div> 
                    
                    <div class="btn-group">
                        <button type="reset" class="btn btn-primary">{{ trans('app.reset') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('app.save') }}</button> 
                    </div>
                
                {{ Form::close() }}
                </div>
                </div>
            </div>

            <!-- display setting option -->
            <div class="col-sm-6 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <table class="display table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th> 
                                    <th>{{ trans('app.department') }}</th>
                                    <th>{{ trans('app.counter') }}</th>
                                    <th>{{ trans('app.officer') }}</th> 
                                    <th></th>
                                </tr>
                            </thead> 
                            <tbody>
        
                                @if (!empty($tokens))
                                    <?php $sl = 1 ?>
                                    @foreach ($tokens as $token)
                                        <tr>
                                            <td>{{ $sl++ }}</td> 
                                            <td>{{ $token->department }}</td>
                                            <td>{{ $token->counter }}</td>
                                            <td>{{ $token->firstname }} {{ $token->lastname }}</td>
                                            <td>
                                                <div class="btn-group">   
                                                    {{-- <a href="{{ url("admin/token/setting/delete/$token->id") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                                </div>
        
                                                <a href="{{ url("admin/token/setting/delete/$token->id") }}" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
                                                    <!--end::Svg Icon-->
                                                </a>
                                            </td>
                                        </tr> 
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                
            </div>

        </div>
</x-base-layout>