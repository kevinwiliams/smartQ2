<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->

		<div class="card-header mt-6">
			<!--begin::Card title-->
			<div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1 me-5">
					
				</div>
				<!--end::Search-->
			</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Button-->
				<button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_add_permission">
					<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->

					{!! theme()->getSvgIcon("icons/duotune/general/gen035.svg", "svg-icon-3") !!}

					<!--end::Svg Icon-->
					Send SMS
				</button>
				<!--end::Button-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->    
    {{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}
@endsection
</x-base-layout>
