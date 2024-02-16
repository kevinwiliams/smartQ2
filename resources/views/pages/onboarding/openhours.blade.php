<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_edit_openhours">
    {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Opening Hours Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            <h5>Tell us about your opening hours</h5>
            <br />
            <!--begin::Form-->
            {{ Form::open(['url' => 'onboarding/editOpenhours/' . $location_id , 'class'=>'manualFrm form', 'id'=>'mv_modal_edit_openhours_form']) }}
            <!-- {{ csrf_field() }} -->
            <input type="hidden" name="openhours_edit_id" id="openhours_edit_id" value="{{ $location_id }}">
            <table class="table">
                <tr>
                    @php
                    $_startTime = '09:00 AM';
                    $_endTime = '05:00 PM';
                    $sunday = $hours->where('day',0)->first();
                    $isOpen = ($sunday)?$sunday->is_open:'false';
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
                    $isOpen = ($saturday)?$saturday->is_open:'false';
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
            {{ Form::close() }}
            <!--end::Form-->
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <!-- <button type="button" class="btn btn-secondary">
                    Back
                </button> -->
                <button type="submit" class="btn btn-primary" data-mv-openhours-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!-- <a href="#">Skip for now >></a> -->
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        $(document).ready(function() {
            var optional_config = {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K"

            };
            $(".timepicker").flatpickr(optional_config);

            $("select[name^='is_open_']").on("change", function() {
                var obj = $(this);
                var _isOpen = obj.find(":selected").val();
                var key = obj.attr('name').split('_')[2];

                switch (_isOpen) {
                    case 'all':
                        $('#start_time_' + key + ',#end_time_' + key).hide();
                        break;
                    case 'true':
                        $('#start_time_' + key + ',#end_time_' + key).show();
                        break;
                    case 'false':
                        $('#start_time_' + key + ',#end_time_' + key).hide();
                        break;
                    default:
                        break;
                }
            });
            $("select[name^='is_open_']").trigger('change');
        });
    </script>

    @endsection
</x-base-layout>