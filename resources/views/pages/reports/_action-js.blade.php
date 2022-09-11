<script>
    "use strict";

    // Class definition
    var MVLocationOverview = function() {
        // Colors
        var primary = MVUtil.getCssVariableValue('--bs-primary');
        var lightPrimary = MVUtil.getCssVariableValue('--bs-light-primary');
        var success = MVUtil.getCssVariableValue('--bs-success');
        var danger = MVUtil.getCssVariableValue('--bs-danger');
        var lightSuccess = MVUtil.getCssVariableValue('--bs-light-success');
        var lightDanger = MVUtil.getCssVariableValue('--bs-light-danger');
        var gray200 = MVUtil.getCssVariableValue('--bs-gray-200');
        var gray500 = MVUtil.getCssVariableValue('--bs-gray-500');
        var table;
        var datatable;
        // Private functions
        var initChart = function() {
            // init chart
            var element = document.getElementById("project_overview_chart");

            if (!element) {
                return;
            }

            var config = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [30, 45, 25],
                        backgroundColor: ['#00A3FF', '#50CD89', '#E4E6EF']
                    }],
                    labels: ['Active', 'Completed', 'Yet to start']
                },
                options: {
                    chart: {
                        fontFamily: 'inherit'
                    },
                    cutoutPercentage: 75,
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    title: {
                        display: false
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    tooltips: {
                        enabled: true,
                        intersect: false,
                        mode: 'nearest',
                        bodySpacing: 5,
                        yPadding: 10,
                        xPadding: 10,
                        caretPadding: 0,
                        displayColors: false,
                        backgroundColor: '#20D489',
                        titleFontColor: '#ffffff',
                        cornerRadius: 4,
                        footerSpacing: 0,
                        titleSpacing: 0
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            };

            var ctx = element.getContext('2d');
            var myDoughnut = new Chart(ctx, config);
        }

        var initGraph = function() {
            var element = document.getElementById("mv_project_overview_graph");
            var height = parseInt(MVUtil.css(element, 'height'));

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'Incomplete',
                    data: [70, 70, 80, 80, 75, 75, 75]
                }, {
                    name: 'Complete',
                    data: [55, 55, 60, 60, 55, 55, 60]
                }],
                chart: {
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {

                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [success, danger]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: gray500,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: success,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: gray500,
                            fontSize: '12px',
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function(val) {
                            return val + " tasks"
                        }
                    }
                },
                colors: [lightSuccess, lightDanger],
                grid: {
                    borderColor: gray200,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    //size: 5,
                    colors: [lightSuccess, lightDanger],
                    strokeColor: [success, danger],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        var initTable = function() {
            table = document.querySelector("#mv_report_table_1");            
            console.log(table);
            if (!table) {
                console.log('no table');
                return;
            }
            console.log('table');
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": true,
                    'columnDefs': []
            });
        }

        var initDatePicker = function() {
            var start = moment().subtract(29, "days");
            var end = moment();
            var initialDate = $("#mv_daterangepicker").val();
            if (initialDate != "") {
                var dates = initialDate.split("-");
                start = moment(dates[0], 'MM/DD/YYYY');
                end = moment(dates[1], 'MM/DD/YYYY');
            }


            $("#mv_daterangepicker").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, cb);

            cb(start, end);
        }

        var initSearch = function() {
            // Shared variables
            const element = document.getElementById('mv_content_container');
            const form = element.querySelector('#mv_report_search_form');
            // const modal = new bootstrap.Modal(element);
            // console.log(form);
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'report': {
                            validators: {
                                notEmpty: {
                                    message: 'Report is required'
                                }
                            }
                        },
                        'location_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Location is required'
                                }
                            }
                        },
                        'daterange': {
                            validators: {
                                notEmpty: {
                                    message: 'Date range is required'
                                }
                            }
                        }

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

            // Submit button handler
            const submitButton = element.querySelector('[data-mv-search-action="submit"]');

            submitButton.addEventListener('click', e => {
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-mv-indicator', 'on');

                            var report = $("#report").val();
                            var daterange = $("#mv_daterangepicker").val();
                            var locations = $("#location_id").val();
                            if(Array.isArray(locations)){
                                var locationJoin = locations.join(',');
                            }else{
                                var locationJoin = locations;
                            }
                            

                            // Disable button to avoid multiple click 
                            // submitButton.disabled = true;
                            // console.log(locationJoin); 
                            var url = "/reports?report=" + report + "&location_id=" + locationJoin + "&daterange=" + daterange;
                            console.log(url);
                            location.href = url;
                            // form.action = url;
                            // form.submit();

                            // $.ajax({
                            //     url: form.action,
                            //     type: form.method,
                            //     dataType: 'json',
                            //     headers: {
                            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            //     },
                            //     contentType: false,
                            //     cache: false,
                            //     processData: false,
                            //     data: new FormData(form),
                            //     // success: function(data)

                            //     // url: '{{ URL::to("client/token/checkin") }}/' + id,
                            //     // type: 'get',
                            //     // dataType: 'json',
                            //     success: function(data) {
                            //         // document.location.href = '/client';
                            //         // setInterval( function () {
                            //         //     table.ajax.reload();
                            //         // }, 2000 );
                            //         // Remove loading indication
                            //         submitButton.removeAttribute('data-mv-indicator');

                            //         // Enable button
                            //         submitButton.disabled = false;

                            //         // Show popup confirmation 
                            //         Swal.fire({
                            //             text: "Form has been successfully submitted!",
                            //             icon: "success",
                            //             buttonsStyling: false,
                            //             confirmButtonText: "Ok, got it!",
                            //             customClass: {
                            //                 confirmButton: "btn btn-primary"
                            //             }
                            //         }).then(function(result) {
                            //             if (result.isConfirmed) {
                            //                 location.reload();
                            //                 form.reset();
                            //                 modal.hide();
                            //             }
                            //         });
                            //     }
                            // });

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
        // Hook export buttons
        var exportButtons = () => {
            if (table == null) {
                return;
            }
            if (!table) {
                return;
            }
            // return;

            const documentTitle = $("#report_title").val();
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'copyHtml5',
                        title: documentTitle,
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_1_export'));

            // console.log(buttons);

            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_1_export_menu [data-mv-export]');
            // console.log(exportButtons);
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-mv-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
                    console.log(exportValue);
                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }

        function cb(start, end) {
            $("#mv_daterangepicker").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }
        // Public methods


        var weeklytokenChart = function() {
            var charts = document.querySelectorAll("#weekly-token-report-chart");
            if (charts == null) {
                return;
            }

            var color;
            var height;
            var labelColor = MVUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = MVUtil.getCssVariableValue('--bs-gray-200');
            var baseLightColor;
            var secondaryColor = MVUtil.getCssVariableValue('--bs-gray-300');
            var baseColor;
            var options;
            var chart;
            var color3;
            var color4;
            var color5;

            [].slice.call(charts).map(function(element) {
                color = element.getAttribute("data-mv-color");
                height = parseInt(MVUtil.css(element, 'height'));
                baseColor = MVUtil.getCssVariableValue('--bs-' + color);
                color3 = MVUtil.getCssVariableValue('--bs-success');
                color4 = MVUtil.getCssVariableValue('--bs-info');
                color5 = MVUtil.getCssVariableValue('--bs-warning');
                options = {
                    series: <?php echo json_encode(($data->graph)?$data->seriesdata:[]); ?>,
                    chart: {
                        fontFamily: 'inherit',
                        type: 'bar',
                        height: height,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            // columnWidth: ['10%'],
                            borderRadius: 4
                        },
                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        // categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        categories: <?php echo json_encode(($data->graph)?$data->categories:[]); ?>,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        y: 0,
                        offsetX: 0,
                        offsetY: 0,
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    fill: {
                        type: 'solid'
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return val + " persons"
                            }
                        }
                    },
                    colors: [baseColor, secondaryColor, color3, color4, color5],
                    grid: {
                        padding: {
                            top: 10
                        },
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    }
                };

                chart = new ApexCharts(element, options);
                chart.render();
            });
        }

        return {
            init: function() {                
                // initChart();
                // initGraph();
                initTable();                
                initDatePicker();
                initSearch();
                exportButtons();
                weeklytokenChart();
            }
        }
    }();



    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        setTimeout(() => {
            MVLocationOverview.init();

        }, 1);

    });
</script>