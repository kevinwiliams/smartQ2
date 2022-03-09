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
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-report-table-toolbar="base">
				<!--begin::Filter-->
				<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
				<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                {!! theme()->getSvgIcon("icons/duotune/general/gen031.svg", "svg-icon-2") !!}

				<!--end::Svg Icon-->Filter</button>
				<!--begin::Menu 1-->
				<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
					<!--begin::Header-->
					<div class="px-7 py-5">
						<div class="fs-5 text-dark fw-bolder">Filter Options</div>
					</div>
					<!--end::Header-->
					<!--begin::Separator-->
					<div class="separator border-gray-200"></div>
					<!--end::Separator-->
					<!--begin::Content-->
					<div class="px-7 py-5" data-kt-report-table-filter="form">
						<!--begin::Input group-->
						<div class="mb-10">
							<label class="form-label fs-6 fw-bold">Status:</label>
                            {{-- {{ Form::select('id', $status, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }} --}}

							<select class="form-select form-select-solid form-select-lg fw-bold" data-kt-select2="true" data-control= "select2" data-placeholder="Select option" data-allow-clear="true" data-kt-report-table-filter="status" data-hide-search="true" name="status">
								<option></option>
								<option value="0">Pending</option>
								<option value="1">Complete</option>
								<option value="2">Cancelled</option>
								<option value="3">Booked</option>
							</select>
						</div>
						<!--end::Input group-->
                        <!--begin::Input group-->
						<div class="mb-10">
							<label class="form-label fs-6 fw-bold">Department:</label>
                            {{ Form::select('department_id', $departments, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-kt-report-table-filter' => 'departments' ,'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}

						</div>
						<!--end::Input group-->
                        <!--begin::Input group-->
						<div class="mb-10">
							<label class="form-label fs-6 fw-bold">Counter:</label>
                            {{ Form::select('counter_id', $counters, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-kt-report-table-filter' => 'counters', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}

						</div>
						<!--end::Input group-->
                        <!--begin::Input group-->
						<div class="mb-10">
							<label class="form-label fs-6 fw-bold">Officers:</label>
                            {{ Form::select('user_id', $officers, null, ['data-placeholder' => 'Select Option','placeholder' => 'Select Option', 'data-kt-report-table-filter' => 'officers', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
						</div>
						<!--end::Input group-->						
						<!--begin::Actions-->
						<div class="d-flex justify-content-end">
							<button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-report-table-filter="reset">Reset</button>
							<button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-report-table-filter="filter">Apply</button>
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Menu 1-->
				<!--end::Filter-->
				<!--begin::Export-->
				<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr078.svg", "svg-icon-2") !!}

				<!--end::Svg Icon-->Export</button>
				<!--end::Export-->
				
			</div>
			<!--end::Toolbar-->
			<!--begin::Group actions-->
			<div class="d-flex justify-content-end align-items-center d-none" data-kt-report-table-toolbar="selected">
				<div class="fw-bolder me-5">
				<span class="me-2" data-kt-report-table-select="selected_count"></span>Selected</div>
				<button type="button" class="btn btn-danger" data-kt-report-table-select="delete_selected">Delete Selected</button>
			</div>
			<!--end::Group actions-->
			<!--begin::Modal - Adjust Balance-->
			<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
				<!--begin::Modal dialog-->
				<div class="modal-dialog modal-dialog-centered mw-650px">
					<!--begin::Modal content-->
					<div class="modal-content">
						<!--begin::Modal header-->
						<div class="modal-header">
							<!--begin::Modal title-->
							<h2 class="fw-bolder">Export Users</h2>
							<!--end::Modal title-->
							<!--begin::Close-->
							<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-report-modal-action="close">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}

								<!--end::Svg Icon-->
							</div>
							<!--end::Close-->
						</div>
						<!--end::Modal header-->
						<!--begin::Modal body-->
						<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
							<!--begin::Form-->
							<form id="kt_modal_export_users_form" class="form" action="#">
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="role" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bolder">
										<option></option>
										<option value="Administrator">Administrator</option>
										<option value="Analyst">Analyst</option>
										<option value="Developer">Developer</option>
										<option value="Support">Support</option>
										<option value="Trial">Trial</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="required fs-6 fw-bold form-label mb-2">Select Export Format:</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="format" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bolder">
										<option></option>
										<option value="excel">Excel</option>
										<option value="pdf">PDF</option>
										<option value="cvs">CVS</option>
										<option value="zip">ZIP</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
									<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Modal body-->
					</div>
					<!--end::Modal content-->
				</div>
				<!--end::Modal dialog-->
			</div>
			<!--end::Modal - New Card-->
		
		</div>
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
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_example_1 .form-check-input" value="1"/>
                    </div>
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
                <th>{{ trans('app.action') }}</th>
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
                    _token : '{{ csrf_token() }}'
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
          
        });


        
        //var table = $('#token-table').DataTable();
       
        const filterSearch = document.querySelector('[data-kt-report-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            var table = $('#token-table').DataTable();
            table.search(e.target.value).draw();
        });
        
        // Filter Datatable
        // var handleFilterDatatable = () => {
            // Select filter options
            const filterStatus = document.querySelectorAll('[data-kt-report-table-filter="status"]');
            console.log('filterStatus', $(filterStatus).val());
            const filterDepts = document.querySelectorAll('[data-kt-report-table-filter="departments"]');
            const filterCntrs = document.querySelectorAll('[data-kt-report-table-filter="counters"]');
            const filterOffcrs = document.querySelectorAll('[data-kt-report-table-filter="officers"]');

            const filterButton = document.querySelector('[data-kt-report-table-filter="filter"]');

            // Filter datatable on submit
            filterButton.addEventListener('click', function () {
                // Get filter values
                let statusVal = $(filterStatus).val();
                console.log(statusVal);
               
                // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                var table = $('#token-table').DataTable();
                // table.columns(7).search(statusVal, false, false, true).draw();
                table.search(statusVal, false, false, true).draw();
            });
        // }
      </script>

    @endsection
</x-base-layout>