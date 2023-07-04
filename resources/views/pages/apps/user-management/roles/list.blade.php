<x-base-layout>
	<!--begin::Row-->
	<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">		
		@foreach($roles as $_role)
		<div class="col-md-4">
			<!--begin::Card-->
			<div class="card card-flush h-md-100">
				<!--begin::Card header-->
				<div class="card-header ribbon ribbon-top">
					@if(!$_role->editable)
					<!-- <div class="badge badge-danger fw-bolder">Core</div> -->
					<div class="ribbon-label bg-danger">
						Core
					</div>
					@endif
					<!--begin::Card title-->
					<div class="card-title">
						<h2>{{ ucwords($_role->name) }}</h2>
					</div>
					<!--end::Card title-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-1">
					<!--begin::Users-->
					<div class="fw-bolder text-gray-600 mb-5">Total users with this role: {{ $_role->users()->count() }}</div>
					<!--end::Users-->
					<!--begin::Users-->
					@if($_role->description !== null || $_role->description !== '')
					<div class="text-gray-600 mb-5">{{ $_role->description }}</div>
					@endif
					<!--end::Users-->
					<!--begin::Permissions-->
					<div class="d-flex flex-column text-gray-600">
						@foreach(array_slice($_role->permissions->toArray(),0,5) as $_permission)
						<div class="d-flex align-items-center py-2">
							<span class="bullet bg-primary me-3"></span>{{ $_permission["name"] }}
						</div>
						@endforeach
						@if($_role->permissions()->count() > 5)
						<div class='d-flex align-items-center py-2'>
							<span class='bullet bg-primary me-3'></span>
							<em>and {{ $_role->permissions()->count() - 5 }} more...</em>
						</div>
						@endif
					</div>
					<!--end::Permissions-->

				</div>
				<!--end::Card body-->
				<!--begin::Card footer-->
				<div class="card-footer flex-wrap pt-0">
					<a href="{{ url('apps/user-management/roles/view/' . $_role->id ) }}" class="btn btn-light btn-active-primary my-1 me-2">View</a>
					<button type="button" class="btn btn-light btn-active-light-primary my-1" data-mv-roles-action="edit" data-id="{{ $_role->id }}" data-name="{{ $_role->name }}" data-description="{{ $_role->description }}" data-editable="{{ ($_role->editable)?1:0 }}" data-permissions="{{ $_role->permissions()->pluck('id') }}" id="btn_Edit{{ $_role->id }}">Edit</button>
					@if($_role->users()->count() == 0 && $_role->editable == true)
					<button type="button" class="btn btn-danger btn-active-light-danger my-1" data-mv-roles-action="delete" data-id="{{ $_role->id }}" id="btn_Delete{{ $_role->id }}">Delete</button>
					@endif
				</div>
				<!--end::Card footer-->
			</div>
			<!--end::Card-->
		</div>
		@endforeach
		<!--begin::Col-->


		<!--begin::Add new card-->
		<div class="col-md-4">
			<!--begin::Card-->
			<div class="card h-md-100">
				<!--begin::Card body-->
				<div class="card-body d-flex flex-center">
					<!--begin::Button-->
					<button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#mv_modal_add_role">
						<!--begin::Illustration-->
						<img src="{{ asset(theme()->getMediaUrlPath() . 'illustrations/dozzy-1/4.png') }}" alt="" class="mw-100 mh-150px mb-7" />
						<!--end::Illustration-->
						<!--begin::Label-->
						<div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Add New Role</div>
						<!--end::Label-->
					</button>
					<!--begin::Button-->
				</div>
				<!--begin::Card body-->
			</div>
			<!--begin::Card-->
		</div>
		<!--begin::Add new card-->
	</div>
	<!--end::Row-->
	<!--begin::Modals-->
	<!--begin::Modal - Add role-->
	{{ theme()->getView('partials/modals/roles/_add', 
        array(
            'permissions' => $permissions
            )) }}
	<!--end::Modal - Add role-->
	<!--begin::Modal - Add role-->
	{{ theme()->getView('partials/modals/roles/_edit', 
        array(
            'permissions' => $permissions
            )) }}
	<!--end::Modal - Add role-->
	<!--end::Modals-->
	@section('scripts')
	@include('pages.apps.user-management.roles._button-actions-js')
	@endsection
</x-base-layout>