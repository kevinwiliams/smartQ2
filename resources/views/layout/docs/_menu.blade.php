<!--begin::Aside Menu-->
@php
    $menu = new \App\Core\Adapters\Menu(theme()->getOption('menu', 'documentation'), theme()->getPagePath());

    $menu->setItemLinkClass("py-2");

    $menu->addCallback("heading", function($heading) {
        $html  = '<h4 class="menu-content text-muted mb-0 fs-7 text-uppercase">';
        $html .= $heading;
        $html .= '</h4>';

        return $html;
    });
@endphp

<div
    class="hover-scroll-overlay-y mb-5 mb-lg-5"
    id="mv_docs_aside_menu_wrapper"
    data-mv-scroll="true"
    data-mv-scroll-activate="{default: false, lg: true}"
    data-mv-scroll-height="auto"
    data-mv-scroll-dependencies="#mv_docs_aside_logo"
    data-mv-scroll-wrappers="#mv_docs_aside_menu"
    data-mv-scroll-offset="10px"
>
    <!--begin::Menu-->
    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#mv_docs_aside_menu" data-mv-menu="true">
        {!! $menu->build() !!}
    </div>
    <!--end::Menu-->
</div>
