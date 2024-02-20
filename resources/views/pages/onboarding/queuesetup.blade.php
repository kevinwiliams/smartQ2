<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_setup">
        {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Queue Setup Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            <h5>Set up your queues</h5>
            <br />
            <div class="row">
                <!-- setting form -->
                <div class="col-sm-6 col-lg-5">
                    <h3 class="fw-bolder mt-4">{{ __('Assign Counters') }}</h3>


                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        {{ Form::open(['url' => 'location/token/setting/'.$location->id, 'class'=>'manualFrm form', 'id'=>'mv_modal_add_config_form']) }}
                        <input type="hidden" name="location_id" value="{{ $location->id }}">
                        <div class="fv-row mb-7">
                            <div class="form-group @error('department_id') has-error @enderror">
                                <label class="form-label fs-6 fw-bold" for="department_id">{{ trans('app.department') }} <i class="text-danger">*</i></label><br />
                                {{ Form::select('department_id', $departmentList, null, ['placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold filter']) }}<br />
                                <span class="text-danger">{{ $errors->first('department_id') }}</span>
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <div class="form-group @error('counter_id') has-error @enderror">
                                <label class="form-label fs-6 fw-bold" for="counter">{{ trans('app.counter') }} <i class="text-danger">*</i></label><br />
                                {{ Form::select('counter_id', $countertList, null, ['placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold filter' ]) }}<br />
                                <span class="text-danger">{{ $errors->first('counter_id') }}</span>
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <div class="form-group @error('user_id') has-error @enderror">
                                <label class="form-label fs-6 fw-bold" for="officer">{{ trans('app.officer') }} <i class="text-danger">*</i></label><br />
                                {{ Form::select('user_id', $userList, null, ['placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold filter']) }}<br />
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <div class="btn-group">
                                <!-- <button type="reset" class="btn btn-primary" data-mv-queuesetup-modal-action="reset">{{ trans('app.reset') }}</button> -->
                                <button type="submit" class="btn btn-success" data-mv-queuesetup-modal-action="submit">
                                    <span class="indicator-label">{{ __('Add Config') }}</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>

                <!-- display setting option -->
                <div class="col-sm-6 col-lg-7 pt-5">

                    <table class="display table" width="100%" cellspacing="0" name="mv_queue_config" id="mv_queue_config">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                {{-- <th>#</th>  --}}
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
                                {{-- <td>{{ $sl++ }}</td> --}}
                                <td>{{ $token->department }}</td>
                                <td>{{ $token->counter }}</td>
                                <td>{{ $token->firstname }} {{ $token->lastname }}</td>
                                <td>
                                    <a href="#" data-id="{{ $token->id }}" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-mv-queue-table-filter="delete" title="Delete">
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
        <div class="card-footer p-4 mt-4 text-center">
            <div class="card-toolbar">
                <button type="button" class="btn btn-warning" data-mv-setup-modal-action="back">
                    <span class="indicator-label">Back</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <button type="submit" class="btn btn-primary" data-mv-setup-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <!-- <a>Skip for now >></a> -->
            </div>
        </div>

    </div>
    <!--end::Container-->

    <!--end::Post-->

    @section('scripts')
    <script>
        $(document).ready(function() {
            $('#mv_queue_config').dataTable({
                "info": false,
            });
        });
    </script>

    @endsection
</x-base-layout>