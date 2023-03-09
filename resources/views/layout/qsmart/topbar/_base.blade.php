@php
    $toolbarButtonMarginClass = "ms-1 ms-lg-3";
    $toolbarButtonHeightClass = "w-40px h-40px";
    $toolbarUserAvatarHeightClass = "symbol-40px";
    $toolbarButtonIconSizeClass = "svg-icon-1";
@endphp

{{--begin::Toolbar wrapper--}}
<div class="d-flex align-items-stretch flex-shrink-0">
    {{--begin::Search--}}
    {{-- <div class="d-flex align-items-stretch {{ $toolbarButtonMarginClass }}">
        {{ theme()->getView('partials/search/_base') }}
    </div> --}}
    {{--end::Search--}}
    @can('view configuration')
        {{--begin::Display screens--}}
    <div class="d-flex align-items-center {{ $toolbarButtonMarginClass }}">
        {{--begin::drawer toggle--}}
        <div class="btn btn-icon btn-active-light-primary {{ $toolbarButtonHeightClass }}" id="mv_activities_toggle">
            {!! theme()->getSvgIcon("icons/duotune/electronics/elc004.svg", $toolbarButtonIconSizeClass) !!}
        </div>
        {{--end::drawer toggle--}}
    </div>
    {{--end::Display screens--}}
    @endcan
    

    {{--begin::Notifications--}}
    <div class="d-flex align-items-center {{ $toolbarButtonMarginClass }}">
        {{--begin::Menu--}}
        {{-- <div class="btn btn-icon btn-active-light-primary position-relative {{ $toolbarButtonHeightClass }}" data-mv-menu-trigger="click" data-mv-menu-attach="parent" data-mv-menu-placement="bottom-end">
            {!! theme()->getSvgIcon("icons/duotune/communication/com012.svg", $toolbarButtonIconSizeClass) !!}

            <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink">
            </span>
        </div>
        {{ theme()->getView('partials/topbar/_notifications-menu') }} --}}
        {{--end::Menu--}}
    </div>
    {{--end::Notifications--}}

    {{--begin::Quick links--}}
    <div class="d-flex align-items-center {{ $toolbarButtonMarginClass }}">
        {{--begin::Menu--}}
        {{-- <div class="btn btn-icon btn-active-light-primary {{ $toolbarButtonHeightClass }}" data-mv-menu-trigger="click" data-mv-menu-attach="parent" data-mv-menu-placement="bottom-end">
            {!! theme()->getSvgIcon("icons/duotune/general/gen025.svg", $toolbarButtonIconSizeClass) !!}
        </div>
        {{ theme()->getView('partials/topbar/_quick-links-menu') }} --}}
        {{--end::Menu--}}
    </div>
    {{--end::Quick links--}}

    {{--begin::User--}}
    @if(Auth::check())
        <div class="d-flex align-items-center {{ $toolbarButtonMarginClass }}" id="mv_header_user_menu_toggle">
            {{--begin::Menu--}}
            <div class="cursor-pointer symbol {{ $toolbarUserAvatarHeightClass }}" data-mv-menu-trigger="click" data-mv-menu-attach="parent" data-mv-menu-placement="bottom-end">
                <img src="{{ auth()->user()->avatarUrl }}" alt="metronic"/>
            </div>
            {{ theme()->getView('partials/topbar/_user-menu') }}
            {{--end::Menu--}}
        </div>
    @endif
    {{--end::User --}}

    {{--begin::Heaeder menu toggle--}}
    @if(theme()->getOption('layout', 'header/left') === 'menu')
        <div class="d-flex align-items-center d-lg-none ms-2 me-n3" data-bs-toggle="tooltip" title="Show header menu">
            <div class="btn btn-icon btn-active-light-primary" id="mv_header_menu_mobile_toggle">
                {!! theme()->getSvgIcon("icons/duotune/text/txt001.svg", "svg-icon-1") !!}
            </div>
        </div>
    @endif
    {{--end::Heaeder menu toggle--}}
</div>
{{--end::Toolbar wrapper--}}
