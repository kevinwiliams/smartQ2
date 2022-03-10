<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    ...
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
    {{-- {!! theme()->getSvgIcon("icons/duotune/arrows/arr072.svg", "svg-icon-5 m-0") !!} --}}
    <!--end::Svg Icon-->
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
    @if ($token->status == 0)
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{url("admin/token/complete/$token->id")}}" class="menu-link px-3">
            Complete
        </a>
    </div>
    <!--end::Menu item-->
    @endif
    @if ($token->status != 0 || !empty($token->updated_at))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{url("admin/token/recall/$token->id")}}" class="menu-link px-3">
            Recall
        </a>
    </div>
    <!--end::Menu item-->
    @endif
    @if ($token->status == 0)
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{url("admin/token/stoped/$token->id")}}" class="menu-link px-3">
            Cancel
        </a>
    </div>
    <!--end::Menu item-->
    @endif
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{url("admin/token/print")}}" class="menu-link px-3" >
            Print
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-report-table-filter="delete_row">
            Delete
        </a>
    </div>
    <!--end::Menu item-->
</div>