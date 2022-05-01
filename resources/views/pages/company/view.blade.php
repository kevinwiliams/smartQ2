<x-base-layout>
	<div class="d-flex flex-column flex-column-fluid" id="mv_content">
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="mv_post">
			<!--begin::Container-->
			<div id="mv_content_container" class="container-xxl">
				<!--begin::Layout-->
				<div class="d-flex flex-column flex-lg-row">

					<!--begin::Sidebar-->
					<div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
						<!--begin::Card-->
						<div class="card card-flush">

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
									<h2>{{ ucwords($company->name) }}</h2>
								</div>
								<!--end::Card title-->
							</div>
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<div class="text-gray-600 mb-5">{{ $company->address }}</div>
								<div class="text-gray-600 mb-5">{{ $company->website }}</div>
								<div class="text-gray-600 mb-5">{{ $company->email }}</div>
								<div class="text-gray-600 mb-5">{{ $company->phone }}</div>
								<div class="text-gray-600 mb-5">{{ $company->contact_person }}</div>
								<div class="text-gray-600 mb-5">{{ $company->description }}</div>
							</div>
							<!--end::Card body-->
							<!--begin::Card footer-->
							<div class="card-footer pt-0">
								<a href="{{ url('company/list') }}" class="btn btn-light btn-active-primary">Back</a>

							</div>
							<!--end::Card footer-->
						</div>
						<!--end::Card-->

						<!--begin::Modal-->
						<!--begin::Modal - Edit Company -->
					</div>
					<!--end::Sidebar-->
					<!--begin::Content-->
					<div class="flex-lg-row-fluid ms-lg-10">
						<ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#mv_tab_pane_1">List</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#mv_tab_pane_2">Map</a>
							</li>

						</ul>

						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="mv_tab_pane_1" role="tabpanel">

								<!--begin::Card-->
								<div class="card card-flush mb-6 mb-xl-9">
									<!--begin::Card header-->
									<div class="card-header pt-5">
										<!--begin::Card title-->
										<div class="card-title">
											<h2 class="d-flex align-items-center">Locations
												<span class="text-gray-600 fs-6 ms-1">({{ $company->locations->count() }})</span>
											</h2>
										</div>
										<!--end::Card title-->
										<!--begin::Card toolbar-->
										<div class="card-toolbar">
											@can('create location')
											<!--begin::Button-->
											<button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_add_location" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new Company">
												<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->

												{!! theme()->getSvgIcon("icons/duotune/general/gen035.svg", "svg-icon-3") !!}

												<!--end::Svg Icon-->
												New Location
											</button>
											<!--end::Button-->
											@endcan
										</div>
										<!--end::Card toolbar-->
									</div>
									<!--end::Card header-->
									<!--begin::Card body-->
									<div class="card-body pt-0">
										<!--begin::Table-->
										<div id="mv_companys_view_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
											<div class="table-responsive">
												<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 no-footer" style="width: 100%;" id="mv_locations_view_table">
													<thead>
														<tr>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
														</tr>
													<tbody>
														@foreach($company->locations as $_location)
														<tr class="align-top">
															<!--begin::ID-->
															<td>
																<h4 class="text-gray-800"><a href="{{ theme()->getPageUrl('location/view/'.$_location->id) }}">{{ $_location->name }}</a></h4>
																<span class="text-muted fw-bold d-block fs-7">{!! theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-3") !!} {{ $_location->address }}</span>
																<br>
																<div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-3 px-6 me-4 mb-3">
																	<span class="text-gray-600 fw-bold d-block fs-6 py-1">Team size: <span class="text-black">{{ $_location->staff()->count() }}</span> </span>
																	<span class="text-gray-600 fw-bold d-block fs-6">Departments: <span class="text-black">{{ $_location->departments()->count() }}</span> </span>
																	<!-- {{ Carbon\Carbon::parse($_location->created_at)->format('d M Y, h:i a'); }} -->
																</div>
															</td>
															<td>
																<br />
																{{-- <span>Service Setup</span> --}}
																<span class="badge bagde-lg badge-secondary fw-bolder fs-7 me-1 my-3">Service Setup</span>
																<br />
																<div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3 fs-7">
																	<span class="text-muted fw-bold p-1">Greeting: </span><span>{{ ($company->locations[0]->settings->enable_greeting)?'Yes':'No' }}</span><br />
																	<span class="text-muted fw-bold p-1">Displays: </span><span>{{ $_location->displays()->count() }}</span><br />
																	<span class="text-muted fw-bold p-1">Counters: </span><span>{{ $_location->counters()->count() }}</span><br />
																</div>
															</td>
															<td>
																<br />
																{{-- <span>Statistics</span> --}}
																<span class="badge bagde-lg badge-light-primary fw-bolder fs-7 me-1 my-3">Statistics</span>
																<br />
																<div class="border border-gray-300 border-dashed rounded min-w-200px w-100 py-2 px-4 me-6 mb-3 fs-7">
																	<span class="text-muted fw-bold p-1">Visitors Last Wk: </span><span>{{ $_location->visitorslastweek->count() }}</span><br />
																	<span class="text-muted fw-bold p-1">Avg. Wait Time: </span><span> {{ ($_location->stats())?$_location->stats()->wait_time:'-' }} mins</span><br />
																	<span class="text-muted fw-bold p-1">Avg. Service Time: </span><span> {{ ($_location->stats())?$_location->stats()->service_time:'-' }} mins</span><br />
																</div>
															</td>
															<td valign="middle">
																<a href="{{ theme()->getPageUrl('location/view/'.$_location->id) }}" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">View</a>

															</td>

														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
										<!--end::Table-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->

							</div>
							<div class="tab-pane fade" id="mv_tab_pane_2" role="tabpanel">
								<!--start::Google map-->
								<div id="displaymap" style="height:400px;width:100%;" class="my-3"></div>
								<!--end::Google map-->
							</div>
						</div>
					</div>
					<!--end::Content-->
				</div>
				<!--end::Layout-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
	<!--begin::Modal - Add Company -->
	{{ theme()->getView('partials/modals/location/_add', array('company' => $company)) }}
	<!--end::Modal - Add Company-->
	@section('scripts')
	@include('pages.company._view-js')

	<script>
		var path = window.location.pathname.split("/");
		var location_id = path[path.length - 1];
		//auto select company
		if (location_id) {
			$('select[name=company_id]').val(location_id);
			$('select[name=company_id]').trigger('change');
			// $('select[name=company_id]').attr("disabled", true);
		}

		let map;
		let c;
		let defLat = 10.668741351384037;
		let defLng = -61.508404969650044;
		let geocoder;
		let marker;

		function initMaps() {
			initMap();
			initDisplayMap();
		}

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
					let lat = marker.position.lat()
					let lng = marker.position.lng()
					$('#lat').val(lat)
					$('#lng').val(lng)
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
		}



		function initDisplayMap() {
			var bounds = new google.maps.LatLngBounds();
			displaymap = new google.maps.Map(document.getElementById("displaymap"), {
				center: {
					lat: defLat,
					lng: defLng
				},
				zoom: 15,
				scrollwheel: true,
			});

			var displaymarkers = <?php echo json_encode($markers); ?>;
			var infoWindowContent = <?php echo json_encode($infowindows); ?>;

			var infoWindow = new google.maps.InfoWindow(),
				displaymarker, i;
			// Loop through our array of markers & place each one on the map  
			for (i = 0; i < displaymarkers.length; i++) {
				var position = new google.maps.LatLng(displaymarkers[i][1], displaymarkers[i][2]);
				bounds.extend(position);
				displaymarker = new google.maps.Marker({
					position: position,
					map: displaymap,
					title: displaymarkers[i][0]
				});
				// Each marker to have an info window    
				google.maps.event.addListener(displaymarker, 'click', (function(displaymarker, i) {
					return function() {
						content = '<div class="info_content">' +
						'<h3>' + infoWindowContent[i][0] + '</h3>' +
						'<p>' + infoWindowContent[i][1] + '</p></div>';
						infoWindow.setContent(content);
						infoWindow.open(displaymap, displaymarker);
					}
				})(displaymarker, i));
				// Automatically center the map fitting all markers on the screen
				displaymap.fitBounds(bounds);
			}
			// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
			var boundsListener = google.maps.event.addListener((displaymap), 'bounds_changed', function(event) {
				this.setZoom(5);
				google.maps.event.removeListener(boundsListener);
			});
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
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps') }}&callback=initMaps" type="text/javascript"></script>

	@endsection
</x-base-layout>