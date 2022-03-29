<x-base-layout>
	<!--begin::Card-->
	<div class="card">
		<!--begin::Card header-->

		<div class="card-header mt-6">
			<!--begin::Card title-->
			<div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1 me-5">
					<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
					{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
					<!--end::Svg Icon-->
					<input type="text" data-mv-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Permissions">
				</div>
				<!--end::Search-->
			</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Button-->
				<button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_add_permission">
					<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->

					{!! theme()->getSvgIcon("icons/duotune/general/gen035.svg", "svg-icon-3") !!}

					<!--end::Svg Icon-->
					Add Permission
				</button>
				<!--end::Button-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
		<!--begin::Card body-->
		<div class="card-body pt-6">
			<!--begin::Table-->
			{{ $dataTable->table() }}
			<!--end::Table-->
		</div>
		<!--end::Card body-->
	</div>
	<!--end::Card-->
	<!--begin::Modals-->
	<!--begin::Modal - Add permissions-->
	{{ theme()->getView('partials/modals/permissions/_add') }}
	<!--end::Modal - Add permissions-->
	<!--begin::Modal - Update permissions-->
	{{ theme()->getView('partials/modals/permissions/_edit') }}
	<!--end::Modal - Update permissions-->
	<!--end::Modals-->
	@section('scripts')
	{{ $dataTable->scripts() }}
	@include('pages.apps.user-management.permissions._list-js')
	@include('pages.apps.user-management.permissions._add-permission-js')
	@include('pages.apps.user-management.permissions._update-permission-js')
	@endsection
</x-base-layout>