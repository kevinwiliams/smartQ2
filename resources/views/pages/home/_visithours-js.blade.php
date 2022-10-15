<script>
    // Class definition
    var MVCharts = function() {
        var chart;

        var initVisitHoursChart = function() {
            var element = document.getElementById("mv_charts_widget_9_chart");

            var height = parseInt(MVUtil.css(element, 'height'));

            var labelColor = MVUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = MVUtil.getCssVariableValue('--bs-gray-200');
            var strokeColor = MVUtil.getCssVariableValue('--bs-gray-300');

            var color1 = MVUtil.getCssVariableValue('--bs-warning');
            var color1Light = MVUtil.getCssVariableValue('--bs-light-warning');

            var color2 = MVUtil.getCssVariableValue('--bs-success');
            var color2Light = MVUtil.getCssVariableValue('--bs-light-success');

            var color3 = MVUtil.getCssVariableValue('--bs-primary');
            var color3Light = MVUtil.getCssVariableValue('--bs-light-primary');

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [30, 30, 50, 50, 35, 35]
                }, {
                    name: 'Revenue',
                    data: [55, 20, 20, 20, 70, 70]
                }, {
                    name: 'Expenses',
                    data: [60, 60, 40, 40, 30, 30]
                }, ],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
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
                    width: 2,
                    colors: [color1, color2, color3]
                },
                xaxis: {
                    x: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                    },
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: strokeColor,
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
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: {
                        left: 0,
                        right: 0
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
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
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [color1Light, color2Light, color3Light],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    padding: {
                        top: 0,
                        bottom: 0,
                        left: 0,
                        right: 0
                    }
                },
                markers: {
                    colors: [color1, color2, color3],
                    strokeColor: [color1, color2, color3],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        var initVisitHoursChart2 = function() {
            var element = document.getElementById('mv_charts_widget_9_chart');

            var height = parseInt(MVUtil.css(element, 'height'));
            var labelColor = MVUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = MVUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = MVUtil.getCssVariableValue('--bs-primary');
            var secondaryColor = MVUtil.getCssVariableValue('--bs-gray-300');

            if (!element) {
                return;
            }

            var options2 = {
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105]
                }],
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
                        columnWidth: ['30%'],
                        endingShape: 'rounded'
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
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
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
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
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
                            return '$' + val + ' thousands'
                        }
                    }
                },
                colors: [baseColor, secondaryColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },

                series: [],
                // title: {
                //     text: 'Ajax Example',
                // },
                noData: {
                    text: 'Loading...'
                }
            }
            chart = new ApexCharts(element, options);
            chart.render();
        }

        var handleDataLookup = () => {

            var _table = document.querySelector('#mv_company_table');
            const weekdayButtons = document.querySelectorAll('[data-mv-busyhours-table-filter="fetch_data"]');

            // console.log(weekdayButtons);
            // return;
            weekdayButtons.forEach(d => {
                // Delete button on click

                d.addEventListener('click', function(e) {

                    e.preventDefault();
                    console.log($('.active[data-mv-busyhours-table-filter="fetch_data"]').data('weekday'));
                    busyHoursLookup();
                    

                    // var weekday = $(this).data('weekday');
                    // var location = $("#mv_location_list").val();
                    // if (location == "") {
                    //     console.debug('no location');
                    //     return;
                    // }


                    // $.ajax({
                    //     url: '/location/getBusyHours/',
                    //     type: "post",
                    //     dataType: 'json',
                    //     data: {
                    //         location_id: location,
                    //         weekday: weekday
                    //     },
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     success: function(response) {
                    //         console.log(response.data);
                    //         chart.updateSeries([{
                    //             name: 'Visitors',
                    //             data: response.data
                    //         }])
                    //     }
                    // }).fail(function(jqXHR, textStatus, error) {
                    //     console.error(jqXHR.responseText);
                    //     console.error(textStatus);
                    //     console.error(error);
                    // });
                })
            });

            // $("#mv_location_list").on('change', function(e) {
            //     $('.active[data-mv-busyhours-table-filter="fetch_data"]').trigger('click');
            // });
            // $('.active[data-mv-busyhours-table-filter="fetch_data"]').trigger('click');

        }

        function busyHoursLookup() {
            var weekday = $('.active[data-mv-busyhours-table-filter="fetch_data"]').data('weekday');
            var location = $("#mv_location_list").val();
            if (location == "") {
                console.debug('no location');
                return;
            }


            $.ajax({
                url: '/location/getBusyHours/',
                type: "post",
                dataType: 'json',
                data: {
                    location_id: location,
                    weekday: weekday
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data);
                    chart.updateSeries([{
                        name: 'Visitors',
                        data: response.data
                    }])
                }
            }).fail(function(jqXHR, textStatus, error) {
                console.error(jqXHR.responseText);
                console.error(textStatus);
                console.error(error);
            });
        }

        // Public methods
        return {
            init: function() {
                // Statistics widgets
                initVisitHoursChart2();
                handleDataLookup();
            }
        }
    }();

    // Webpack support
    if (typeof module !== 'undefined') {
        module.exports = MVCharts;
    }

    // On document ready
    MVUtil.onDOMContentLoaded(function() {
        MVCharts.init();
    });
</script>