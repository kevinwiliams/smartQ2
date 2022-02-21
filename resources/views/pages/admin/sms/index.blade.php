<x-base-layout>

    <!--begin::Card-->
    <div class="card">
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
