<script>
	$(document).ready(function() { //required to fire menu on dt
		var table = $('#scheduledreports-table').DataTable();
		table.on('draw', function() {
			MVMenu.createInstances(); //load action menu options
			MVTokenActions.init();
		});
	});
	//search bar    
	const filterSearch = document.querySelector('[data-mv-scheduledreports-table-filter="search"]');
	filterSearch.addEventListener('keyup', function(e) {
		var table = $('#scheduledreports-table').DataTable();
		table.search(e.target.value).draw();
	});
</script>