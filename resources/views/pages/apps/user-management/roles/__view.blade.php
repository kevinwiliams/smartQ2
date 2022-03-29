<x-base-layout>
	<!--begin::Sidebar-->
	<div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
		<!--begin::Card-->
		<div class="card card-flush">
			<!--begin::Card header-->
			<div class="card-header">
				<!--begin::Card title-->
				<div class="card-title">
					<h2 class="mb-0">{{ ucwords($role->name) }}</h2>
				</div>
				<!--end::Card title-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Permissions-->					
				<div class="d-flex flex-column text-gray-600">				
						@foreach($role->permissions->toArray() as $_permission)						
						<div class="d-flex align-items-center py-2">
						<span class="bullet bg-primary me-3"></span>{{ $_permission["name"] }}</div>
						@endforeach			
					</div>
					<!--end::Permissions-->
			</div>
			<!--end::Card body-->
			<!--begin::Card footer-->
			<div class="card-footer pt-0">
				<button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_update_role">Edit Role</button>
			</div>
			<!--end::Card footer-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Sidebar-->
</x-base-layout>		
			