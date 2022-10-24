	<!--begin::Modal - Add role-->
	<div class="modal fade" id="mv_modal_view_client_history" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-lg modal-dialog-centered mw-750px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">View History </h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-history-modal-action="close">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						{!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body scroll-y mx-lg-5 my-7">

					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y me-n7 pe-7" id="mv_modal_add_staff_note_scroll" data-mv-scroll="true" data-mv-scroll-activate="{default: false, lg: true}" data-mv-scroll-max-height="auto" data-mv-scroll-dependencies="#mv_modal_add_staff_note_header" data-mv-scroll-wrappers="#mv_modal_add_staff_note_scroll" data-mv-scroll-offset="300px">

						@if(!empty($client))
						<!--begin::Timeline-->
						<div class="timeline">
							@foreach($client->clienttokenhistory as $history)
							<!--begin::Timeline item-->
							<div class="timeline-item">
								<!--begin::Timeline line-->
								<div class="timeline-line w-40px"></div>
								<!--end::Timeline line-->
								<!--begin::Timeline icon-->
								<div class="timeline-icon symbol symbol-circle symbol-40px me-4">
									<div class="symbol-label bg-light">
										<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->										
										{!! theme()->getSvgIcon("icons/duotune/abstract/abs027.svg", "svg-icon-1") !!}
										<!--end::Svg Icon-->
									</div>
								</div>
								<!--end::Timeline icon-->
								<!--begin::Timeline content-->
								<div class="timeline-content mb-10 mt-n1">
									<!--begin::Timeline heading-->
									<div class="pe-3 mb-5">
										<!--begin::Title-->
										<div class="fs-5 fw-semibold mb-2">Token {{ $history->token_no }} at {{ $history->location->name }}</div>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="d-flex align-items-center mt-1 fs-6">
											@if($history->created_by == $history->client_id)
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Added online at {{ $history->created_at->toDayDateTimeString() }}</div>
											<!--end::Info-->
											@else
											<!--begin::Info-->
											<div class="text-muted me-2 fs-7">Added at {{ $history->created_at->toDayDateTimeString() }} by</div>
											<!--end::Info-->
											<!--begin::User-->
											<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" aria-label="{{ $history->generated_by->name }}" data-bs-original-title="{{ $history->generated_by->name }}" data-kt-initialized="1">
												<img src="{{ $history->generated_by->avatar_url }}" alt="img">
											</div>
											<!--end::User-->
											@endif
										</div>
										<!--end::Description-->
									</div>
									<!--end::Timeline heading-->
									<!--begin::Timeline details-->
									<div class="overflow-auto pb-5">
										@if($history->no_show)

										<span class="badge badge-light-danger min-w-125px me-2 mb-2">No Show</span>

										@endif
										@if($history->wait_time)
										<span class="badge badge-light-success min-w-125px me-2 mb-2">Wait: {{ $history->wait_time }}</span>
										@endif
										@if($history->service_time)
										<span class="badge badge-light-primary min-w-125px me-2 mb-2">Service: {{ $history->service_time }}</span>
										@endif
										<!--begin::Record-->
										<div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-5">
											<div class="row mb-2">
												<!--begin::Label-->
												<span class="text-dark fw-semibold col-3">Department: </span>
												<!--end::Label-->
												<!--begin::Description-->
												<span class="text-dark text-hover-primary fw-bold col">{{ $history->department->name }}</span>
												<!--end::Description-->
											</div>
											<div class="row mb-2">
												<!--begin::Label-->
												<span class="text-dark fw-semibold col-3">Counter: </span>
												<!--end::Label-->
												<!--begin::Description-->
												<span class="text-dark text-hover-primary fw-bold col">{{ $history->counter->name }}</span>
												<!--end::Description-->
											</div>
											@if(!empty($history->note))
											<div class="row mb-2">
												<!--begin::Label-->
												<span class="text-dark fw-semibold col-3">Note: </span>
												<!--end::Label-->
												<!--begin::Description-->
												<span class="text-dark text-hover-primary fw-bold col">{{ $history->note }}</span>
												<!--end::Description-->
											</div>
											@endif
											@if(!empty($history->officer_note))
											<div class="row mb-2">
												<!--begin::Label-->
												<span class="text-dark fw-semibold col-3">Officer note: </span>
												<!--end::Label-->
												<!--begin::Description-->
												<span class="text-dark text-hover-primary fw-bold col">{{ $history->officer_note }}</span>
												<!--end::Description-->
											</div>
											@endif
											@if(!empty($history->reason_for_visit))
											<div class="row mb-2">
												<!--begin::Label-->
												<span class="text-dark fw-semibold col-3">Visit Reason: </span>
												<!--end::Label-->
												<!--begin::Description-->
												<span class="text-dark text-hover-primary fw-bold col">{{ $history->reason_for_visit }}</span>
												<!--end::Description-->
											</div>
											@endif
										</div>
										<!--end::Record-->
									</div>
									<!--end::Timeline details-->
								</div>
								<!--end::Timeline content-->
							</div>
							<!--end::Timeline item-->
							@endforeach
						</div>
						<!--end::Timeline-->

						@else
						<h1>No History</h1>
						@endif
					</div>
					<!--end::Scroll-->
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="button" class="btn btn-light me-3" data-mv-history-modal-action="cancel">Close</button>
					</div>
				</div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - Add role-->