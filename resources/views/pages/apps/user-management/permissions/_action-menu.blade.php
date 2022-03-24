<!--begin::Action=-->
<td class="text-end">
    <!--begin::Update-->
    <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-kt-permissions-action="edit" data-id="{{ $model->id }}" data-name="{{ $model->name }}" id="btnEditPerm{{ $model->id }}"{{ (!$model->editable)?'disabled':'' }}>
        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
            </svg>
        </span>
        <!--end::Svg Icon-->
    </button>
    <!--end::Update-->
    <!--begin::Delete-->
    <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row" data-id="{{ $model->id }}" id="btnDeletePerm{{ $model->id }}" {{ (!$model->editable)?'disabled':'' }}>
        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
            </svg>
        </span>
        <!--end::Svg Icon-->
    </button>
    <!--end::Delete-->
</td>
<!--end::Action=-->