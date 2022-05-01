<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}
            <!--begin::Card-->
            <div class="card"> 
                <!--begin::Card body-->
                <div class="card-body">
                    <!--start::Google map-->
                    <div id="map" style="height:400px;width:100%;" class="my-3"></div>
                    <!--end::Google map-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

        @section('scripts')

        <script>
            let map;
            let defLat = parseFloat('{{ $location->lat }}');
            let defLng = parseFloat('{{ $location->lon }}');

            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: defLat,
                        lng: defLng
                    },
                    zoom: 15,
                    scrollwheel: true,
                });

                const uluru = {
                    lat: defLat,
                    lng: defLng
                };
                let marker = new google.maps.Marker({
                    position: uluru,
                    map: map,
                    draggable: false
                });

                // google.maps.event.addListener(marker, 'position_changed',
                //     function() {
                //         let lat = marker.position.lat()
                //         let lng = marker.position.lng()
                //         $('#lat').val(lat)
                //         $('#lng').val(lng)
                //     })

                // google.maps.event.addListener(map, 'click',
                //     function(event) {
                //         pos = event.latLng
                //         marker.setPosition(pos)
                //     })
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_maps')}}&callback=initMap" type="text/javascript"></script>

        @endsection
</x-base-layout>