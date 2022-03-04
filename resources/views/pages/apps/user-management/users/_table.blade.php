<!--begin::Table-->
{{ $dataTable->table() }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}

<script>
    $(document).ready(function() { //required to fire menu on dt
        var table = $('#users-table').DataTable();
        table.on('draw', function () {
                KTMenu.createInstances(); //load action menu options
            });
        } ); 
    //search bar    
    // const filterSearch = document.querySelector('[data-kt-token-table-filter="search"]');
    // filterSearch.addEventListener('keyup', function (e) {
    // 	var table = $('#token-table').DataTable();
    // 	table.search(e.target.value).draw();
    // });
    
</script>
@endsection
