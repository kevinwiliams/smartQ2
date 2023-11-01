<x-base-layout>
    <?php
    $faves = auth()->user()->favorites;
    ?>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-3">
            @if(count($faves) > 0)
            <form id="fave-form" data-mv-element="fave-form" class="form" action="{{ URL::to('location/favorites/delete') }}" method="get">
                <table id="mv_favorites" class="table table-row-bordered border rounded gy-5 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th>Location</th>
                            <th>Since</th>
                            <th># of Visits</th>
                            <th>Last Visit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faves as $row)
                        <tr>
                            <td>
                                <div class="d-flex align-items-sm-center mb-1">

                                    <div class="symbol symbol-40px symbol-circle me-5">
                                        <img src="{{ $row->location->company->logo_url }}" alt="image">
                                    </div>

                                    <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                        <div class="flex-grow-1 me-2">
                                            <a class="text-gray-800 fw-bolder text-hover-primary d-block fs-4" href="{{ theme()->getPageUrl('home/joinqueue/L-'.$row->location->key()) }}">{{ $row->location->name }}</a>
                                            @if($row->location->company->shortname)
                                            <a class="text-gray-900 fw-bold text-hover-primary d-block pt-1" target="_blank" href="{{ config('app.url') }}/in/{{ $row->location->company->shortname }}">{{ $row->location->company->name }}</a>
                                            @else
                                            <span class="text-gray-900 fw-bold d-block pt-1">{{ $row->location->company->name }}</span>
                                            @endif

                                            @if(!empty($row->location->address))
                                            <span class="text-muted fw-bold d-block pt-1">{!! theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-3") !!} {{ $row->location->address }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>{{ Carbon\Carbon::parse($row->created_at)->format('d M Y')  }}</td>
                            <td>{{ $row->totalVisits()  }}</td>
                            <td>{{ ($row->lastVisit())?Carbon\Carbon::parse($row->lastVisit()->created_at)->format('d M Y'):'N/A'  }}</td>
                            <td>
                                <button class="btn btn-danger float-end" name="delete-fav" data-id="{{ $row->location->id }}" data-name="{{ $row->location->name }}">
                                    @include('partials.general._button-indicator',array('label'=>'Delete'))
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            @else
            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                <!--begin::Icon-->
                {!! theme()->getSvgIcon("icons/duotune/general/gen056.svg", "svg-icon-3x svg-icon-warning me-4") !!}
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                    <!--begin::Content-->
                    <div class="mb-3 mb-md-0 fw-semibold">
                        <h4 class="text-gray-900 fw-bold">Favorite Locations</h4>

                        <div class="fs-6 text-gray-700 pe-7">You don't have any favorite locations yet.<br />Search for your favorite locations and add them to the list.</div>
                    </div>
                    <!--end::Content-->
                    <!--begin::Action-->
                    <a class="btn btn-success px-6 align-self-center text-nowrap" href="{{ theme()->getPageUrl('home/search') }}">Search</a>
                   

                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
            </div>
            @endif
        </div>
    </div>
    @section('scripts')
    <script>
        $(function() {
            $("#mv_favorites").DataTable({

            });

            var faveForm = document.querySelector('[data-mv-element="fave-form"]');
            const buttons = document.querySelectorAll('button[name="delete-fav"]');

            // Loop through the selected buttons and add an onclick event
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Your onclick event code goes here
                    // You can access the clicked button using the "button" variable
                    // Prevent default button action
                    e.preventDefault();
                    // Retrieve the data-id attribute value
                    const locationId = button.getAttribute('data-id');
                    const locationName = button.getAttribute('data-name');

                    Swal.fire({
                        text: "Are you sure you want to delete " + locationName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            // Show loading indication
                            button.setAttribute('data-mv-indicator', 'on');

                            // Disable button to avoid multiple click 
                            button.disabled = true;

                            $.ajax({
                                url: faveForm.action + "/" + locationId,
                                type: "get",
                                success: function(res) {
                                    // Remove loading indication
                                    button.removeAttribute('data-mv-indicator');

                                    // Enable button
                                    button.disabled = false;

                                    Swal.fire({
                                        text: "You have deleted " + locationName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // Remove current row
                                        location.reload();
                                    });
                                }
                            }).fail(function(jqXHR, textStatus, error) {
                                // Remove loading indication
                                button.removeAttribute('data-mv-indicator');

                                // Enable button
                                button.disabled = false;

                                // Handle error here
                                Swal.fire({
                                    text: locationName + " was not deleted.<br>" + jqXHR.responseText + "<br>" + error,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            });

                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: locationName + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                });
            });


        });
    </script>
    @endsection
</x-base-layout>