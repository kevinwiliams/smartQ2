<x-auth-layout>
    <style>
        .hover-elevate-up {
            transition: transform .3s ease
        }

        .hover-elevate-up:hover {
            transform: translateY(-2.5%);
            transition: transform .3s ease;
            will-change: transform
        }
    </style>

    <div class="form w-100">
        <!--begin::Heading-->
        <div class="text-center mb-8">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Sign-up') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('Already have an account?') }}

                <a href="{{ theme()->getPageUrl('login') }}" class="link-primary fw-bolder">
                    {{ __('Sign in here') }}
                </a>
            </div>
            <!--end::Link-->
        </div>
        <!--end::Heading-->

        <!--begin::Separator-->
        <div class="d-flex align-items-center mb-8">
            <div class="border-bottom border-gray-300 mw-100 w-100"></div>
        </div>
        <!--end::Separator-->
        <div class="text-center mb-8">
            <h3 class="text-dark">
                {{ __('Let’s get started!') }}
                <br />
                {{ __('Which of these best describes you?') }}
            </h3>
        </div>
        <a href="{{ theme()->getPageUrl('register') }}" class="card card-flush hover-elevate-up shadow-sm parent-hover mb-8">
            <div class="card-header">
                <h3 class="card-title text-primary">{{ __("I'm a customer") }}</h3>
            </div>
            <div class="card-body d-flex align-items">
                {!! theme()->getSvgIcon("icons/duotune/communication/com013.svg", "svg-icon-3x svg-icon-success") !!}

                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                    I’m trying to join a waitlist or schedule an appointment with a business.
                </span>
            </div>
        </a>

        <a href="{{ theme()->getPageUrl('onboard') }}" class="card card-flush hover-elevate-up shadow-sm parent-hover">
            <div class="card-header">
                <h3 class="card-title  text-primary">{{ __("I'm a business") }}</h3>
            </div>
            <div class="card-body d-flex align-items">
                {!! theme()->getSvgIcon("icons/duotune/ecommerce/ecm004.svg", "svg-icon-3x svg-icon-success") !!}

                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                    I want to let my clients wait from anywhere or schedule appointments.
                </span>
            </div>
        </a>

    </div>

    @section('scripts')


    @endsection
</x-auth-layout>