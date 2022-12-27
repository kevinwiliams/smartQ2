<script>
	// Class definition
	var MVCalcRouteActions = function() {
		function getCurrentLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
			} else {
				console.log("Geolocation is not supported by this browser.");
			}
		}

		function sortRoute2() {
			var routeinfo = $("#mv_data_routes").val();
			var repItem = $('#mv_step_repeater_item');

			var locationarray = [];
			if (routeinfo != "" && routeinfo != undefined) {
				$("#btnCalculateRoute").removeClass("btn-success").addClass("btn-secondary");
				var data = $.parseJSON(routeinfo);

				data.routes.routes.forEach(element => {
					var cntr = 1;
					element.legs.forEach(leg => {
						// console.log(leg);
						locationarray.push(leg.startLocation.latLng);
						locationarray.push(leg.endLocation.latLng);

						var _clone = repItem.clone();
						_clone.removeAttr("id");

						var _step = _clone.find("#rptStep");
						_step.text("Trip " + cntr);

						var _title = _clone.find("#rptTitle");
						var titleText = getLocationName(leg.startLocation.latLng) + " to " + getLocationName(leg.endLocation.latLng);
						_title.text(titleText);

						var _desc = _clone.find("#rptDescription");
						var description = "";
						var minute = secondsToMinutes(leg.staticDuration);
						description = minute + " min - " + Math.round((leg.distanceMeters / 1000), 2) + " km";
						_desc.text(description)

						var _directions = _clone.find("#rptDirections");
						var _url = "https://www.google.com/maps/dir/?api=1&origin=" + leg.startLocation.latLng.latitude + "," + leg.startLocation.latLng.longitude + "&destination=" + leg.endLocation.latLng.latitude + "," + leg.endLocation.latLng.longitude;
						_directions.attr("href", _url);

						cntr++;

						$('div[name="token_card"]').each(function(index) {
							var lat = $(this).data('lat');
							var lng = $(this).data('lng');

							var _steps = $(this).find("#rptTokenStep");

							if (_steps.text() != "") {
								return;
							}

							const from = new google.maps.LatLng(parseFloat(leg.endLocation.latLng.latitude), parseFloat(leg.endLocation.latLng.longitude));
							const to = new google.maps.LatLng(lat, lng);
							const distance = google.maps.geometry.spherical.computeDistanceBetween(from, to)

							var range = '{{ config("app.google_maps_distance_correction") }}';
							if (distance <= parseInt(range)) {
								_steps.append(_clone.clone());
							}
						});

					});
				});

				var cntr = 1;
				locationarray.forEach(location => {
					$('div[name="token_card"]').each(function(index) {
						var lat = $(this).data('lat');
						var lng = $(this).data('lng');
						var order = $(this).data('order');
						if (order > 0)
							return;

						const from = new google.maps.LatLng(parseFloat(location.latitude), parseFloat(location.longitude));
						const to = new google.maps.LatLng(lat, lng);
						const distance = google.maps.geometry.spherical.computeDistanceBetween(from, to)

						var range = '{{ config("app.google_maps_distance_correction") }}';
						if (distance <= parseInt(range)) {
							$(this).data("order", cntr);
						}
					});
					cntr++;
				});

				$('div[name="token_card"]')
					.sort((a, b) => $(a).data("order") - $(b).data("order"))
					.appendTo("#mv_repeater_content");
			}
		}

		function sortRoute(routeinfo) {
			var repItem = $('#mv_step_repeater_item');

			var locationarray = [];
			if (routeinfo != "" && routeinfo != undefined) {
				$("#btnCalculateRoute").removeClass("btn-success").addClass("btn-secondary");
				$("#mv_list_tab").removeClass('d-none').show();
				var data = routeinfo;

				data.routes.forEach(element => {
					var cntr = 1;
					element.legs.forEach(leg => {

						var start_location = leg.start_location;
						var end_location = leg.end_location;
						locationarray.push(start_location);
						locationarray.push(end_location);


						var _clone = repItem.clone();
						_clone.removeAttr("id");

						var _step = _clone.find("#rptStep");
						_step.text("Trip " + cntr);

						var _title = _clone.find("#rptTitle");
						var titleText = getLocationName(start_location) + " to " + getLocationName(end_location);
						_title.text(titleText);

						var _desc = _clone.find("#rptDescription");
						var description = leg.duration.text + " - " + leg.distance.text;
						_desc.text(description)

						var _directions = _clone.find("#rptDirections");
						var _url = "https://www.google.com/maps/dir/?api=1&origin=" + start_location.lat + "," + start_location.lng + "&destination=" + end_location.lat + "," + end_location.lng;
						_directions.attr("href", _url);

						cntr++;

						$('div[name="token_card"]').each(function(index) {
							var lat = $(this).data('lat');
							var lng = $(this).data('lng');

							var _steps = $(this).find("#rptTokenStep");

							if (_steps.text() != "") {
								return;
							}

							const to = new google.maps.LatLng(lat, lng);
							const distance = google.maps.geometry.spherical.computeDistanceBetween(end_location, to)

							var range = '{{ config("app.google_maps_distance_correction") }}';
							if (distance <= parseInt(range)) {
								_steps.append(_clone.clone());
							}
						});
					});
				});

				var cntr = 1;
				locationarray.forEach(location => {
					$('div[name="token_card"]').each(function(index) {
						var lat = $(this).data('lat');
						var lng = $(this).data('lng');
						var order = $(this).data('order');
						if (order > 0)
							return;

						const to = new google.maps.LatLng(lat, lng);
						const distance = google.maps.geometry.spherical.computeDistanceBetween(location, to)

						var range = '{{ config("app.google_maps_distance_correction") }}';
						if (distance <= parseInt(range)) {
							$(this).data("order", cntr);
						}
					});
					cntr++;
				});

				$('div[name="token_card"]')
					.sort((a, b) => $(a).data("order") - $(b).data("order"))
					.appendTo("#mv_repeater_content");
			}
		}

		function secondsToMinutes(duration) {
			var minutes = Math.round((parseInt(duration.slice(0, -1)) / 60), 2);
			return minutes;
		}

		function getLocationName(location) {
			var locobj = $("#mv_data_locations").val();
			// console.log(location.lat);
			// console.log(location.lng);
			var _name = "";
			const from = new google.maps.LatLng(parseFloat(location.lat), parseFloat(location.lng));

			if (locobj != "") {
				var data = $.parseJSON(locobj);
				data.forEach(element => {
					// console.log(element.lat);
					// console.log(element.lon);
					const to = new google.maps.LatLng(element.lat, element.lon);
					const distance = google.maps.geometry.spherical.computeDistanceBetween(from, to)
					var range = '{{ config("app.google_maps_distance_correction") }}';
					if (distance <= parseInt(range)) {
						_name = element.name;
						return;
					}
				});
			}

			if (_name != "") {
				return _name;
			} else {
				return "Starting Point";
			}
		}

		function loadRouteLocations() {
			var dataobj = $("#mv_data_locations").val();

			var options = $('#start_point').empty();
			var options = $('#end_point').empty();

			if ($("#lng").val() != "") {
				var optstr = '<option value="-1" data-mv-rich-content-subcontent="" data-lat="' + $("#lat").val() + '" data-lng="' + $("#lng").val() + '">Current Location</option>';
				$('#start_point').append(optstr);
				$('#end_point').append(optstr);
			}


			if (dataobj != "") {
				var data = $.parseJSON(dataobj);
				data.forEach(element => {
					var optstr = '<option value="' + element.id + '" data-mv-rich-content-subcontent="' + element.address + '" data-lat="' + element.lat + '" data-lng="' + element.lon + '">' + element.name + '</option>';
					$('#start_point').append(optstr);
					$('#end_point').append(optstr);
				});
			}
		}

		function geoSuccess(position) {
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;

			$('#lat').val(lat);
			$('#lng').val(lng);

			loadRouteLocations();
			furthestLocation(position);
		}

		function geoError() {
			loadRouteLocations();
		}

		function furthestLocation(position) {
			var originArray = [];
			var destinationArray = [];
			var idArray = [];
			// build request
			const origin1 = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};

			$('#end_point > option').each(function() {
				if ($(this).val() != "" && $(this).val() != "-1") {
					idArray.push($(this).val());
					originArray.push({
						lat: position.coords.latitude,
						lng: position.coords.longitude
					});

					destinationArray.push({
						lat: parseFloat($(this).data('lat')),
						lng: parseFloat($(this).data('lng'))
					});
				}
			});

			const request = {
				origins: originArray,
				destinations: destinationArray,
				travelMode: google.maps.TravelMode.DRIVING,
				unitSystem: google.maps.UnitSystem.METRIC,
				avoidHighways: false,
				avoidTolls: false,
			};

			const service = new google.maps.DistanceMatrixService();
			// get distance matrix response
			service.getDistanceMatrix(request).then((response) => {

				// show on map
				const origins = response.originAddresses;
				const destinations = response.destinationAddresses;

				var results = response.rows[0].elements;
				var _highresult;
				var _lastdistance;
				var key = 0;
				for (var j = 0; j < results.length; j++) {
					var element = results[j];
					if (element.status == "OK") {
						var distance = element.distance.value;

						if (_lastdistance == null) {
							_lastdistance = distance;
							_highresult = element;
							key = j;
						}

						if (distance > _lastdistance) {
							_lastdistance = distance;
							_highresult = element;
							key = j;
						}
					}
				}

				var currentid = $('#end_point > option:selected').val();

				if (currentid != idArray[key]) {
					var _option = $('#end_point > option[value="' + idArray[key] + '"]');

					$("#mv_location_suggestion").data('id', idArray[key]);
					var _text = _option.text() + " - " + _highresult.distance.text + " (ETA: " + _highresult.duration.text + ")";
					$("#mv_location_suggestion").text(_text);

					// locationSuggestions
					$("#locationSuggestions").show();
				} else {
					$("#locationSuggestions").hide();
				}

				$("#end_point").val(idArray[key]);
				$("#end_point").trigger('change');
			});
		}

		var handleLocationSuggestion = () => {
			$("#mv_location_suggestion").on('click', function(e) {
				$("#end_point").val($(this).data('id'));
				$("#end_point").trigger('change');

			});
		}

		function initMap(response) {
			const directionsService = new google.maps.DirectionsService();
			const directionsRenderer = new google.maps.DirectionsRenderer({
				preserveViewport: true
			});

			var lat = "";
			var lng = "";

			// var card = $('div[name="token_card"]').each(function(index) {
			// 	lat = $(this).data('lat');
			// 	lng = $(this).data('lng');
			// 	return;
			// });


			var card = $('div[name="token_card"]').first();
			lat = card.data('lat');
			lng = card.data('lng');
 
			const map = new google.maps.Map(document.getElementById("token_map"), {
				zoom: 12,
				center: {
					lat: parseFloat(lat),
					lng: parseFloat(lng)
				},
			});

			directionsRenderer.setMap(map);
			directionsRenderer.setDirections(response);
		}

		var initSetup = () => {

			const locationoptionFormat = (item) => {
				if (!item.id) {
					return item.text;
				}

				var span = document.createElement('span');
				var template = '';

				template += '<div class="d-flex align-items-center">';
				template += '<div class="d-flex flex-column">'
				template += '<span class="fs-4 fw-bold lh-1">' + item.text + '</span>';
				template += '<span class="text-muted fs-5">' + item.element.getAttribute('data-mv-rich-content-subcontent') + '</span>';
				template += '</div>';
				template += '</div>';

				span.innerHTML = template;

				return $(span);
			}

			// Init Select2 --- more info: https://select2.org/
			$('#start_point').select2({
				placeholder: "Select a location",
				minimumResultsForSearch: 0,
				templateSelection: locationoptionFormat,
				templateResult: locationoptionFormat
			});

			$('#end_point').select2({
				placeholder: "Select a location",
				minimumResultsForSearch: 0,
				templateSelection: locationoptionFormat,
				templateResult: locationoptionFormat
			});

			$.ajax({
				type: 'get',
				url: '{{ URL::to("home/getclienttokens") }}',
				dataType: 'json',
				success: function(data) {
					if (data.locations.length > 2) {
						$("#mv_data_locations").val(JSON.stringify(data.locations));
						$("#btnCalculateRoute").removeClass('invisible').show();
						getCurrentLocation();
					} else {
						$("#btnCalculateRoute").hide();
					}

					if (data.tokens) {
						$("#mv_data_tokens").val(JSON.stringify(data.tokens));
						loadTokens();
					}

					if (data.routes) {
						sortRoute($.parseJSON(data.routes));
						initMap($.parseJSON(data.routes));
					}


				}
			});
		}

		function loadTokens() {
			var repItem = $('#mv_repeater_item');
			var content = $('#mv_repeater_content');
			var dataobj = $("#mv_data_tokens").val();
			content.html("")
			var cntr = 1;

			if (dataobj != "") {
				var data = $.parseJSON(dataobj);
				data.forEach(element => {
					var _clone = repItem.clone();

					_clone.removeClass("d-none");
					_clone.attr("id", "token_card_" + element.id);
					_clone.attr("name", "token_card");
					_clone.data("order", 0);

					var header = _clone.find("#rptTokenHeader");
					var status = _clone.find("#rptTokenStatus");
					if (element.status == 3) {
						header.addClass("bg-gray-400");
						status.text("Booked");
					} else {
						header.addClass("bg-primary");
						status.text("Checked In");
					}

					var name = _clone.find("#rptTokenLocation");
					name.text(element.locationname);

					var address = _clone.find("#rptTokenLocationAddress");
					address.text(element.address);

					var logo = _clone.find("#rptTokenLogo");
					logo.attr("src", element.logo);

					var tdate = _clone.find("#rptTokenDate");
					tdate.text(element.date);

					var button = _clone.find("#rptTokenButton");
					var url = "/home/current/" + element.id;
					button.attr("href", url);
					button.data("id", element.id);
					_clone.data("lat", element.lat);
					_clone.data("lng", element.lng);

					content.append(_clone);
					cntr++;
				});
			}


			content.show();


			if (dataobj != "") {
				var data = $.parseJSON(dataobj);
				data.forEach(element => {
					var optstr = '<option value="' + element.id + '" data-mv-rich-content-subcontent="' + element.address + '" data-lat="' + element.lat + '" data-lng="' + element.lng + '">' + element.name + '</option>';
					$('#start_point').append(optstr);
					$('#end_point').append(optstr);
				});
			}
		}

		function saveDirections(form, modal, submitButton, response) {

			$.ajax({
				url: form.action,
				type: form.method,
				dataType: 'json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					'route': JSON.stringify(response)
				},
				success: function(data) {

					// Remove loading indication
					submitButton.removeAttribute('data-mv-indicator');

					// Enable button
					submitButton.disabled = false;

					// Show popup confirmation 
					Swal.fire({
						text: "We have calculated the best route!",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn btn-primary"
						}
					}).then(function(result) {
						form.reset(); // Reset form	
						modal.hide(); // Hide modal
					});
				}
			});
		}

		function getDirections(form, modal, submitButton) {
			const directionsService = new google.maps.DirectionsService();
			const directionsRenderer = new google.maps.DirectionsRenderer({
				preserveViewport: true
			});


			var excludes = ["-1"];
			var _waypoints = [];
			var start_point = $("#start_point").find(":selected");

			const _origin = new google.maps.LatLng(parseFloat(start_point.data("lat")), parseFloat(start_point.data("lng")));
			if (start_point.val() != "-1") {
				excludes.push(start_point.val());
			}


			var end_point = $("#end_point").find(":selected");

			const _destination = new google.maps.LatLng(parseFloat(end_point.data("lat")), parseFloat(end_point.data("lng")));
			if (end_point.val() != "-1") {
				excludes.push(end_point.val());
			}

			var locobj = $("#mv_data_locations").val();

			if (locobj != "") {
				var data = $.parseJSON(locobj);
				data.forEach(element => {
					if (!excludes.includes(element.id + "")) {
						_waypoints.push({
							location: new google.maps.LatLng(element.lat, element.lon),
							stopover: true
						});
					}
				});
			}

			var start_time = $("#start_time");
			var _departureTime = new Date();
			if (!isNaN(start_time.val())) {
				_departureTime.setMinutes(_departureTime.getMinutes() + start_time.val());
			}

			const map = new google.maps.Map(document.getElementById("token_map"), {
				zoom: 7,
				center: _origin,
			});
			directionsRenderer.setMap(map);
			// return;
			var _request = {
				origin: _origin,
				destination: _destination,
				waypoints: _waypoints,
				optimizeWaypoints: true,
				provideRouteAlternatives: false,
				travelMode: 'DRIVING',
				drivingOptions: {
					departureTime: _departureTime,
					trafficModel: 'pessimistic'
				},
				unitSystem: google.maps.UnitSystem.IMPERIAL
			};

			directionsService
				.route(_request)
				.then((response) => {
					directionsRenderer.setDirections(response);
					sortRoute(response);
					saveDirections(form, modal, submitButton, response);
				})
				.catch((e) => {
					(status != undefined) ? console.error(status): console.log(e);
				});
			// .catch((e) => window.alert("Directions request failed due to " + status));
		}


		var handleForm = () => {
			// Shared variables
			const element = document.getElementById('mv_modal_calculate_route');
			const form = element.querySelector('#mv_modal_calculate_route_form');
			const modal = new bootstrap.Modal(element);

			// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
			var validator = FormValidation.formValidation(
				form, {
					fields: {
						'starting_point': {
							validators: {
								notEmpty: {
									message: 'Starting point is required'
								}
							}
						},
						'end_point': {
							validators: {
								notEmpty: {
									message: 'End point is required'
								}
							}
						},
						'start_time': {
							validators: {
								notEmpty: {
									message: 'Start time is required'
								}
							}
						},
					},

					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						bootstrap: new FormValidation.plugins.Bootstrap5({
							rowSelector: '.fv-row',
							eleInvalidClass: '',
							eleValidClass: ''
						})
					}
				}
			);





			// Close button handler
			const closeButton = element.querySelector('[data-mv-calcroute-modal-action="close"]');
			closeButton.addEventListener('click', e => {
				e.preventDefault();

				Swal.fire({
					text: "Are you sure you would like to close?",
					icon: "warning",
					showCancelButton: true,
					buttonsStyling: false,
					confirmButtonText: "Yes, close it!",
					cancelButtonText: "No, return",
					customClass: {
						confirmButton: "btn btn-primary",
						cancelButton: "btn btn-active-light"
					}
				}).then(function(result) {
					if (result.value) {
						modal.hide(); // Hide modal				
					}
				});
			});

			// Cancel button handler
			const cancelButton = element.querySelector('[data-mv-calcroute-modal-action="cancel"]');
			cancelButton.addEventListener('click', e => {
				e.preventDefault();

				Swal.fire({
					text: "Are you sure you would like to cancel?",
					icon: "warning",
					showCancelButton: true,
					buttonsStyling: false,
					confirmButtonText: "Yes, cancel it!",
					cancelButtonText: "No, return",
					customClass: {
						confirmButton: "btn btn-primary",
						cancelButton: "btn btn-active-light"
					}
				}).then(function(result) {
					if (result.value) {
						form.reset(); // Reset form	
						modal.hide(); // Hide modal				
					} else if (result.dismiss === 'cancel') {
						Swal.fire({
							text: "Your form has not been cancelled!.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-primary",
							}
						});
					}
				});
			});

			// Submit button handler
			const submitButton = element.querySelector('[data-mv-calcroute-modal-action="submit"]');

			submitButton.addEventListener('click', function(e) {
				// Prevent default button action
				e.preventDefault();

				// Validate form before submit
				if (validator) {
					validator.validate().then(function(status) {

						if (status == 'Valid') {
							// Show loading indication
							submitButton.setAttribute('data-mv-indicator', 'on');

							// Disable button to avoid multiple click 
							submitButton.disabled = true;
							getDirections(form, modal, submitButton);

						} else {
							// Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
							Swal.fire({
								text: "Sorry, looks like there are some errors detected, please try again.",
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn btn-primary"
								}
							});
						}
					});
				}
			});
		}

		return {
			// Public functions
			init: function() {
				initSetup();
				handleForm();
				handleLocationSuggestion();
			}
		};
	}();

	// On document ready
	MVUtil.onDOMContentLoaded(function() {
		MVCalcRouteActions.init();
	});
</script>