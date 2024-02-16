@extends('base.base')

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication-->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ asset(theme()->getIllustrationUrl('14.png')) }})">

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative bg-primary-light">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">

                
                @if( theme()->hasOption('layout', 'main/content') )
                {{ theme()->getView('auth/content/' . theme()->getOption('layout', 'main/content')) }}
                @else
                {{ theme()->getView('auth/content/_default') }}
                @endif
               
                    <!--begin::Illustration-->
                    {{-- <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" 
                        style="background-image: url({{ asset(theme()->getIllustrationUrl('131.png')) }})">
                </div> --}}
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Logo-->
                {{-- <a href="{{ $theme->getPageUrl('') }}" class="mb-12">
                <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'logos/waitwise-logo.png') }}" class="h-45px" />
                </a> --}}
                <!--end::Logo-->

                <!--begin::Wrapper-->
                <div class="{{ $wrapperClass ?? '' }} w-lg-500px p-10 p-lg-15 mx-auto">
                    {{ $slot }}
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="{{ $theme->getOption("general", "about") }}" class="text-muted text-hover-primary px-2">{{ __('About') }}</a>

                    <a href="{{ $theme->getOption('general', 'contact') }}" class="text-muted text-hover-primary px-2">{{ __('Contact Us') }}</a>

                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication-->
</div>
</div>
@endsection