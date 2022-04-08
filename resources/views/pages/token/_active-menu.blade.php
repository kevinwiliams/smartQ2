<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end" data-mv-menu-flip="top-end">
    ...
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
    {{-- {!! theme()->getSvgIcon("icons/duotune/arrows/arr072.svg", "svg-icon-5 m-0") !!} --}}
    <!--end::Svg Icon-->
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-mv-menu="true">
    @can('check-in token')
    @if ($model->status == 3)
        <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-token-table-filter="checkin_row">
            Check In
        </a>
    </div>
    <!--end::Menu item-->
    @endif
    @endcan
    @can('complete token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-token-table-filter="complete_row">
            Complete
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
    @can('transfer token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-token-table-filter="transfer_row" data-bs-toggle="modal" data-bs-target="#mv_modal_transfer_token">
            Transfer
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
    @can('stop token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-token-table-filter="cancel_row">
            Cancel
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-token-table-filter="print_row">
            Print
        </a>
    </div>
    <!--end::Menu item-->
    @can('delete token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-mv-token-table-filter="delete_row">
            Delete
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
</div>