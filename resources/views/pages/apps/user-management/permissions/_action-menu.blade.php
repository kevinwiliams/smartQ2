<!--begin::Action=-->
<td class="text-end">
    <!--begin::Update-->
    <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-kt-permissions-action="edit" data-id="{{ $model->id }}" data-name="{{ $model->name }}" data-description="{{ $model->description }}" id="btnEditPerm{{ $model->id }}"{{ (!$model->editable)?'disabled':'' }}>
        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
        {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-3") !!}

        <!--end::Svg Icon-->
    </button>
    <!--end::Update-->
    <!--begin::Delete-->
    <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row" data-id="{{ $model->id }}" id="btnDeletePerm{{ $model->id }}" {{ (!$model->editable)?'disabled':'' }}>  
        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
        {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}

        <!--end::Svg Icon-->
    </button>
    <!--end::Delete-->
</td>
<!--end::Action=-->