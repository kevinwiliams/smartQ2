<x-base-layout>
	<div class="d-flex flex-column flex-xl-row">
		<!--begin::Sidebar-->
		<!--begin::Layout-->
		<div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
			<!--begin::Card-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Card body-->
				<div class="card-body">
					<!--begin::Summary-->
					<!--begin::User Info-->
					<div class="d-flex flex-center flex-column py-5">
						<!--begin::Avatar-->
						<div class="symbol symbol-100px symbol-circle mb-7">
							<img src="{{ $user->avatar_url }}" alt="image" />
						</div>

						<!--end::Avatar-->
						<!--begin::Name-->
						<a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $user->name }}</a>
						<!--end::Name-->
						<!--begin::Position-->
						<div class="mb-9">
							<!--begin::Badge-->
							@foreach($user->getRoleNames() as $_role)
							<div class="badge badge-lg badge-light-primary d-inline">{{ ucwords($_role) }}</div>
							@endforeach
							<!--begin::Badge-->
						</div>
						<!--end::Position-->
					</div>
					<!--end::User Info-->
					<!--end::Summary-->
					<!--begin::Details toggle-->
					<div class="d-flex flex-stack fs-4 py-3">
						<div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#mv_user_view_details" role="button" aria-expanded="false" aria-controls="mv_user_view_details">Details
							<span class="ms-2 rotate-180">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								{!! theme()->getSvgIcon("icons/duotune/arrows/arr072.svg", "svg-icon-3") !!}

								<!--end::Svg Icon-->
							</span>
						</div>
						<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
							<a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_update_details">Edit</a>
						</span>
					</div>
					<!--end::Details toggle-->
					<div class="separator"></div>
					<!--begin::Details content-->
					<div id="mv_user_view_details" class="collapse show">
						<div class="pb-5 fs-6">
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Email</div>
							<div class="text-gray-600">
								<a href="#" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
							</div>
							<!--begin::Details item-->
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Language</div>
							<div class="text-gray-600">English</div>
							<!--begin::Details item-->
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Last Login</div>
							@if(empty($user->last_login_at))
							<div class="text-gray-600">Never</div>
							@else
							<div class="text-gray-600">{{ \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, h:i a') }}</div>
							@endif
							<!--begin::Details item-->
						</div>
					</div>
					<!--end::Details content-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->

		</div>
		<!--end::Sidebar-->
		<!--begin::Content-->
		<div class="flex-lg-row-fluid ms-lg-15">
			<!--begin:::Tabs-->
			<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
				<!--begin:::Tab item-->
				<li class="nav-item">
					<a class="nav-link text-active-primary pb-4 active" data-mv-countup-tabs="true" data-bs-toggle="tab" href="#mv_user_view_overview_security">Security</a>
				</li>
				<!--end:::Tab item-->
				<!--begin:::Tab item-->
				<li class="nav-item">
					<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#mv_user_view_overview_events_and_logs_tab">Events</a>
				</li>
				<!--end:::Tab item-->
				<!--begin:::Tab item-->
				<li class="nav-item ms-auto">
					<!--begin::Action menu-->
					<a href="#" class="btn btn-primary ps-7" data-mv-menu-trigger="click" data-mv-menu-attach="parent" data-mv-menu-placement="bottom-end">Actions
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
						{!! theme()->getSvgIcon("icons/duotune/arrows/arr072.svg", "svg-icon-2") !!}

						<!--end::Svg Icon-->
					</a>
					<!--begin::Menu-->
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold py-4 w-250px fs-6" data-mv-menu="true">
						<!--begin::Menu item-->
						<div class="menu-item px-5">
							<div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Account</div>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-5">
							<a href="#" class="menu-link text-danger px-5" data-mv-users-table-filter="delete_row" id="btnDeleteStaff" data-id="{{ $user->id }}" data-location="{{ $user->location_id }}">Delete User</a>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu-->
					<!--end::Menu-->
				</li>
				<!--end:::Tab item-->
			</ul>
			<!--end:::Tabs-->
			<!--begin:::Tab content-->
			<div class="tab-content" id="myTabContent">
				<!--begin:::Tab pane-->
				<div class="tab-pane fade show active" id="mv_user_view_overview_security" role="tabpanel">
					<!--begin::Card-->
					<div class="card pt-4 mb-6 mb-xl-9">
						<!--begin::Card header-->
						<div class="card-header border-0">
							<!--begin::Card title-->
							<div class="card-title">
								<h2>Profile</h2>
							</div>
							<!--end::Card title-->
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-0 pb-5">
							<!--begin::Table wrapper-->
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table align-middle table-row-dashed gy-5" id="mv_table_users_login_session">
									<!--begin::Table body-->
									<tbody class="fs-6 fw-bold text-gray-600">
										<tr>
											<td>Email</td>
											<td>{{ $user->email }}</td>
											<td class="text-end">
												<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#mv_modal_update_email" {{ ($user->usersocial)?'disabled':'' }}>
													<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
													<span class="svg-icon svg-icon-3">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
															<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</button>
											</td>
										</tr>

										<tr>
											<td>Role</td>
											<td>
												@foreach($user->getRoleNames() as $_role)
												{{ ucwords($_role) }}
												@endforeach
											</td>
											<td class="text-end">
												<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#mv_modal_update_role">
													<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
													<span class="svg-icon svg-icon-3">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
															<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</button>
											</td>
										</tr>
										<tr>
											<td>Assigned To</td>
											<td>{{ $user->location->name }}{{ ($user->department)?', '. $user->department->name:'' }}</td>
											<td class="text-end">
												<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#mv_modal_update_location" {{ (auth()->user()->can('choose location'))?'':'disabled' }}>
													<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
													<span class="svg-icon svg-icon-3">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
															<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</button>
											</td>
										</tr>
									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Table wrapper-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end:::Tab pane-->
				<!--begin:::Tab pane-->
				<div class="tab-pane fade" id="mv_user_view_overview_events_and_logs_tab" role="tabpanel">
					<!--begin::Card-->
					<div class="card pt-4 mb-6 mb-xl-9">
						<!--begin::Card header-->
						<div class="card-header border-0">
							<!--begin::Card title-->
							<div class="card-title">
								<h2>Events</h2>
							</div>
							<!--end::Card title-->
							<!--begin::Card toolbar-->
							<div class="card-toolbar">
								<!--begin::Button-->
								<!-- <button type="button" class="btn btn-sm btn-light-primary">								
								<span class="svg-icon svg-icon-3">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="black" />
										<path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="black" />
										<path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="black" />
									</svg>
								</span>
								Download Report
							</button> -->
								<!--end::Button-->
							</div>
							<!--end::Card toolbar-->
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body py-0">
							<!--begin::Table-->
							<table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-bold gy-5" id="mv_table_customers_events">
								<!--begin::Table body-->
								<tbody>
									<tr>
										<td colspan="2" class="text-center">
											No Events Found
										</td>
									</tr>
								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end:::Tab pane-->
			</div>
			<!--end:::Tab content-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Layout-->
	<!--begin::Modals-->
	<!--begin::Modal - Update user details-->
	{{ theme()->getView('partials/modals/users/_update-details', 
        array(
            'user' => $user,
			'departments' => $departments
            )) }}
	<!--end::Modal - Update user details-->
	<!--begin::Modal - Update email-->
	{{ theme()->getView('partials/modals/users/_update-email', 
        array(
            'user' => $user
            )) }}
	<!--end::Modal - Update email-->
	<!--begin::Modal - Update role-->
	{{ theme()->getView('partials/modals/users/_update-role', 
        array(
            'user' => $user,
			'roles' => $roles
            )) }}
	<!--end::Modal - Update role-->
	<!--begin::Modal - Update role-->
	{{ theme()->getView('partials/modals/users/_update-location', 
        array(
            'user' => $user,
			'locations' => $locations,
			'departments' => $departmentlist
            )) }}
	<!--end::Modal - Update role-->
	<!--end::Modals-->
	@section('scripts')
	@include('pages.apps.user-management.users._view-js')
	@include('pages.apps.user-management.users._update-details-js')
	@include('pages.apps.user-management.users._update-role-js')
	@include('pages.apps.user-management.users._update-email-js')
	@include('pages.apps.user-management.users._update-location-js')
	@endsection
</x-base-layout>