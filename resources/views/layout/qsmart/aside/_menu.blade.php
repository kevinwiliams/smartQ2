{{--begin::Aside Menu--}}
@php
    $menu = bootstrap()->getAsideMenu();
    \App\Core\Adapters\Menu::filterMenuPermissions($menu->items);
@endphp

<div
    class="hover-scroll-overlay-y my-5 my-lg-5"
    id="mv_aside_menu_wrapper"
    data-mv-scroll="true"
    data-mv-scroll-activate="{default: false, lg: true}"
    data-mv-scroll-height="auto"
    data-mv-scroll-dependencies="#mv_aside_logo, #mv_aside_footer"
    data-mv-scroll-wrappers="#mv_aside_menu"
    data-mv-scroll-offset="0"
>
    {{--begin::Menu--}}
    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#mv_aside_menu" data-mv-menu="true">
        {!! $menu->build() !!}
    </div>
    {{--end::Menu--}}
</div>
{{--end::Aside Menu--}}
