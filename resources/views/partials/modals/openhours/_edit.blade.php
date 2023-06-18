<div class="modal fade" id="mv_modal_edit_openhours" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.openhours') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-openhours-edit-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                <!-- <div id="output" class="hide alert alert-danger alert-dismissible fade in shadowed mb-1"></div> -->
                <!--begin::Form-->
                {{ Form::open(['url' => 'location/openhours/edit', 'class'=>'manualFrm form', 'id'=>'mv_modal_edit_openhours_form']) }}
                <!-- {{ csrf_field() }} -->
                <input type="hidden" name="openhours_edit_id" id="openhours_edit_id" value="{{ $location_id }}">
                <table class="table">
                <tr>
                        @php
                        $_startTime = '09:00 AM';
                        $_endTime = '05:00 PM';
                        $sunday = $hours->where('day',0)->first();
                        $isOpen = ($sunday)?$sunday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Sunday</span></td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_0') has-error @enderror">
                                {{ Form::select('is_open_0', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_0') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_0" id="start_time_0" class="form-control timepicker" value="{{ ($sunday)?$sunday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_0" id="end_time_0" class="form-control timepicker" value="{{ ($sunday)?$sunday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                    <tr>
                        @php                      
                        $monday = $hours->where('day',1)->first();
                        $isOpen = ($monday)?$monday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Monday</span>
                        </td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_1') has-error @enderror">
                                {{ Form::select('is_open_1', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_1') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_1" id="start_time_1" class="form-control timepicker" value="{{ ($monday)?$monday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_1" id="end_time_1" class="form-control timepicker" value="{{ ($monday)?$monday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                    <tr>
                        @php
                        $tuesday = $hours->where('day',2)->first();
                        $isOpen = ($tuesday)?$tuesday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Tuesday</span></td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_2') has-error @enderror">
                                {{ Form::select('is_open_2', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_2') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_2" id="start_time_2" class="form-control timepicker" value="{{ ($tuesday)?$tuesday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_2" id="end_time_2" class="form-control timepicker" value="{{ ($tuesday)?$tuesday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                    <tr>
                        @php
                        $wednesday = $hours->where('day',3)->first();
                        $isOpen = ($wednesday)?$wednesday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Wednesday</span></td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_3') has-error @enderror">
                                {{ Form::select('is_open_3', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_3') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_3" id="start_time_3" class="form-control timepicker" value="{{ ($wednesday)?$wednesday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_3" id="end_time_3" class="form-control timepicker" value="{{ ($wednesday)?$wednesday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                    <tr>
                        @php
                        $thursday = $hours->where('day',4)->first();
                        $isOpen = ($thursday)?$thursday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Thursday</span></td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_4') has-error @enderror">
                                {{ Form::select('is_open_4', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_4') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_4" id="start_time_4" class="form-control timepicker" value="{{ ($thursday)?$thursday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_4" id="end_time_4" class="form-control timepicker" value="{{ ($thursday)?$thursday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                    <tr>
                        @php
                        $friday = $hours->where('day',5)->first();
                        $isOpen = ($friday)?$friday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Friday</span></td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_5') has-error @enderror">
                                {{ Form::select('is_open_5', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_5') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_5" id="start_time_5" class="form-control timepicker" value="{{ ($friday)?$friday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_5" id="end_time_5" class="form-control timepicker" value="{{ ($friday)?$friday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                    <tr>
                        @php
                        $saturday = $hours->where('day',6)->first();
                        $isOpen = ($saturday)?$saturday->is_open:'';
                        @endphp
                        <td class="w-25 align-middle"><span class="fw-bold fs-4">Saturday</span></td>
                        <td class="w-25">
                            <div class="form-group @error('is_open_6') has-error @enderror">
                                {{ Form::select('is_open_6', \App\Core\Data::getIsOpenStatuses(), $isOpen, ['data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                <span class="text-danger">{{ $errors->first('is_open_6') }}</span>
                            </div>
                        </td>
                        <td class="w-25"><input type="text" name="start_time_6" id="start_time_6" class="form-control timepicker" value="{{ ($saturday)?$saturday->start_time->format('h:i A'):$_startTime }}"></td>
                        <td class="w-25"><input type="text" name="end_time_6" id="end_time_6" class="form-control timepicker" value="{{ ($saturday)?$saturday->end_time->format('h:i A'):$_endTime }}"></td>
                    </tr>
                  
                </table>


                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-openhours-edit-modal-action="cancel">Discard</button>
                    <button type="submit" class="btn btn-primary" data-mv-openhours-edit-modal-action="submit">
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