<x-base-layout>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-3">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="mv_create_token_stepper">
                <!--begin::Nav-->
                <div class="stepper-nav mb-5  ">
                    <!--begin::Step 3-->
                    <div class="stepper-item current" data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">How can we help?</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">3.</h3>
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div class="stepper-item " data-mv-stepper-element="nav">
                        <h3 class="stepper-title d-none d-xl-inline-flex">Joined the Q</h3>
                        <h3 class="stepper-title d-inline-flex d-md-inline-flex d-sm-none d-xl-none">Q'd!</h3>
                    </div>
                    <!--end::Step 5-->
                </div>
                <!--end::Nav-->
                <!--begin::Form-->
                <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="mv_create_token_form" action='{{ URL::to("home/autotoken") }}' method="post">
                    <!--begin::Step 3-->
                    <div class="current" data-mv-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bolder d-flex align-items-center text-dark">How we can be of assistance?
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select the department you wish to visit or the reason for your visit"></i>
                                </h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                {{-- <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                </div> --}}
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col">

                                        <!--begin::Input group-->
                                        <div class="mb-0">
                                            <div class="d-flex align-items-center bg-light-info rounded p-5 mb-7">
                                                <!--begin::Icon-->
                                                <span class="svg-icon svg-icon-info me-5">
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                                                    {!! theme()->getSvgIcon("icons/duotune/general/gen012.svg", "svg-icon-1") !!}
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <!--end::Icon-->

                                                <!--begin::Title-->
                                                <div class="flex-grow-1 me-2">
                                                    <a href="#" class="fw-bolder text-gray-800 text-hover-warning fs-6">Potential wait time</a>
                                                    <span id="span_wait" class="text-muted fw-bold d-block"></span>
                                                </div>
                                                <!--end::Title-->


                                            </div>
                                            <!--begin::Options-->
                                            <div id="mv-departmentrepeater-content" class="mb-0" style="display: none;">
                                                <input class="form-check-input" type="radio" name="department_id" value="" id="mv-departmentrepeater-id" />
                                            </div>
                                            <div id="mv_reasonforvisit">
                                                <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Reason for Visit" tabindex="-1" aria-hidden="true" name="reason_id" value="" id="reason_id"></select>
                                                <br />
                                            </div>
                                            <div id="mv_repeater_department" class="row">
                                                <div style="display:none" id="mv-departmentrepeater-item">
                                                    <!--begin:Option-->
                                                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                        <!--begin:Label-->
                                                        <span class="d-flex align-items-center me-2">
                                                            <!--begin::Icon-->
                                                            <span class="symbol symbol-50px me-6">
                                                                <span class="symbol-label">
                                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                                    {!! theme()->getSvgIcon("icons/duotune/general/gen017.svg", "svg-icon-1 svg-icon-gray-600") !!}
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </span>
                                                            <!--end::Icon-->
                                                            <!--begin::Description-->
                                                            <span class="d-flex flex-column">
                                                                <span class="fw-bolder text-gray-800 text-hover-primary fs-5" id="mv-departmentrepeater-name"></span>
                                                                <span class="fs-6 fw-bold text-muted" id="mv-departmentrepeater-description"></span>
                                                            </span>
                                                            <!--end:Description-->
                                                        </span>
                                                        <!--end:Label-->
                                                        <!--begin:Input-->
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" name="department_id" value="" id="mv-departmentrepeater-id" />
                                                        </span>
                                                        <!--end:Input-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                            </div>
                                            <!--end::Options-->
                                            <input type="hidden" id="visitreason" name="visitreason" value="" />
                                            <input type="hidden" id="lat" name="lat" value="" />
                                            <input type="hidden" id="lng" name="lng" value="" />
                                            <input type="hidden" id="mv_location_list" name="mv_location_list" value="{{ $locationKey }}" />

                                            
                                            <!--begin::Notes-->
                                            
                                            <div class="mb-0 {{($location->settings->show_note)?'':'d-none'}}" id="shownote">
                                                <label for="userNote" class="form-label">Note</label>
                                                <textarea class="form-control" id="userNote" aria-describedby="userNote" name="userNote">{{ old('userNote') }}</textarea>
                                            </div>
                                            
                                            <!--end::Notes-->

                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div class="" data-mv-stepper-element="content">
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
                                            <h4 class="text-gray-900 fw-bolder">You're token number is <span id="tkn_number"></span> </h4>
                                            <input type="hidden" value="" id="tkn_id" />
                                            <div class="fs-6 text-gray-700" id="tkn_position">
                                                {{-- <a href="#" class="fw-bolder">Create Team Platform</a> --}}
                                            </div>
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
                            <button type="button" class="btn btn-lg btn-primary me-3" data-mv-stepper-action="submit">
                                <span class="indicator-label">Finish!
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-3 ms-2 me-0") !!}
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary" data-mv-stepper-action="next">Continue
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-4 ms-1 me-0") !!}
                                <!--end::Svg Icon-->
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
    @include('pages.home._qr-checkin-js')
    <script>
        var chart;
        var lastLat;
        var lastLng;



        $(function() {

            var visitreason = '{{ $location->settings->client_reason_for_visit }}';

            if (visitreason == 1) {
                getVisitReasons();
            } else {
                getDepartment();
            }


        });

        function getDepartment() {
            $('#mv_reasonforvisit').hide();
            $("#visitreason").val(0);
            var location_id = $('#mv_location_list').val();

            var repItem = $('#mv-departmentrepeater-item');
            var content = $('#mv-departmentrepeater-content');

            $.ajax({
                type: 'post',
                url: '{{ URL::to("home/getdepartments") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': location_id,
                    '_token': '<?php echo csrf_token() ?>'
                },
                success: function(data) {
                    console.log(data);
                    content.html("")
                    var cntr = 1;
                    data.forEach(element => {
                        var _clone = repItem.clone();
                        _clone.removeAttr("id");
                        var name = _clone.find("#mv-departmentrepeater-name");
                        name.text(element.name);

                        var description = _clone.find("#mv-departmentrepeater-description");
                        description.text(element.description);

                        var radio = _clone.find("#mv-departmentrepeater-id");
                        radio.val(element.id);

                        //update ids
                        var __id = radio.attr('id');
                        radio.attr('id', __id + element.id);
                        var label = _clone.find('label');
                        label.attr('for', __id + element.id);

                        // _clone.css('display', 'inline-block');
                        // _clone.addClass("col-lg-6");                            

                        // _clone.on('click', function(e) {
                        //     $('[data-mv-stepper-action="next"]').removeClass('disabled');
                        // });

                        label.on('click', function(e) {
                            $('[data-mv-stepper-action="next"]').removeClass('disabled');
                        });

                        content.append(label);
                        cntr++;
                    });

                    content.show();
                    $('input:radio[name=department_id]').on('click', function(e) {
                        console.log(e);
                        var dept = $(this).find(":checked").val();
                        var dept = e.target.value;

                        $.ajax({
                            type: 'post',
                            url: '{{ URL::to("home/getwaittime") }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'id': dept,
                                '_token': '<?php echo csrf_token() ?>'
                            },
                            success: function(data) {
                                console.log(data);
                                $("#span_wait").text(data);
                            }
                        });

                    });

                    // $('[data-mv-stepper-action="next"]').trigger('click');
                }
            });

        };

        function getVisitReasons() {
            $("#visitreason").val(1);
            $('#mv_reasonforvisit').show();
            $('#mv-departmentrepeater-content').hide();
            $('#mv-departmentrepeater-content').html('');

            var location_id = '{{ $locationKey }}';

            var options = $('select[name="reason_id"]').empty();

            $.ajax({
                url: '{{ URL::to("location/visitreason/reasonsforvisitbylocation") }}/' + location_id,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data);

                    $('select[name="reason_id"]').append(new Option("Select a reason", ""));
                    data.data.forEach(element => {
                        // console.log(element);
                        $('select[name="reason_id"]').append(new Option(element.reason, element.id));
                    });


                    $('select[name="reason_id"]').on('change', function(e) {

                        var reason = $(this).val();

                        $.ajax({
                            type: 'post',
                            url: '{{ URL::to("home/getwaittimebyreason") }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'id': reason,
                                '_token': '<?php echo csrf_token() ?>'
                            },
                            success: function(data) {
                                console.log(data);
                                $("#span_wait").text(data);
                            }
                        });

                    });
                }

            });

        };
    </script>
    
    @include('pages.home._firebase-js')

    @endsection
</x-base-layout>