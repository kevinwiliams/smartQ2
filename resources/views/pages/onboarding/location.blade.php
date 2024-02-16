<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_edit_location">
    {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Location Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            <h5>Tell us about your location</h5>
            <br />
            <!--begin::Form-->
            {{ Form::open(['url' => 'onboarding/editLocation/' . $location->id, 'class'=>'manualFrm form', 'id'=>'mv_modal_edit_location_form']) }}
            <!-- {{ csrf_field() }} -->
            <input type="hidden" name="company_id" id="company_id" value="{{ $location->company_id }}">
            <input type="hidden" name="location_id" id="location_id" value="{{ $location->id }}">

            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <div class="form-group @error('name') has-error @enderror">
                    <label for="name">{{ trans('app.name') }} <i class="text-danger">*</i></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('app.name') }}" value="{{ old('name', $location->name) }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label for="address">{{ trans('app.address') }} <i class="text-danger">*</i></label>
                <div class="input-group @error('address') has-error @enderror">
                    <input type="text" name="address" id="address-add" class="form-control" placeholder="{{ trans('app.address') }}" value="{{ old('address', $location->address) }}" aria-label="{{ trans('app.address') }}" aria-describedby="address-search-addon">
                    <span class="input-group-text" id="address-search-addon">
                        <i class="fas fa-location-arrow fs-4"></i>
                    </span>
                </div>
            </div>
            <!--end::Input group-->
            <div class="row fv-row mb-7 fv-plugins-icon-container">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <div class="form-group @error('lat') has-error @enderror">
                            <label for="lat">{{ trans('app.lat') }} <i class="text-danger">*</i></label>
                            <input type="text" name="lat" id="lat" class="form-control" placeholder="{{ trans('app.lat') }}" value="{{ old('lat', $location->lat) }}" readonly>
                            <span class="text-danger">{{ $errors->first('lat') }}</span>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <div class="form-group @error('lon') has-error @enderror">
                            <label for="lon">{{ trans('app.lng') }} <i class="text-danger">*</i></label>
                            <input type="text" name="lon" id="lon" class="form-control" placeholder="{{ trans('app.lng') }}" value="{{ old('lon', $location->lon) }}" readonly>
                            <span class="text-danger">{{ $errors->first('lon') }}</span>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Col-->
            </div>
            <input type="hidden" value="{{ ($location->active) ? '1' : '0' }}" name="active" id="edit_active">
            <div>
                <div class="fv-row mb-7">
                    <span class="text-gray=500">Please use the map below to set the coordinates</span> <br>


                    <!--start::Google map-->
                    <div id="map" style="height:400px; width: 100%;" class="my-3"></div>
                    <!--end::Google map-->
                </div>
            </div>
            <!--end::Table-->
            {{ Form::close() }}
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary" data-mv-location-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <!-- <a>Skip for now >></a> -->
            </div>
        </div>
    </div>
    @section('scripts')

    <script>
        let map;
        let c;
        let defLat = parseFloat('{{ $location->lat }}');
        let defLng = parseFloat('{{ $location->lon }}');
        let geocoder;
        let marker;

        $(document).ready(function() {
            //initMap();
            var frm = $("#frmLocation");
            frm.on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                ajax_request(formData);
            });
        });

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
            marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat();
                    let lng = marker.position.lng();
                    $('#lat').val(lat.toFixed(6));
                    $('#lon').val(lng.toFixed(6));
                })

            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })

            geocoder = new google.maps.Geocoder();

            var btn = $("#address-search-addon");
            var address = $("#address-add");
            btn.on('click', function(e) {
                // alert(address.val());
                if (address.val().length > 3) {
                    geocode({
                        address: address.val()
                    });
                }
            });

            if (defLat == 0 && defLng == 0) {
                btn.trigger('click');
            }

        }

        function clear() {
            marker.setMap(null);
        }


        function geocode(request) {
            clear();

            geocoder.geocode(request).then((result) => {
                    const {
                        results
                    } = result;

                    console.log(results);
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(15);
                    marker.setPosition(results[0].geometry.location);
                    marker.setMap(map);
                    // responseDiv.style.display = "block";
                    // response.innerText = JSON.stringify(result, null, 2);
                    return results;
                })
                .catch((e) => {
                    alert("Geocode was not successful for the following reason: " + e);
                });
        }

        function ajax_request(formData) {
            var frm = $("#frmLocation");
            $.ajax({
                url: frm.attr('action'),
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if (data.status) {
                        Swal.fire({
                            text: "Success",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "<br>" + xhr + "<br>",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps') }}&callback=initMap" type="text/javascript"></script>


    @endsection
</x-base-layout>