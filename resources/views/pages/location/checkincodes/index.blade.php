<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}

            <div class="row g-6 g-xl-9" data-sticky-container>
                {{ theme()->getView('pages/location/_sidemenu',  array('location' => $location )) }}
                <!--begin::Col-->
                <div class="col-lg-10">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body pt-6">
                            @if($is_auto)
                            <form id="disable-form" data-mv-element="disable-form" class="form" action="{{ URL::to('location/checkincodes/disable/' . $location->id) }}" method="get">
                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                    <!--begin::Icon-->
                                    {!! theme()->getSvgIcon("icons/duotune/technology/teh004.svg", "svg-icon-3x svg-icon-warning me-4") !!}
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                        <!--begin::Content-->
                                        <div class="mb-3 mb-md-0 fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">Check In Codes</h4>

                                            <div class="fs-6 text-gray-700 pe-7">Your check in codes are being automatically generated.<br /> To view them open the check in code display screen.</div>
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Action-->
                                        <button class="btn btn-danger px-6 align-self-center text-nowrap" id="disable-auto" data-mv-element="disable-auto">
                                            @include('partials.general._button-indicator',array('label'=>'Disable'))
                                        </button>

                                        <!--end::Action-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                            </form>
                            @else
                            <!--begin::Form-->
                            <form id="code-form" data-mv-element="code-form" class="form" action="{{ URL::to('location/checkincodes/regenerate/' . $location->id) }}" method="get">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="name">{{ trans('app.check_in_code') }}</label>
                                        <div class="input-group input-group-solid mb-5">
                                            <input type="text" class="form-control" placeholder="Check In Code" aria-label="Check In Code" aria-describedby="generate-checkincode" readonly value="{{ $location->getLastCheckInCode()->code }}" id="checkincode" name="checkincode" />
                                            <button class="btn btn-danger" id="generate-checkincode" data-mv-element="generate-code">
                                                @include('partials.general._button-indicator',array('label'=>'Regenerate'))
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </form>
                            <!--end::Table-->

                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->


    @section('scripts')

    <script>
        $(document).ready(function() {

            var codeForm = document.querySelector('[data-mv-element="code-form"]');
            var disableForm = document.querySelector('[data-mv-element="disable-form"]');
            var codeSubmitButton = document.querySelector('[data-mv-element="generate-code"]');
            var disableSubmitButton = document.querySelector('[data-mv-element="disable-auto"]');

            $("#generate-checkincode").on("click", function() {
                codeSubmitButton.setAttribute('data-mv-indicator', 'on');

                // Disable button to avoid multiple click
                codeSubmitButton.disabled = true;

                Swal.fire({
                    html: "Are you sure?.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "I think so!",
                    cancelButtonText: 'Nope, cancel it',
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: 'btn btn-danger'
                    }
                }).then(function(value) {
                    if (value.isConfirmed) {
                        $.ajax({
                            type: codeForm.method,
                            url: codeForm.action,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function(data) {
                                codeSubmitButton.removeAttribute('data-mv-indicator');

                                // Enable button
                                codeSubmitButton.disabled = false;

                                if (data.status == true) {
                                    codeForm.querySelector('[name="checkincode"]').value = data.data;
                                    Swal.fire({
                                        text: 'New code successfully generated',
                                        icon: 'success'
                                    });
                                } else {
                                    Swal.fire({
                                        text: 'Error generating new code',
                                        icon: 'error'
                                    });
                                    codeForm.querySelector('[name="checkincode"]').value = '';
                                }
                            }
                        });
                    } else {
                        codeSubmitButton.removeAttribute('data-mv-indicator');

                        // Enable button
                        codeSubmitButton.disabled = false;

                    }

                });
            });

            $("#disable-auto").on("click", function() {
                disableSubmitButton.setAttribute('data-mv-indicator', 'on');

                // Disable button to avoid multiple click
                disableSubmitButton.disabled = true;

                Swal.fire({
                    html: "Are you sure?.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "I think so!",
                    cancelButtonText: 'Nope, cancel it',
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: 'btn btn-danger'
                    }
                }).then(function(value) {
                    if (value.isConfirmed) {
                        $.ajax({
                            type: disableForm.method,
                            url: disableForm.action,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function(data) {
                                disableSubmitButton.removeAttribute('data-mv-indicator');

                                // Enable button
                                disableSubmitButton.disabled = false;

                                if (data.status == true) {
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        text: 'Error disabling auto codes',
                                        icon: 'error'
                                    });                                    
                                }
                            }
                        });
                    } else {
                        disableSubmitButton.removeAttribute('data-mv-indicator');

                        // Enable button
                        disableSubmitButton.disabled = false;

                    }

                });
            });
        });
    </script>

    @endsection
</x-base-layout>