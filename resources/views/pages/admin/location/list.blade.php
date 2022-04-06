<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                {{-- <span class="card-label fw-bolder fs-3 mb-1">Active Tokens </span>
                <span class="text-muted mt-1 fw-bold fs-7">Clients waiting: {{ $waiting }}</span> --}}
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-mv-location-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Locations">
                </div>
            </h3>
            <div class="card-toolbar">

                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_location" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new Location">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New Location
                </a>
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <!--begin::Table-->
            {{ $dataTable->table() }}

            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!--begin::Modal - Add Company -->
    {{ theme()->getView('partials/modals/location/_add', array('companies' => $companies)) }}
    <!--end::Modal - Add Company-->
    <!--begin::Modal - Edit Company -->
    <{{ theme()->getView('partials/modals/location/_edit', array('companies' => $companies)) }} 
    <!--end::Modal dialog-->
        {{-- Inject Scripts --}}
        @section('scripts')
        {{ $dataTable->scripts() }}
        @include('pages.admin.location._button-actions-js')
        <script>
            let map;
            let defLat = 10.668741351384037;
            let defLng = -61.508404969650044;
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: defLat, lng: defLng },
                    zoom: 15,
                    scrollwheel: true,
                });

                const uluru = { lat: defLat, lng: defLng };
                let marker = new google.maps.Marker({
                    position: uluru,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker,'position_changed',
                    function (){
                        let lat = marker.position.lat()
                        let lng = marker.position.lng()
                        $('#lat').val(lat)
                        $('#lng').val(lng)
                    })

                google.maps.event.addListener(map,'click',
                function (event){
                    pos = event.latLng
                    marker.setPosition(pos)
                })
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                        type="text/javascript"></script>
        @endsection
</x-base-layout>