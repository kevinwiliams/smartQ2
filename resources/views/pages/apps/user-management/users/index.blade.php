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
					<input type="text" data-mv-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
				</div>
				<!--end::Search-->
			</div>
			<!--begin::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Toolbar-->
				<div class="d-flex justify-content-end" data-mv-user-table-toolbar="base">
					<!--begin::Filter-->
					<button type="button" class="btn btn-light-primary me-3" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">
						<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
						{!! theme()->getSvgIcon("icons/duotune/general/gen031.svg", "svg-icon-2") !!}
						<!--end::Svg Icon-->Filter
					</button>
					<!--begin::Menu 1-->
					<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-mv-menu="true">
						<!--begin::Header-->
						<div class="px-7 py-5">
							<div class="fs-5 text-dark fw-bolder">Filter Options</div>
						</div>
						<!--end::Header-->
						<!--begin::Separator-->
						<div class="separator border-gray-200"></div>
						<!--end::Separator-->
						<!--begin::Content-->
						<div class="px-7 py-5" data-mv-user-table-filter="form">
							<!--begin::Input group-->
							<div class="mb-10">
								<label class="form-label fs-6 fw-bold">Role:</label>
								<select class="form-select form-select-solid fw-bolder" data-placeholder="Select option" data-allow-clear="true" data-mv-user-table-filter="role" data-hide-search="true">
									<option></option>
									@foreach($roles as $_role)
									<option value="{{ $_role->name }}">{{ ucwords($_role->name) }}</option>
									@endforeach
								</select>
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<!-- <div class="mb-10">
							<label class="form-label fs-6 fw-bold">Two Step Verification:</label>
							<select class="form-select form-select-solid fw-bolder" data-placeholder="Select option" data-allow-clear="true" data-mv-user-table-filter="two-step" data-hide-search="true">
								<option></option>
								<option value="Enabled">Enabled</option>
							</select>
						</div> -->
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="d-flex justify-content-end">
								<button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-mv-menu-dismiss="true" data-mv-user-table-filter="reset">Reset</button>
								<button type="submit" class="btn btn-primary fw-bold px-6" data-mv-menu-dismiss="true" data-mv-user-table-filter="filter">Apply</button>
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Menu 1-->
					<!--end::Filter-->
					<!--begin::Export-->
					<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#mv_modal_export_users">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
						{!! theme()->getSvgIcon("icons/duotune/arrows/arr078.svg", "svg-icon-2") !!}
						<!--end::Svg Icon-->Export
					</button>
					<!--end::Export-->
					<!--begin::Add user-->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_add_user">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
						{!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-2") !!}
						<!--end::Svg Icon-->Add User
					</button>
					<!--end::Add user-->
				</div>
				<!--end::Toolbar-->
				<!--begin::Group actions-->
				<div class="d-flex justify-content-end align-items-center d-none" data-mv-user-table-toolbar="selected">
					<div class="fw-bolder me-5">
						<span class="me-2" data-mv-user-table-select="selected_count"></span>Selected
					</div>
					<button type="button" class="btn btn-danger" data-mv-user-table-select="delete_selected">Delete Selected</button>
				</div>
				<!--end::Group actions-->

			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
		<!--begin::Card body-->
		<div class="card-body pt-6">
			@include('pages.apps.user-management.users._table')
		</div>
		<!--end::Card body-->
	</div>
	<!--end::Card-->
		<!--begin::Modal - Add role-->
		{{ theme()->getView('partials/modals/users/_add', 
        array(
            'roles' => $roles,
			'departments' => $departments
            )) }}
	<!--end::Modal - Add role-->
	<!--begin::Modal - Add role-->
	{{ theme()->getView('partials/modals/users/_export', 
        array(
            'roles' => $roles
            )) }}
	<!--end::Modal - Add role-->



</x-base-layout>