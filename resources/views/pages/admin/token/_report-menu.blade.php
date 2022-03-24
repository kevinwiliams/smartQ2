<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    ...
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
    {{-- {!! theme()->getSvgIcon("icons/duotune/arrows/arr072.svg", "svg-icon-5 m-0") !!} --}}
    <!--end::Svg Icon-->
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
   @can('complete token')
       
    @if ($token->status == 0)
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-token-table-filter="complete_row">
            Complete
        </a>
    </div>
    <!--end::Menu item-->
    @endif
   @endcan

    @can('recall token')
    @if ($token->status != 0 || !empty($token->updated_at))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-token-table-filter="recall_row">
            Recall
        </a>
    </div>
    <!--end::Menu item-->
    @endif
    @endcan
    @can('transfer token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-token-table-filter="transfer_row" data-bs-toggle="modal" data-bs-target="#kt_modal_transfer_token">
            Transfer
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
    @can('stop token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-token-table-filter="cancel_row">
            Cancel
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-token-table-filter="print_row">
            Print
        </a>
    </div>
    <!--end::Menu item-->

    @can('delete token')
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-token-table-filter="delete_row">
            Delete
        </a>
    </div>
    <!--end::Menu item-->
    @endcan
</div>