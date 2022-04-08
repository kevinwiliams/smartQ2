<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                {{-- <span class="card-label fw-bolder fs-3 mb-1">Active Tokens </span>
                <span class="text-muted mt-1 fw-bold fs-7">Clients waiting: {{ $waiting }}</span> --}}
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-mv-token-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Active Tokens">
                </div>
            </h3>
            
            <div class="card-toolbar" >
            @can('run auto-token')
                <a href="{{ theme()->getPageUrl('token/auto') }}" class="btn btn-sm btn-light-success btn-active-success me-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to auto assign">
                Auto Token</a>
            @endcan
            @can('create token')
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_token" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new token">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New Token</a>
            @endcan
                </div>
            
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->   
    <!--begin::Modal - Add Token -->
    {{ theme()->getView('partials/modals/token/_add', 
        array(
            'officers' => $officers, 
            'counters' => $counters, 
            'departments' => $departments
            )) }}
    <!--end::Modal - Add Token-->
    <!--begin::Modal - Transfer Token -->
	{{ theme()->getView('partials/modals/token/_transfer', 
	array(
		'officers' => $officers, 
		'counters' => $counters, 
		'departments' => $departments
		)) }}
	<!--end::Modal - Transfer Token-->

    {{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}

@include('pages.token._action-active-js')
@include('pages.token._button-actions-js')
@endsection
</x-base-layout>