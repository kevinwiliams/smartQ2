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
				<input type="text" data-mv-report-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Tokens" />
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
                <th class="all">{{ trans('app.action') }}</th>
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

	<!--begin::Modal - Transfer Token-->
	{{ theme()->getView('partials/modals/token/_transfer', 
	array(
		'officers' => $officers, 
		'counters' => $counters, 
		'departments' => $departments
		)) }}
	<!--end::Modal - Transfer Token-->


    @section('scripts')
    @include('pages.admin.token._action-js')
    @include('pages.admin.token._button-actions-js')

    @endsection
</x-base-layout>