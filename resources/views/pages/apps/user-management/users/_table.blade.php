<!--begin::Table-->
{{ $dataTable->table() }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
{{ $dataTable->scripts() }}

@include('pages.apps.user-management.users._table-js')
@include('pages.apps.user-management.users._adduser-js')
@include('pages.apps.user-management.users._exportuser-js')
@endsection