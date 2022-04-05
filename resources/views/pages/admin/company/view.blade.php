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
								@if($company->active)
								<div class="ribbon-label bg-success">
									Active
								</div>
								@else
								<div class="ribbon-label bg-danger">
									Inactive
								</div>
								@endif
								<!--begin::Card title-->
								<div class="card-title">
									<h2>{{ ucwords($company->name) }}</h2>
								</div>
								<!--end::Card title-->
							</div>
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<div class="text-gray-600 mb-5">{{ $company->address }}</div>
								<div class="text-gray-600 mb-5">{{ $company->website }}</div>
								<div class="text-gray-600 mb-5">{{ $company->email }}</div>
								<div class="text-gray-600 mb-5">{{ $company->phone }}</div>
								<div class="text-gray-600 mb-5">{{ $company->contact_person }}</div>
								<div class="text-gray-600 mb-5">{{ $company->description }}</div>
							</div>
							<!--end::Card body-->
							<!--begin::Card footer-->
							<div class="card-footer pt-0">
								<a href="{{ url('admin/company/list') }}" class="btn btn-light btn-active-primary">Back</a>

							</div>
							<!--end::Card footer-->
						</div>
						<!--end::Card-->

						<!--begin::Modal-->
						<!--begin::Modal - Edit Company -->
					</div>
					<!--end::Sidebar-->
					<!--begin::Content-->
					<div class="flex-lg-row-fluid ms-lg-10">
						<div class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-5">
							<a href="#" class="btn btn-primary ps-7 ms-auto" data-bs-toggle="modal" data-bs-target="#mv_modal_add_company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new Company">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
								{!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
								<!--end::Svg Icon-->New Location
							</a>
						</div>

						<!--begin::Card-->
						<div class="card card-flush mb-6 mb-xl-9">
							<!--begin::Card header-->
							<div class="card-header pt-5">
								<!--begin::Card title-->
								<div class="card-title">
									<h2 class="d-flex align-items-center">Locations
										<span class="text-gray-600 fs-6 ms-1">({{ $company->locations->count() }})</span>
									</h2>
								</div>
								<!--end::Card title-->
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<!--begin::Table-->
								<div id="mv_companys_view_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
									<div class="table-responsive">
										<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 no-footer" style="width: 100%;">
											@foreach($company->locations as $_location)
											<tr>
												<!--begin::ID-->
												<td>
													<h4>{{ $_location->name }}</h4>
													
													<span>Team size:</span><span> {{ $_location->users()->count() }}</span> <span>Departments:</span> <span>{{ $_location->departments()->count() }}</span> <br />
													{!! theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-3") !!} <span>{{ $_location->address }}</span>
													<br />
													<!-- {{ Carbon\Carbon::parse($_location->created_at)->format('d M Y, h:i a'); }} -->
												</td>
												<td>
													<br />
													<span>Service Setup</span><br />
													<span>Greeting: </span><span> {{ ($_location->settings->enable_greeting)?'Yes':'No' }}</span><br />
													<span>Displays: </span><span> {{ $_location->displays()->count() }}</span><br />
													<span>Counters: </span><span> {{ $_location->counters()->count() }}</span><br />
												</td>
												<td>
													<br />
													<span>Statistics</span><br />
													<span>Visitors Last Week: </span><span> 114</span><br />
													<span>Wait Time: </span><span> 3 mins</span><br />
													<span>Service Time: </span><span> 7 mins</span><br />
												</td>

											</tr>
											@endforeach

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


	@endsection
</x-base-layout>