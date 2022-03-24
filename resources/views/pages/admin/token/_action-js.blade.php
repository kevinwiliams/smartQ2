<script type="text/javascript">
    $(function () {
        // DATATABLE
         drawDataTable();

        
        function drawDataTable(){
            $('#token-table').DataTable().destroy();
            var table = $('#token-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                order: [7, "desc"],
                dom:
                "<'table-responsive'tr><'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'li>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",

                renderer: 'bootstrap',
                ajax: {
                    url:'<?= url('admin/token/report/data'); ?>',
                    dataType: 'json',
                    type    : 'post',
                    data    : {
                        _token : '{{ csrf_token() }}',
                        search: {
                            status     : $('[data-kt-report-table-filter="status"]').val(),
                            counter    : $('[data-kt-report-table-filter="counters"]').val(),
                            department : $('[data-kt-report-table-filter="departments"]').val(),
                            officer    : $('[data-kt-report-table-filter="officers"]').val(),
                            start_date : $('#start_date').val(),
                            end_date   : $('#end_date').val(),
                        }
                            },
                },
                
                columns: [
                    { data: 'serial' },
                    { data: 'token_no' },
                    { data: 'department' },
                    { data: 'counter' },
                    { data: 'officer' },
                    { data: 'client_mobile' }, 
                    { data: 'note' }, 
                    { data: 'status' }, 
                    { data: 'created_by' },
                    { data: 'created_at' },
                    { data: 'updated_at' }, 
                    { data: 'complete_time' },
                    { data: 'options', sortable: false, searchable: false, width: '10px'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                        'targets': 1,
                        'createdCell':  function (td, cellData, rowData, row, col) {
                            $(td).attr('id', rowData['token_id']); 
                            // console.log('td', td);
                            // console.log('cellData', cellData);
                            // console.log('rowData', rowData['token_id']);
                            // console.log('row', row);
                        }
                    },
                    {
                        'targets': 2,
                        'createdCell':  function (td, cellData, rowData, row, col) {
                            $(td).attr('id', rowData['department_id']); 
                        }
                    },
                    {
                        'targets': 3,
                        'createdCell':  function (td, cellData, rowData, row, col) {
                            $(td).attr('id', rowData['counter_id']); 
                        }
                    },
                    {
                        'targets': 4,
                        'createdCell':  function (td, cellData, rowData, row, col) {
                            $(td).attr('id', rowData['officer_id']); 
                        }
                    }
                ]
        
            });

            table.on('draw', function () {
                KTMenu.createInstances();
                KTTokenActions.init();
            });
        }
    
        const filterButton = document.querySelector('[data-kt-report-table-filter="filter"]');
        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            // Get filter values
            drawDataTable();
        });

        const filterStatus = $('[data-kt-report-table-filter="status"]');
        const filterDepts = $('[data-kt-report-table-filter="departments"]');
        const filterCntrs = $('[data-kt-report-table-filter="counters"]');
        const filterOffcrs = $('[data-kt-report-table-filter="officers"]');
        
        const resetButton = document.querySelector('[data-kt-report-table-filter="reset"]');
        // Reset datatable
        resetButton.addEventListener('click', function () {

            filterStatus.select2({ placeholder: "Status" });
            filterStatus.val('').trigger('change');

            filterDepts.select2({ placeholder: "Department" });
            filterDepts.val('').trigger('change');

            filterCntrs.select2({ placeholder: "Counter" });
            filterCntrs.val('').trigger('change');

            filterOffcrs.select2({ placeholder: "Officers" });
            filterOffcrs.val('').trigger('change');

            drawDataTable();
            //table.search('').draw();
        });
        
        // modal open with token id
        $('#kt_modal_transfer_token').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            $('input[name=id]').val(button.data('token-id'));
            //set back options from selected token
            setTimeout(() => {
                $('select[name=department_id]').val($('input[name=departmentID]').val());
                $('select[name=department_id]').trigger('change');

                $('select[name=counter_id]').val($('input[name=counterID]').val());
                $('select[name=counter_id]').trigger('change');

                $('select[name=user_id]').val($('input[name=officerID]').val());
                $('select[name=user_id]').trigger('change');
                //alert($('select[name=department_id]').val());
            }, 500);
            

        }); 

       // var reportDateRange = function(element) {
            var start = moment().subtract(29, "days");
            var end = moment();

            function cb(start, end) {
                $("#kt_token_report_daterangepicker").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
                $('#start_date').val(start);
                $('#end_date').val(end);
                // alert($('#start_date').val());
                drawDataTable();

            }

            $("#kt_token_report_daterangepicker").daterangepicker({
                // autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
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

            // cb(start, end);
    //}
    });


    const filterSearch = document.querySelector('[data-kt-report-table-filter="search"]');

    filterSearch.addEventListener('keyup', function (e) {
        var table = $('#token-table').DataTable();
        table.search(e.target.value).draw();
    });

    
    
</script>