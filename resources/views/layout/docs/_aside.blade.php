@php
    if (theme()->isDarkModeEnabled()) {
        if (theme()->getCurrentMode() === 'dark') {
            $logoPath = theme()->getOption('layout', 'docs/logo-path/dark');
        } else {
            $logoPath = theme()->getOption('layout', 'docs/logo-path/default');
        }
    } else {
        $logoPath = theme()->getOption('layout', 'docs/logo-path/default');
    }
@endphp

<!--begin::Aside-->
<div
    id="mv_docs_aside"
    class="docs-aside"
    data-mv-drawer="true"
    data-mv-drawer-name="aside"
    data-mv-drawer-activate="{default: true, lg: false}"
    data-mv-drawer-overlay="true"
    data-mv-drawer-width="{default:'200px', '300px': '250px'}"
    data-mv-drawer-direction="start"
    data-mv-drawer-toggle="#mv_docs_aside_toggle">

    <!--begin::Logo-->
    <div class="docs-aside-logo flex-column-auto h-75px" id="mv_docs_aside_logo">
        <!--begin::Link-->
        <a href="{{ theme()->getPageUrl('') }}">
            <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . $logoPath) }}" class="{{ theme()->getOption('layout', 'docs/logo-class') }}"/>
        </a>
        <!--end::Link-->
    </div>
    <!--end::Logo-->

    <!--begin::Menu-->
    <div class="docs-aside-menu flex-column-fluid">
        @include('layout/docs/_menu')
    </div>
    <!--end::Menu-->
</div>
<!--end::Aside-->
