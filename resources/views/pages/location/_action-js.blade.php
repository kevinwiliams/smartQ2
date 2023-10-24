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
                        data: [
                            <?php
                            foreach ($visitor_summary as $x => $val) {
                                echo  $val->active . ',' . $val->complete . ',' . $val->no_show . ',' . $val->booked;
                            } ?>
                        ],
                        backgroundColor: ['#00A3FF', '#50CD89', '#FF0000', '#CCC']
                    }],
                    labels: ['Active', 'Completed', 'No Show', 'Booked']
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
                        name: 'Complete',
                        // data: [55, 55, 60, 60, 55, 55, 60]
                        data: [
                            <?php
                            if (!empty($biannual)) {
                                for ($i = 0; $i < sizeof($biannual); $i++) {
                                    echo (!empty($biannual[$i]) ? $biannual[$i]->complete : 0) . ", ";
                                }
                            }
                            ?>
                        ]

                    },
                    {
                        name: 'No Show',
                        // data: [70, 70, 80, 80, 75, 75, 75]
                        data: [
                            <?php
                            if (!empty($biannual)) {
                                for ($i = 0; $i < sizeof($biannual); $i++) {
                                    echo (!empty($biannual[$i]) ? $biannual[$i]->no_show : 0) . ", ";
                                }
                            }
                            ?>
                        ]
                    }

                ],
                chart: {
                    type: 'line',
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
                    // categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    categories: [
                        <?php
                        if (!empty($biannual)) {
                            for ($i = 0; $i < sizeof($biannual); $i++) {
                                echo (!empty($biannual[$i]) ? "'" . $biannual[$i]->month . "'" : 0) . ", ";
                            }
                        }
                        ?>
                    ],
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
                            return val + " customers"
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
                    size: 5,
                    colors: [lightSuccess, lightDanger],
                    strokeColor: [success, danger],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        var initTable = function() {
            var table = document.querySelector('#mv_profile_overview_table');

            if (!table) {
                return;
            }

            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[1].innerHTML, "MMM D, YYYY").format();
                dateRow[1].setAttribute('data-order', realDate);
            });

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            const datatable = $(table).DataTable({
                "info": false,
                'order': []
            });


            // Search --- official docs reference: https://datatables.net/reference/api/search()
            var filterSearch = document.getElementById('mv_filter_search');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }


        var initClipboard = function() {
            // Select element
            const target1 = document.getElementById('mv_clipboard_1');

            // Init clipboard
            var clipboard1 = new ClipboardJS(target1, {
                container: document.getElementById('mv_modal_location_qr')
            });

            // Success action handler
            clipboard1.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

                e.clearSelection();
                const currentLabel = target1.innerHTML;

                // Exit label update when already in progress
                if (target1.innerHTML === 'Copied!') {
                    return;
                }

                // Update button label
                target1.innerHTML = 'Copied!';

                // Revert button label after 3 seconds
                setTimeout(function() {
                    target1.innerHTML = currentLabel;
                }, 3000)
            });

            //------------------------------------------------
            // Select element
            const target2 = document.getElementById('mv_clipboard_2');

            // Init clipboard
            var clipboard2 = new ClipboardJS(target2, {
                container: document.getElementById('mv_modal_location_qr')
            });

            // Success action handler
            clipboard2.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

                e.clearSelection();
                const currentLabel = target2.innerHTML;

                // Exit label update when already in progress
                if (target2.innerHTML === 'Copied!') {
                    return;
                }

                // Update button label
                target2.innerHTML = 'Copied!';

                // Revert button label after 3 seconds
                setTimeout(function() {
                    target2.innerHTML = currentLabel;
                }, 3000)
            });
        }

        // Public methods
        return {
            init: function() {
                initChart();
                initGraph();
                initClipboard();
            }
        }
    }();


    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        MVLocationOverview.init();
    });
</script>