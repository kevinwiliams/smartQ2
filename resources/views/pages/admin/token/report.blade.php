<x-base-layout>
    <!--begin::Card-->
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 pt-6">
		<!--begin::Card title-->
		<div class="card-title">
			<!--begin::Search-->
			<div class="d-flex align-items-center position-relative my-1">
				<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
				<!--end::Svg Icon-->
				<input type="text" data-kt-report-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Tokens" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		{{ theme()->getView('pages/admin/token/_report-toolbar', 
        array(
            'officers' => $officers, 
            'counters' => $counters, 
            'departments' => $departments
            )) }}
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body py-4">
    
        <!--begin::Datatable-->
        <table id="token-table" class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>

            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">
                    ID
                </th>
                <th>{{ trans('app.token_no') }}</th> 
                <th>{{ trans('app.department') }}</th>
                <th>{{ trans('app.counter') }}</th>
                <th>{{ trans('app.officer') }}</th>
                <th>{{ trans('app.client_mobile') }}</th>
                <th>{{ trans('app.note') }}</th> 
                <th>{{ trans('app.status') }}</th>
                <th>{{ trans('app.created_by') }}</th>
                <th>{{ trans('app.created_at') }}</th>
                <th>{{ trans('app.updated_at') }}</th>
                <th>{{ trans('app.complete_time') }}</th>
                <th></th>
                {{-- <th class="text-end min-w-100px">Actions</th> --}}
            </tr>
            </thead>
            <tbody class="text-gray-600 fw-bold">
            </tbody>
        </table>
        <!--end::Datatable-->
    </div>
	<!--end::Card body-->
</div>
<!--end::Card-->



    @section('scripts')
    <script type="text/javascript">
        $(function () {
            // DATATABLE
             drawDataTable();

            // $("body").on("change",".filter", function(){
            //     drawDataTable();
            // });
            
            function drawDataTable(){
                $('#token-table').DataTable().destroy();
                var table = $('#token-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    order: [7, "asc"],
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
                                // start_date : $('#start_date').val(),
                                // end_date   : $('#end_date').val(),
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
                        { data: 'options' },
                        // {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
            
            	});

				table.on('draw', function () {
					KTMenu.createInstances();
					// handleFilterDatatable();
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
			
        });


        
        //var table = $('#token-table').DataTable();
		

        const filterSearch = document.querySelector('[data-kt-report-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            var table = $('#token-table').DataTable();
            table.search(e.target.value).draw();
        });

		// $("#report_date_range").daterangepicker({
		// 	timePicker: true,
		// 	startDate: moment().startOf("hour"),
		// 	endDate: moment().startOf("hour").add(32, "hour"),
		// 	locale: {
		// 		format: "M/DD hh:mm A"
		// 	}
		// });
        
        
      </script>

    @endsection
</x-base-layout>