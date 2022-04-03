<x-base-layout>
	<div class="d-flex flex-column flex-column-fluid" id="mv_content">
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="mv_post">
			<!--begin::Container-->
			<div id="mv_content_container" class="">
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
										<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 no-footer" id="mv_company_view_table" width="100%">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
													<th tabindex="0" rowspan="1" colspan="1">ID</th>
													<th tabindex="0" rowspan="1" colspan="1">Name</th>
													<th tabindex="0" rowspan="1" colspan="1">Address</th>
													<th tabindex="0" rowspan="1" colspan="1">Status</th>
													<th tabindex="0" rowspan="1" colspan="1">Created</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												@foreach($company->locations as $_company)
												<tr>
													<!--begin::ID-->
													<td>ID{{ str_pad($_company->id, 5, "0", STR_PAD_LEFT) }}</td>
													<!--begin::ID-->
													<!--begin::name-->
													<td>{{ $_company->name }}</td>
													<!--begin::name-->
													<!--begin::name-->
													<td>{{ $_company->address }}</td>
													<!--begin::name-->
													<!--begin::name-->
													<td>
														@if($_company->active)
														<div class="badge badge-success fw-bolder">Active</div>
														@else
														<div class="badge badge-danger fw-bolder">Inactive</div>
														@endif
													</td>
													<!--begin::name-->
													<!--begin::Joined date=-->
													<td>{{ Carbon\Carbon::parse($_company->created_at)->format('d M Y, h:i a'); }}</td>
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
	@include('pages.admin.company._view-js')

	@endsection
</x-base-layout>