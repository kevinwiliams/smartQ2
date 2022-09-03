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
							<img src="{{ $user->avatarUrl }}" alt="image" />
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
						<!-- <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
						<a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_update_details">Edit</a>
					</span> -->
					</div>
					<!--end::Details toggle-->
					<div class="separator"></div>
					<!--begin::Details content-->
					<div id="mv_user_view_details" class="collapse show">
						<div class="pb-5 fs-6">
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Email</div>
							<div class="text-gray-600">
								<a href="#" class="text-gray-600 text-hover-primary">{{ $user->getMaskedEmail() }}</a>
							</div>
							<!--begin::Details item-->
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Language</div>
							<div class="text-gray-600">English</div>
							<!--begin::Details item-->
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Last Login</div>
							<div class="text-gray-600">{{ \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, h:i a') }}</div>
							<!--begin::Details item-->
							<!--begin::Details item-->
							<div class="fw-bolder mt-5">Last Visit</div>
							<div class="text-gray-600">{{ \Carbon\Carbon::parse($user->lasttoken->updated_at)->format('d M Y, h:i a') }}</div>
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
					<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#mv_user_view_overview_events_and_logs_tab">Events</a>
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
							<div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Notification</div>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-5">
							<a href="#" class="menu-link text-danger px-5" id="btnDeleteUser" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#mv_modal_send_notification">Send Notification</a>							
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
				<div class="tab-pane fade show active" id="mv_user_view_overview_events_and_logs_tab" role="tabpanel">
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
										<td>
											<!--begin::Timeline-->
											<div class="scroll h-400px">


												<div class="timeline-label">
													@foreach($activities as $_activity)
													<!--begin::Item-->
													<div class="timeline-item">
														<!--begin::Label-->
														<div class="timeline-label fw-bolder text-gray-800 fs-6">{{ Carbon\Carbon::parse($_activity->created_at)->format('H:i') }}</div>
														<!--end::Label-->

														<!--begin::Badge-->
														<div class="timeline-badge">
															<i class="fa fa-genderless text-{{ ($_activity->getExtraProperty('display'))?$_activity->getExtraProperty('display'):'warning' }} fs-1"></i>
														</div>
														<!--end::Badge-->
														@php
														$font = "normal";
														if($_activity->getExtraProperty('display')){
														switch ($_activity->getExtraProperty('display')) {
														case 'success':
														$font = "bolder";
														break;
														case 'danger':
														$font = "bolder";
														break;

														default:
														$font = "normal";
														break;
														}
														}
														@endphp
														<!--begin::Text-->
														<div class="fw-{{ $font }} timeline-content text-muted ps-3">
															{{ $_activity->description }}
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													@endforeach
												</div>
												<!--end::Timeline-->
											</div>
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
	<!--begin::Modal - Update email-->
	{{ theme()->getView('partials/modals/users/_send-notification', 
        array(
            'user' => $user
            )) }}
	<!--end::Modal - Update email-->
	@section('scripts')
	@endsection
</x-base-layout>