<x-base-layout>
	<div class="d-flex flex-column flex-column-fluid" id="mv_content">
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="mv_post">
			<!--begin::Container-->
			<div id="mv_content_container" class="container-xxl">
				<!--begin::Layout-->
				<div class="d-flex flex-column flex-lg-row">
					<!--begin::Sidebar-->
					<div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
						<!--begin::Card-->
						<div class="card card-flush">

							<!--begin::Card header-->
							<div class="card-header ribbon ribbon-top">
								@if(!$role->editable)
								<!-- <div class="badge badge-danger fw-bolder">Core</div> -->
								<div class="ribbon-label bg-danger">
									Core
								</div>
								@endif
								<!--begin::Card title-->
								<div class="card-title">
									<h2>{{ ucwords($role->name) }}</h2>
								</div>
								<!--end::Card title-->
							</div>

							<div class="card-body pt-0">
								<!--end::Card header-->
								@if($role->description !== null || $role->description !== '')
								<div class="text-gray-600 mb-5">{{ $role->description }}</div>
								@endif
								<!--begin::Card body-->
								<!--begin::Permissions-->
								<div class="d-flex flex-column text-gray-600">
									@foreach($role->permissions->toArray() as $_permission)
									<div class="d-flex align-items-center py-2">
										<span class="bullet bg-primary me-3"></span>{{ $_permission["name"] }}
									</div>
									@endforeach
								</div>
								<!--end::Permissions-->
							</div>
							<!--end::Card body-->
							<!--begin::Card footer-->
							<div class="card-footer pt-0">
								<button type="button" class="btn btn-light btn-active-primary" data-mv-roles-action="edit" data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-description="{{ $role->description }}" data-permissions="{{ $role->permissions()->pluck('id') }}" data-editable="{{ ($role->editable)?1:0 }}" id="btn_Edit">Edit Role</button>
							</div>
							<!--end::Card footer-->
						</div>
						<!--end::Card-->
						<!--begin::Modal-->
						<!--begin::Modal - Update role-->
						{{ theme()->getView('partials/modals/roles/_edit', 
						array(
							'permissions' => $permissions
							)) }}
						<!--end::Modal - Update role-->
						<!--end::Modal-->
					</div>
					<!--end::Sidebar-->
					<!--begin::Content-->
					<div class="flex-lg-row-fluid ms-lg-10">
						<!--begin::Card-->
						<div class="card card-flush mb-6 mb-xl-9">
							<!--begin::Card header-->
							<div class="card-header pt-5">
								<!--begin::Card title-->
								<div class="card-title">
									<h2 class="d-flex align-items-center">Users Assigned
										<span class="text-gray-600 fs-6 ms-1">({{ $role->users->count() }})</span>
									</h2>
								</div>
								<!--end::Card title-->
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<!--begin::Table-->
								<div id="mv_roles_view_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
									<div class="table-responsive">
										<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 no-footer" id="mv_roles_view_table" width="100%">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
													<th tabindex="0" rowspan="1" colspan="1">ID</th>
													<th tabindex="0" rowspan="1" colspan="1">User</th>
													<th tabindex="0" rowspan="1" colspan="1">Department</th>
													<th tabindex="0" rowspan="1" colspan="1">Joined Date</th>
													<th tabindex="0" rowspan="1" colspan="1">Last Login</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												@foreach($role->users as $_user)
												<tr>
													<!--begin::ID-->
													<td>ID{{ str_pad($_user->id, 5, "0", STR_PAD_LEFT) }}</td>
													<!--begin::ID-->
													<!--begin::User=-->
													<td class="d-flex align-items-center">
														<!--begin:: Avatar -->
														<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
															<a href="{{ theme()->getPageUrl('/apps/users/view/' . $_user->id) }}">
																<div class="symbol-label">
																	<img src="{{ $_user->avatar_url }}" alt="{{ $_user->name }}" class="w-100" />
																</div>
															</a>
														</div>
														<!--end::Avatar-->
														<!--begin::User details-->
														<div class="d-flex flex-column">
															<a href="{{ theme()->getPageUrl('/apps/user-management/users/edit/' . $_user->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $_user->name }}</a>
															<span>{{ $_user->email }}</span>
														</div>
														<!--begin::User details-->
													</td>
													<!--end::user=-->
													<!--begin::Department-->
													<td>{{ ($_user->department)?$_user->department->name:'' }}</td>
													<!--begin::Department-->
													<!--begin::Joined date=-->
													<td>{{ Carbon\Carbon::parse($_user->created_at)->format('d M Y, h:i a'); }}</td>
													<!--end::Joined date=-->
													<!--begin::Joined date=-->
													<td>
														<div class="badge badge-light fw-bolder">{{ Carbon\Carbon::parse($_user->last_login_at)->diffForHumans() }}</div>
													</td>
													<!--end::Joined date=-->
												</tr>
												@endforeach
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Layout-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
	@section('scripts')
	@include('pages.apps.user-management.roles._view-js')
	@include('pages.apps.user-management.roles._update-role-js')
	@endsection
</x-base-layout>