<!--begin::Action=-->
<td class="text-end">
    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">...
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
    
    <!--end::Svg Icon--></a>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" data-id="{{$model->id}}" data-action="edit" data-kt-counter-table-filter="edit_row" data-bs-toggle="modal" name="edit" class="menu-link px-3">Edit</a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" data-id="{{$model->id}}" class="menu-link px-3" data-kt-counter-table-filter="delete_row">Delete</a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::Menu-->
</td>
<!--end::Action=-->