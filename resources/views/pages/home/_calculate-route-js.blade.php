<script>
	// Class definition
	var MVCalcRouteActions = function() {


		function calculateRoute() {
			Swal.fire({
				html: "Are you sure?.",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn btn-light"
				}
			}).then(function(value) {
				if (value.isConfirmed) {
					$.ajax({
						type: 'post',
						url: '{{ URL::to("home/computeRoute") }}',
						type: 'POST',
						dataType: 'json',
						data: {
							'_token': '<?php echo csrf_token() ?>'
						},
						success: function(data) {
							console.log(data);
						}
					});
				}


			});
		}

		function getCurrentLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
			} else {
				console.log("Geolocation is not supported by this browser.");
			}
		}

		function loadTokenLocations() {
			var dataobj = $("#mv_data_locations").val();
			console.log(dataobj);

			var options = $('#start_point').empty();
			var options = $('#end_point').empty();
			$('#start_point').append('<option value="" data-mv-rich-content-subcontent="">Select a location</option>');
			$('#end_point').append('<option value="" data-mv-rich-content-subcontent="">Select a location</option>');

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
			// $("#mv_data_my_location").val(lat + "," + lng);
			$('#lat').val(lat);
			$('#lng').val(lng);
			console.log(lat, lng);			
			loadTokenLocations();
			furthestLocation(position);
		}

		function geoError() {
			console.log("Geocoder failed.");
			loadTokenLocations();
			// $("#locationSuggestions").hide();
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

			// console.log(request);
			// return;
            const service = new google.maps.DistanceMatrixService();
            // get distance matrix response
            service.getDistanceMatrix(request).then((response) => {
                //console.log(response);
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
                    console.log(_option.text());
                    $("#mv_location_suggestion").data('id', idArray[key]);
                    var _text = _option.text() + " - " + _highresult.distance.text + " (ETA: " + _highresult.duration.text + ")";
                    $("#mv_location_suggestion").text(_text);
                    // locationSuggestions
                    $("#locationSuggestions").show();
                } else {
                    $("#locationSuggestions").hide();
                }

            });
        }

		var handleLocationSuggestion = () => {
            $("#mv_location_suggestion").on('click', function(e) {
                $("#end_point").val($(this).data('id'));
                $("#end_point").trigger('change');
                // console.log(e);
            });
        }

		var initSetup = () => {
			$("#start_time").flatpickr({
				altInput: true,
				altFormat: "F j, Y h:i K",
				enableTime: true,
				dateFormat: "Y-m-d h:i K",
				minDate: "today",
				defaultDate: new Date(),
			});



			$("#btnCalculateRoute").hide();


			const locationoptionFormat = (item) => {
				if (!item.id) {
					return item.text;
				}

				var span = document.createElement('span');
				var template = '';

				template += '<div class="d-flex align-items-center">';
				//template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="rounded-circle h-40px me-3" alt="' + item.text + '"/>';
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
					//console.log(data);
					if (data.locations.length > 2) {
						$("#mv_data_locations").val(JSON.stringify(data.locations));
						$("#btnCalculateRoute").show();
						getCurrentLocation();
					} else {
						$("#btnCalculateRoute").hide();
					}

					//Write token info to screen
					//data.tokens

				}
			});


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
						console.log('validated!');

						if (status == 'Valid') {
							// Show loading indication
							submitButton.setAttribute('data-mv-indicator', 'on');

							// Disable button to avoid multiple click 
							submitButton.disabled = true;
							$.ajax({
								url: form.action,
								type: form.method,
								dataType: 'json',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								contentType: false,
								cache: false,
								processData: false,
								data: new FormData(form),

								success: function(data) {
									console.log(data);

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

									});
								}
							});
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