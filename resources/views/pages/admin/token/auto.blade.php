<x-base-layout>
    <div class="col-sm-12" id="screen-content">
        @if($display->sms_alert || $display->show_note)
            <!-- With Mobile No -->
            @foreach ($departmentList as $department) 
            <div class="p-1 m-1 btn btn-primary capitalize text-center">
                <button 
                    type="button" 
                    class="p-1 m-1 btn btn-primary capitalize text-center"
                    style="min-width: 15vw;white-space: pre-wrap;box-shadow:0px 0px 0px 2px#<?= substr(dechex(crc32($department->name)), 0, 6); ?>" 
                    data-toggle="modal" 
                    data-target="#tokenModal"
                    data-department-id="{{ $department->department_id }}"
                    data-counter-id="{{ $department->counter_id }}"
                    data-user-id="{{ $department->user_id }}"
                    >
                        <h5>{{ $department->name }}</h5>
                        <h6>{{ $department->officer }}</h6>
                </button>  
            </div>
            @endforeach  
            <!--Ends of With Mobile No -->
        @else
            <!-- Without Mobile No -->
            @foreach ($departmentList as $department )
              {{ Form::open(['url' => 'admin/token/auto', 'class' => 'AutoFrm p-1 m-1 btn btn-primary capitalize text-center']) }} 
                <input type="hidden" name="department_id" value="{{ $department->department_id }}">
                <input type="hidden" name="counter_id" value="{{ $department->counter_id }}">
                <input type="hidden" name="user_id" value="{{ $department->user_id }}"><button type="submit" 
                class="p-1 m-5 btn btn-primary capitalize text-center"
                style="min-width: 15vw;white-space: pre-wrap;box-shadow:0px 0px 0px 2px#<?= substr(dechex(crc32($department->name)), 0, 6); ?>" 
                ><div class="symbol symbol-60px mb-5"><img src="{{ asset(theme()->getMediaUrlPath() . "svg/misc/infography.svg" ?? '') }}" class="h-50 align-self-center" alt=""/>
                <div class="fs-5 fw-bolder mb-0">{{ $department->name }}</div><div class="fs-7 fw-bold text-gray-100">{{ $department->officer }}</div>
</button>
            {{ Form::close() }}
@endforeach <!--Ends of Without Mobile No -->@endif</div>  
</x-base-layout>