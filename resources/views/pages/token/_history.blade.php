<x-base-layout>
    <?php
    // Table rows
    $tableRows = array(
        array(
            'agent' => array(
                'image' => 'svg/avatars/001-boy.svg',
                'name' => 'Brad Simmons',
                'skills' => 'HTML, JS, ReactJS'
            ),
            'earnings' => array(
                'value' => '$8,000,000',
                'remarks' => 'Pending'
            ),
            'comission' => array(
                'value' => '$5,400',
                'remarks' => 'Paid'
            ),
            'company' => array(
                'name' => 'Intertico',
                'fields' => 'Web, UI/UX Design'
            ),
            'rating' => array(
                'value' => 5,
                'remarks' => 'Best Rated'
            )
        ),
        array(
            'agent' => array(
                'image' => 'svg/avatars/047-girl-25.svg',
                'name' => 'Lebron Wayde',
                'skills' => 'PHP, Laravel, VueJS'
            ),
            'earnings' => array(
                'value' => '$8,750,000',
                'remarks' => 'Paid'
            ),
            'comission' => array(
                'value' => '$7,400',
                'remarks' => 'Paid'
            ),
            'company' => array(
                'name' => 'Agoda',
                'fields' => 'Houses & Hotels'
            ),
            'rating' => array(
                'value' => 4,
                'remarks' => 'Above Avarage'
            )
        ),
        array(
            'agent' => array(
                'image' => 'svg/avatars/006-girl-3.svg',
                'name' => 'Brad Simmons',
                'skills' => 'HTML, JS, ReactJS'
            ),
            'earnings' => array(
                'value' => '$8,000,000',
                'remarks' => 'In Proccess'
            ),
            'comission' => array(
                'value' => '$2,500',
                'remarks' => 'Rejected'
            ),
            'company' => array(
                'name' => 'RoadGee',
                'fields' => 'Paid'
            ),
            'rating' => array(
                'value' => 5,
                'remarks' => 'Best Rated'
            )
        ),
        array(
            'agent' => array(
                'image' => 'svg/avatars/014-girl-7.svg',
                'name' => 'Natali Trump',
                'skills' => 'HTML, JS, ReactJS'
            ),
            'earnings' => array(
                'value' => '$700,000',
                'remarks' => 'Pending'
            ),
            'comission' => array(
                'value' => '$7,760',
                'remarks' => 'Paid'
            ),
            'company' => array(
                'name' => 'The Hill',
                'fields' => 'Insurance'
            ),
            'rating' => array(
                'value' => 3,
                'remarks' => 'Avarage'
            )
        ),
        array(
            'agent' => array(
                'image' => 'svg/avatars/020-girl-11.svg',
                'name' => '	Jessie Clarcson',
                'skills' => 'HTML, JS, ReactJS'
            ),
            'earnings' => array(
                'value' => '$1,320,000',
                'remarks' => 'Pending'
            ),
            'comission' => array(
                'value' => '$6,250',
                'remarks' => 'Paid'
            ),
            'company' => array(
                'name' => 'Intertico',
                'fields' => 'Web, UI/UX Design'
            ),
            'rating' => array(
                'value' => 5,
                'remarks' => 'Best Rated'
            )
        )
    );

    $clienthistory = auth()->user()->clienttokenhistory;
    ?>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <!--begin::Table container-->
            <div class="table-responsive">
                <input type="hidden" id="lat" name="lat" value="" />
                <input type="hidden" id="lng" name="lng" value="" />
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-125px rounded-start">Date</th>
                            <th class="min-w-200px">Location</th>
                            <th class="min-w-125px">Agent</th>
                            <th class="min-w-125px">Info</th>
                            <th class="min-w-125px">Times</th>
                            <!--<th class="min-w-150px">Rating</th> -->
                            <th class="min-w-100px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->

                    <!--begin::Table body-->
                    <tbody>
                        @foreach($clienthistory as $row)
                        <tr>
                            <td>
                                <span class="ps-4">
                                    {{ $row->created_at->format('d M Y, h:i a') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light">
                                            <img src="{{  $row->location->company->logo_url }}" class="h-75 align-self-center" alt="" />
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $row->location->name }}</a>
                                        <span class="text-muted fw-bold text-muted d-block fs-7">{{ $row->location->address }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light">
                                            <img src="{{  $row->officer->avatar_url }}" class="h-75 align-self-center" alt="" />
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $row->officer->name }}</a>
                                        <!-- <span class="text-muted fw-bold text-muted d-block fs-7">{{ $row->location->address }}</span> -->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold">Reason for visit:</span><br />
                                <span class="">
                                    {{ $row->reason_for_visit }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold">Wait Time:</span><br />
                                <span class="">{{ $row->wait_time }}</span><br />
                                <span class="fw-bold">Service Time:</span><br />
                                <span class="">{{ $row->service_time }}</span>

                            </td>
                            <td class="text-end">
                                <a href="#" data-id="{{$row->id}}" data-name="{{ $row->location->name }}" data-location="{{$row->location_id }}" data-action="visit" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">
                                    Visit
                                </a>

                                <a href="#" data-id="{{$row->id}}" data-name="{{ $row->location->name }}" data-location="{{$row->location_id }}" data-action="rebook" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">
                                    Rebook
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
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
                            url: '/token/rebook/' ,
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