<x-base-layout>
	<!--begin::Card-->
	<div class="card">
		<!--begin::Card header-->
		<div class="card-header mt-6">
			<!--begin::Card title-->
			<div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1">
				<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
				<!--end::Svg Icon-->
				<input type="text" data-kt-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Permissions" />
			</div>
				<!--end::Search-->
			</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Button-->
				<button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_permission">
				<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen035.svg", "svg-icon-3") !!}

				<!--end::Svg Icon-->Add Permission</button>
				<!--end::Button-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
	     <!--begin::Card body-->
        <div class="card-body pt-6">
            @include('partials.widgets.tables._permissions')
        </div>
        <!--end::Card body-->
	</div>
	<!--end::Card-->
	<!--begin::Modals-->
	{{ theme()->getView('partials/modals/permissions/_add') }}

	{{ theme()->getView('partials/modals/permissions/_edit') }}
	
	<!--end::Modals-->

	</x-base-layout>