<!--begin::Action--->
<td class="text-end">
    <!--begin::Update-->
    <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-mv-permissions-action="edit" id="btnViewSMS{{ $model->id }}" >
        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
        {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-3") !!}

        <!--end::Svg Icon-->
    </button>
    <!--end::Update-->
    <button data-mv-smshistory-table-filter="delete_row" data-id="{{ $model->id }}" id="btnDeleteSMS{{ $model->id }}" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
        {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
        <!--end::Svg Icon-->
    </button>

</td>
<!--end::Action--->