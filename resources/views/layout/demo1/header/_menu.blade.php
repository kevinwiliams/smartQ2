@php
    $menu = bootstrap()->getHorizontalMenu();
    \App\Core\Adapters\Menu::filterMenuPermissions($menu->items);
@endphp

<!--begin::Menu wrapper-->
<div class="header-menu align-items-stretch"
     data-mv-drawer="true"
     data-mv-drawer-name="header-menu"
     data-mv-drawer-activate="{default: true, lg: false}"
     data-mv-drawer-overlay="true"
     data-mv-drawer-width="{default:'200px', '300px': '250px'}"
     data-mv-drawer-direction="end"
     data-mv-drawer-toggle="#mv_header_menu_mobile_toggle"
     data-mv-swapper="true"
     data-mv-swapper-mode="prepend"
     data-mv-swapper-parent="{default: '#mv_body', lg: '#mv_header_nav'}"
>
    <!--begin::Menu-->
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
         id="#mv_header_menu"
         data-mv-menu="true"
    >
        {!! $menu->build() !!}
    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
