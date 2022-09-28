<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end" data-mv-menu-flip="top-end">
    ...
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
    {{-- {!! theme()->getSvgIcon("icons/duotune/arrows/arr072.svg", "svg-icon-5 m-0") !!} --}}
    <!--end::Svg Icon-->
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-mv-menu="true">   
    @can('view scheduled reports')
    <!--begin::Menu item-->    
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-scheduledreports-table-filter="schedule_row" data-scheduledreport-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#mv_modal_scheduledreports_schedule">
            Schedule
        </a>
    </div>    
    <!--end::Menu item-->
    <!--begin::Menu item-->
    @if($model->hasHistory())
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-scheduledreports-table-filter="history_row" data-scheduledreport-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#mv_modal_scheduledreports_history">
            History
        </a>
    </div>
    @endif
    <!--end::Menu item-->
    @endcan
    @can('edit scheduled reports')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-scheduledreports-table-filter="edit_row" data-scheduledreport-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#mv_modal_edit_scheduledreport">
            Edit
        </a>
    </div>
    <!--end::Menu item-->
    @endcan  
    @can('delete scheduled reports')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-scheduledreports-table-filter="delete_row">
            Delete
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
</div>