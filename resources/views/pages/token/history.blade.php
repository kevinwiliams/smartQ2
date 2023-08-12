<x-base-layout>
    <?php
    $clienthistory = auth()->user()->clienttokenhistory;
    ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($clienthistory as $row)
        <div class="col">
            <div class="card h-100">
                <div class="card-body p-0">
                    <div class="px-9 pt-7 card-rounded h-150px w-100 bg-primary" id="rptTokenHeader">
                    </div>
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-3 px-6 py-6 position-relative z-index-1" style="margin-top: -120px">
                        <div class="d-flex align-items-center mb-6">
                            <div class="symbol symbol-45px w-40px me-5">
                                <img class="mw-80px mw-lg-95px" src="{{  $row->location->company->logo_url }}" alt="image" id="rptTokenLogo" />
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder" id="rptTokenLocation">{{ $row->location->name }}</a>
                                    <div class="text-gray-400 fw-bold fs-7" id="rptTokenLocationAddress">{{ $row->location->address }}</div>
                                </div>
                                <div class="d-flex align-items-center">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-6">
                            <div class="symbol symbol-45px w-40px me-5">
                                <img class="mw-80px mw-lg-95px" src="{{  $row->officer->avatar_url }}" alt="image" />
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">{{ $row->officer->name }}</a>
                                </div>
                                <div class="d-flex align-items-center">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-6">
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    {!! theme()->getSvgIcon("icons/duotune/electronics/elc005.svg", "svg-icon-1") !!}
                                </span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">

                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Date</a>
                                    <div class="text-gray-600  fs-6">{{ $row->created_at->format('d M Y, h:i a') }}</div>
                                </div>

                                <div class="d-flex align-items-center">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-6">

                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen056.svg", "svg-icon-1") !!}
                                </span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Reason</a>
                                    <div class="text-gray-400 fw-bold fs-7">{{ $row->reason_for_visit }}</div>
                                </div>
                                <div class="d-flex align-items-center">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-6">
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen032.svg", "svg-icon-1") !!}
                                </span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">

                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Stats </a><br />
                                    <span class="fw-bold">Wait Time: </span><span class="">{{ $row->wait_time }}</span><br />
                                    <span class="fw-bold">Service Time: </span><span class="">{{ $row->service_time }}</span>
                                </div>

                                <div class="d-flex align-items-center">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mb-6">
                            <div class="">
                                <a href="#" data-id="448" data-name="Kingston Office" data-location="14" data-action="visit" class="btn btn-bg-light btn-primary btn-active-color-dark btn-sm px-4 me-2">
                                    Visit
                                </a>

                                <a href="#" data-id="448" data-name="Kingston Office" data-location="14" data-action="rebook" class="btn btn-bg-light btn-primary btn-active-color-dark btn-sm px-4">
                                    Rebook
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>    
    @section('scripts')
    <script>
        $(document).ready(function() {
            getLocation();
            $('[data-action="visit"]').on('click', function() {
                var btn = $(this);
                var id = btn.data('id');
                var name = btn.data('name');
                var location = btn.data('location');

                Swal.fire({
                    text: "Are you sure you want to re-visit\n" + name + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        window.location = "/home/joinqueue/L-" + location;
                    }
                });


            });

            $('[data-action="rebook"]').on('click', function() {
                getLocation();
                var btn = $(this);
                var id = btn.data('id');
                var name = btn.data('name');
                var location = btn.data('location');

                Swal.fire({
                    text: "Are you sure you want to re-book\n" + name + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {

                        $.ajax({
                            url: '/token/rebook/',
                            type: 'POST',
                            data: {
                                'id': id,
                                'lat': $("#lat").val(),
                                'lng': $("#lng").val(),
                                '_token': '<?php echo csrf_token() ?>'
                            },
                            success: function(res) {
                                window.location = "/home/current/" + res.token.id;
                            }
                        }).fail(function(jqXHR, textStatus, error) {
                            // Handle error here
                            Swal.fire({
                                text: name + " was not rebooked.<br>" + jqXHR.responseText + "<br>" + error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        });
                    }
                });


            });
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function geoSuccess(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            $('#lat').val(lat);
            $('#lng').val(lng);
        }

        function geoError() {
            console.log("Geocoder failed.");
        }

        function visit(id) {


        }

        function rebook(id) {
            alert(id);
        }
    </script>
    @endsection
</x-base-layout>