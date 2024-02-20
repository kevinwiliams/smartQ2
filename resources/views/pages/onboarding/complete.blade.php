<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_complete">
        {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Staff Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            {{ theme()->getView('partials/general/_notice', array(
                        'class' => 'min-w-lg-600px flex-shrink-0',
                        'color' => 'success',
                        'title' => 'Onboarding Completed!',
                        'body' => 'Congratulations! 🎉 Your onboarding journey is now complete! 🚀 Welcome aboard! Your business is now set up and ready to thrive with <b>' . config('app.name') . '</b>. If you have any questions or need assistance, our support team is here to help. Thank you for choosing us, and best of luck on your exciting journey ahead! 🌟',
                        'icon' => "icons/duotune/general/gen026.svg",
                        'button' => false                        
                    )) }}
            <br />
            <h3>Here's a summary</h3>
            <br />      
            <div class="col">
                <div class="card shadow-sm mb-5">
                    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#mv_companyinfo_collapsible">
                        <h3 class="card-title">Company Detail</h3>
                        <div class="card-toolbar rotate-180">
                            <i class="bi bi-arrow-down-circle fs-1"></i>
                        </div>
                    </div>
                    <div id="mv_companyinfo_collapsible" class="collapse show">
                        <div class="card-body">
                            <div class="row g-4 p-4">
                                <div class="col-md-6">
                                    <label class="font-bold">Category:</label>
                                    <div class="text-gray-600 mb-4 fs-6">
                                        {{ ($location->company->category) ? $location->company->category->name : 'N/A' }}
                                    </div>

                                    <label class="font-bold">Address:</label>
                                    <div class="text-gray-600 mb-4 fs-6">{{ $location->company->address }}</div>

                                    <label class="font-bold">Website:</label>
                                    <div class="text-gray-600 mb-4 fs-6">{{ $location->company->website }}</div>

                                    <label class="font-bold">Email:</label>
                                    <div class="text-gray-600 mb-4 fs-6">{{ $location->company->email }}</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="font-bold">Phone:</label>
                                    <div class="text-gray-600 mb-4 fs-6">{{ $location->company->phone }}</div>

                                    <label class="font-bold">Contact Person:</label>
                                    <div class="text-gray-600 mb-4 fs-6">{{ $location->company->contact_person }}</div>

                                    <label class="font-bold">Description:</label>
                                    <div class="text-gray-600 mb-4 fs-6">{{ $location->company->description }}</div>

                                    @if($location->company->shortname)
                                    <label class="font-bold">Shortname:</label>
                                    <div class="mb-4">
                                        <a target="_blank" href="{{ config('app.url') }}/in/{{ $location->company->shortname }}" class="fs-6">
                                            {{ config('app.url') }}/in/{{ $location->company->shortname }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mb-5">
                    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#mv_locationinfo_collapsible">
                        <h3 class="card-title">Location Detail</h3>
                        <div class="card-toolbar rotate-180">
                            <i class="bi bi-arrow-down-circle fs-1"></i>
                        </div>
                    </div>
                    <div id="mv_locationinfo_collapsible" class="collapse show">
                        <div class="card-body">

                            <div class="row g-4 p-4">
                                <div class="col-md-6">
                                    <h4 class="text-gray-800">{{ $location->name }}</h4>
                                    <span class="text-muted fw-bold d-block fs-7">{!! theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-3") !!} {{ $location->address }}</span>
                                    <!--start::Google map-->
                                    <div id="map" style="height:400px; width: 100%;" class="my-3"></div>
                                    <!--end::Google map-->
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted fw-bold d-block fs-7 mb-3">{!! theme()->getSvgIcon("icons/duotune/electronics/elc002.svg", "svg-icon-3") !!} Check In Code</span>
                                    <h4 class="text-gray-800 ms-5 mb-7">{{ $location->getLastCheckInCode()->code }}</h4>
                                    <span class="text-muted fw-bold d-block fs-7 mb-3">{!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-3") !!} Opening Hours</span>

                                    <div class="row  ms-5 mb-4">
                                        @foreach($location->openinghours as $hour)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="w-25"><span class="fs-6">{{ $hour->day_name }}</span></div>
                                                <div><span class="fw-bold fs-6">{{ $hour->open_hours }}</span></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <span class="text-muted fw-bold d-block fs-7 mb-3">{!! theme()->getSvgIcon("icons/duotune/general/gen059.svg", "svg-icon-3") !!} Services</span>
                                    @foreach($location->services as $service)
                                    <div class="d-flex align-items-sm-center mb-7 ms-5">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                            <div class="flex-grow-1 me-2">
                                                <span class="text-gray-800 text-hover-primary fs-6 fw-bold" id="mv-servicesrepeater-name">{{ $service->name }}</span>

                                                <span class="text-muted fw-semibold d-block fs-7" id="mv-servicesrepeater-description">{{ $service->description }}</span>
                                            </div>

                                            <span class="badge badge-light fw-bold my-2" id="mv-servicesrepeater-price">{{ $service->price }}</span>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    @endforeach

                                    <span class="text-muted fw-bold d-block fs-7 mb-3">{!! theme()->getSvgIcon("icons/duotune/general/gen059.svg", "svg-icon-3") !!} Departments</span>
                                    <h4 class="text-gray-800 ms-5 mb-7">
                                        {{ implode(', ', $location->departments->pluck('name')->toArray()) }}
                                    </h4>
                                    <span class="text-muted fw-bold d-block fs-7 mb-3">{!! theme()->getSvgIcon("icons/duotune/general/gen059.svg", "svg-icon-3") !!} Counters</span>
                                    <h4 class="text-gray-800 ms-5 mb-7">
                                        {{ implode(', ', $location->counters->pluck('name')->toArray()) }}
                                    </h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#mv_staffinfo_collapsible">
                        <h3 class="card-title">Staff Detail</h3>
                        <div class="card-toolbar rotate-180">
                            <i class="bi bi-arrow-down-circle fs-1"></i>
                        </div>
                    </div>
                    <div id="mv_staffinfo_collapsible" class="collapse show">
                        <div class="card-body">
                            <div class="row g-4 p-4">
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap">
                                        @if (!empty($staff_list))
                                        @foreach($staff_list as $officer)
                                        <div class="col-md-3 mb-3">
                                            <div class="card border m-3">
                                                @if($officer->status == 0)
                                                <span style="position: absolute; top: 0; right: 0;">
                                                    <a href="#" class="float-end me-2 mt-2" data-mv-staff-table-filter="delete_invite" data-id="{{ $officer->id }}" id="btnDeleteInvite{{ $officer->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </span>
                                                @endif
                                                <div class="card-body d-flex flex-center flex-column pt-12 p-3">
                                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                                        <img src="{{ $officer->avatar_url }}" alt="image">
                                                        <div class="{{ ($officer->status == 0) ? 'bg-danger' : 'bg-success' }} position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                                    </div>
                                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{ $officer->name }}</a>
                                                    <div class="badge badge-lg badge-light-{{ ($officer->status == 0) ? 'danger' : 'success' }} d-inline">{{ $officer->role }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <table class="table" width="100%" cellspacing="2" name="mv_queue_config" id="mv_queue_config">
                                        <thead>
                                            <tr class="fw-bolder text-muted bg-light">                                                
                                                <th>{{ trans('app.department') }}</th>
                                                <th>{{ trans('app.counter') }}</th>
                                                <th>{{ trans('app.officer') }}</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (!empty($tokens))
                                            <?php $sl = 1 ?>
                                            @foreach ($tokens as $token)
                                            <tr>                                                
                                                <td>{{ $token->department }}</td>
                                                <td>{{ $token->counter }}</td>
                                                <td>{{ $token->firstname }} {{ $token->lastname }}</td>                                                
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary" data-mv-complete-modal-action="submit">
                    <span class="indicator-label">Finish</span>
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
        let defLat = parseFloat('{{ $location->lat }}');
        let defLng = parseFloat('{{ $location->lon }}');

        let marker;



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
                draggable: false
            });
        }

        function clear() {
            marker.setMap(null);
        }

        $(document).ready(function() {
            $('#mv_queue_config').dataTable({
                "info": false,
            });
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps') }}&callback=initMap" type="text/javascript"></script>

    @endsection
</x-base-layout>