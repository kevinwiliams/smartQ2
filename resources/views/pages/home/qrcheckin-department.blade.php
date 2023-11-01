<x-base-layout>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header ribbon ribbon-top">
            @if($company->active)
            <div class="ribbon-label bg-success">
                Active
            </div>
            @else
            <div class="ribbon-label bg-danger">
                Inactive
            </div>
            @endif
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Avatar-->
                <div class="symbol symbol-65px symbol-circle mt-5 me-5 mb-5">
                    <img src="{{ $company->logo_url }}" alt="image">
                </div>
                <!--end::Avatar-->

                <div class="title-address">
                    <h2>{{ ucwords($company->name) }}</h2>
                    <p class="text-muted">{{ $company->address }}</p>
                </div>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card body-->
        <div class="card-body p-3">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="mv_create_token_stepper">
                <!--begin::Nav-->
                <div class="stepper-nav mb-5  ">
                    <!--begin::Step 4-->
                    <div class="stepper-item current" data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">Joined the Q</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">Q'd!</h3>
                    </div>
                    <!--end::Step 5-->
                </div>
                <!--end::Nav-->
                <!--begin::Form-->
                <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="mv_create_token_form" action='{{ URL::to("home/autotoken") }}' method="post">
                    <!--begin::Step 4-->
                    <div class="current" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-8 pb-lg-10">
                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">You are queued!
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Awesome!!! You are queued. Check in at the location"></i>
                                </h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div class="mb-0">
                                <!--begin::Text-->
                                <div class="fs-6 text-gray-600 mb-5">
                                    Thank you for using {{ config('app.name') }}. We are pleased to inform you that your place in the queue has been successfully reserved. In order to complete your check-in, please visit the location indicated on your reservation confirmation. When you arrive, please make sure to have your confirmation number or scan the available QR code. Thank you for choosing our system, and we look forward to serving you soon.
                                </div>
                                <!--end::Text-->
                                <!--begin::Alert-->
                                <!--begin::Notice-->
                                <div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen026.svg", "svg-icon-2tx svg-icon-success me-4") !!}

                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">You're token number is <span id="tkn_number">{{ $data->token->token_no }}</span> </h4>
                                            <input type="hidden" value="{{ $data->token->id }}" id="tkn_id" />
                                            <div class="fs-6 text-gray-700" id="tkn_position">You are #{{ $data->position }} in the line</div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--end::Alert-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 4-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3" data-mv-stepper-action="previous">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr063.svg", "svg-icon-4 me-1") !!}
                                <!--end::Svg Icon-->Back
                            </button>
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Wrapper-->
                        <div>
                            <button type="button" class="btn btn-lg btn-primary me-3" id="finish_button">
                                <span class="indicator-label">Finish!
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-3 ms-2 me-0") !!}
                                    <!--end::Svg Icon-->
                                </span>
                            </button>

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    @section('scripts')

    <script>
        var chart;
        var lastLat;
        var lastLng;



        $(function() {

            $("#finish_button").on("click", function() {
                document.location.href = '{{ URL::to("home/current") }}/{{ $data->token->id }}';
            });

        });
    </script>

    @include('pages.home._firebase-js')

    @endsection
</x-base-layout>