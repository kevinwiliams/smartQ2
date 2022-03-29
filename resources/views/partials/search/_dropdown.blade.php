<!--begin::Search-->
<div
    id="mv_header_search"
    class="d-flex align-items-stretch"

    data-mv-search-keypress="true"
    data-mv-search-min-length="2"
    data-mv-search-enter="enter"
    data-mv-search-layout="menu"

    data-mv-menu-trigger="auto"
    data-mv-menu-overflow="false"
    data-mv-menu-permanent="true"
    data-mv-menu-placement="bottom-end"

    {{ isset($attributes) ? util()->putHtmlAttributes($attributes) : '' }}
   >

    <!--begin::Search toggle-->
    <div class="d-flex align-items-center" data-mv-search-element="toggle" id="mv_header_search_toggle">
        <div class="{{ $toggleBtnClass }}">
            {!! $toggleBtnIcon ?? theme()->getSvgIcon('icons/duotune/general/gen021.svg', $toggleBtnIconClass ?? 'svg-icon-1') !!}
        </div>
    </div>
    <!--end::Search toggle-->

    <!--begin::Menu-->
    <div data-mv-search-element="content" class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
        <!--begin::Wrapper-->
        <div data-mv-search-element="wrapper">
            {{ theme()->getView('partials/search/partials/_form') }}

            {{ theme()->getView('partials/search/partials/_results') }}

            {{ theme()->getView('partials/search/partials/_main', array('mode' => 'dropdown')) }}

            {{ theme()->getView('partials/search/partials/_empty') }}
        </div>
        <!--end::Wrapper-->

        {{ theme()->getView('partials/search/partials/_advanced-options') }}

        {{ theme()->getView('partials/search/partials/_preferences') }}
    </div>
    <!--end::Menu-->
</div>
<!--end::Search-->
