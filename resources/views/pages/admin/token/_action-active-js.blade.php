<script>
    $(document).ready(function() { //required to fire menu on dt
        var table = $('#token-table').DataTable();
        table.on('draw', function () {
                MVMenu.createInstances(); //load action menu options
                MVTokenActions.init();
            });

        
			// modal open with token id
			$('#mv_modal_transfer_token').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				$('input[name=id]').val(button.data('token-id'));
				//set back options from selected token
				setTimeout(() => {
					$('select[name=department_id]').val($('input[name=departmentID]').val());
					$('select[name=department_id]').trigger('change');

					$('select[name=counter_id]').val($('input[name=counterID]').val());
					$('select[name=counter_id]').trigger('change');

					$('select[name=user_id]').val($('input[name=officerID]').val());
					$('select[name=user_id]').trigger('change');

					$('[name=is_vip]').prop('checked', $('input[name=isVIP]').val());
					// optional
					$('[name=is_vip]').prop('disabled', ($('input[name=isVIP]').val() == 1) ? true : false);

					$('[name=note]').html($('input[name=cNotes]').val());
					$('[name=officer_note]').html($('input[name=oNotes]').val());
				}, 500);
				

			}); 
            
        } ); 
    //search bar    
    const filterSearch = document.querySelector('[data-mv-token-table-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        var table = $('#token-table').DataTable();
        table.search(e.target.value).draw();
    });

    
</script>