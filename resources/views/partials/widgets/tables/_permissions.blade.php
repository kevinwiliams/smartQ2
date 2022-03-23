<!--begin::Table-->
{{ $dataTable->table() }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
{{ $dataTable->scripts() }}
    @include('pages.apps.user-management.permissions._view-js')
	@include('pages.apps.user-management.permissions._add-permission-js')
	@include('pages.apps.user-management.permissions._edit-permission-js')

<script> 

    $(document).ready(function() { //required to fire menu on dt
        var table = $('#permissions-table').DataTable();
        table.on('draw', function () {
               
                KTMenu.createInstances();
                KTUsersPermissionsList.init(); //load action menu options
                KTUsersAddPermission.init();
                KTUsersUpdatePermission.init();

            });
        
			// modal open with token id
			// $('#kt_modal_transfer_token').on('show.bs.modal', function (event) {
			// 	var button = $(event.relatedTarget);
			// 	$('input[name=id]').val(button.data('token-id'));
			// 	//set back options from selected token
			// 	setTimeout(() => {
			// 		$('select[name=department_id]').val($('input[name=departmentID]').val());
			// 		$('select[name=department_id]').trigger('change');

			// 		$('select[name=counter_id]').val($('input[name=counterID]').val());
			// 		$('select[name=counter_id]').trigger('change');

			// 		$('select[name=user_id]').val($('input[name=officerID]').val());
			// 		$('select[name=user_id]').trigger('change');
			// 		//alert($('select[name=department_id]').val());
			// 	}, 500);
				

			// }); 
            
        } ); 
</script>
@endsection