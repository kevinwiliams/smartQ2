@extends('base.base')

@section('content')

<!--begin::Main-->
@if (theme()->getOption('layout', 'main/type') === 'blank')
<div class="d-flex flex-column flex-root">
    {{ $slot }}
</div>
@else
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        @if( theme()->getOption('layout', 'aside/display') === true )
        {{ theme()->getView('layout/aside/_base') }}
        @endif

        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="mv_wrapper">
            {{ theme()->getView('layout/header/_base') }}

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid {{ theme()->printHtmlClasses('content', false) }}" id="mv_content">
                @if (theme()->getOption('layout', 'toolbar/display') === true)
                {{ theme()->getView('layout/toolbars/_' . theme()->getOption('layout', 'toolbar/layout')) }}
                @endif
                <div class="container-xxl">
                    @if(Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center p-5 mb-10">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                            {!! theme()->getSvgIcon("icons/duotune/general/gen040.svg", "svg-icon-3") !!}
                        </span>
                        <!--end::Svg Icon-->
                        <div class="d-flex flex-column">
                            <h4>{{Session::get('fail')}}</h4>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/general/gen040.svg", "svg-icon-3") !!}
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Close-->
                    </div>
                    @endif
                </div>
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="mv_post">
                    {{ theme()->getView('layout/_content', compact('slot')) }}
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->

            {{ theme()->getView('layout/_footer') }}
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

<!--begin::Drawers-->
{{ theme()->getView('partials/topbar/_activity-drawer') }}
<!--end::Drawers-->

<!--begin::Engage-->
{{ theme()->getView('partials/engage/_main') }}
<!--end::Engage-->

<!--begin::Support-->
{{ theme()->getView('partials/modals/general/_support') }}
<!--end::Support-->

@if(theme()->getOption('layout', 'scrolltop/display') === true)
{{ theme()->getView('layout/_scrolltop') }}
@endif
@endif
<!--end::Main-->

@endsection