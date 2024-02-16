<!--begin::Action=-->
<td class="text-end">
    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">...
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->

        <!--end::Svg Icon-->
    </a>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-mv-menu="true">
        @if($model->visitreasons()->pluck('reason')->count() > 0)
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" data-id="{{$model->id}}" data-action="edit" data-mv-visitreason-table-filter="edit_row" data-bs-toggle="modal" data-id="{{ $model->id }}" name="edit" class="menu-link px-3">Edit</a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" data-id="{{$model->id}}" data-action="delete" data-mv-visitreason-table-filter="delete_row" data-bs-toggle="modal" data-id="{{ $model->id }}" name="delete" class="menu-link px-3">Delete</a>
        </div>
        <!--end::Menu item-->
        @else
        <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#mv_modal_add_reasonforvisit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new reason for visit">Add</a>
        </div>
        @endif
    </div>
    <!--end::Menu-->
</td>
<!--end::Action=-->