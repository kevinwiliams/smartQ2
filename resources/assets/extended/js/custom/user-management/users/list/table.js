 "use strict";
window.$ = window.jQuery = require( 'jquery' );
require( 'datatables.net' );

var KTUsersList = function () {

    // Define shared variables
    var table = document.getElementById('kt_table_users');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Private functions
    var initUserTable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        // tableRows.forEach(row => {
        //     const dateRow = row.querySelectorAll('td');
        //     const lastLogin = dateRow[4].innerText.toLowerCase(); // Get last login time
        //     let timeCount = 0;
        //     let timeFormat = 'minutes';

        //     // Determine date & time format -- add more formats when necessary
        //     if (lastLogin.includes('yesterday')) {
        //         timeCount = 1;
        //         timeFormat = 'days';
        //     } else if (lastLogin.includes('mins')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'minutes';
        //     } else if (lastLogin.includes('hours')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'hours';
        //     } else if (lastLogin.includes('days')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'days';
        //     } else if (lastLogin.includes('weeks')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'weeks';
        //     }

        //     // Subtract date/time from today -- more info on moment datetime subtraction: https://momentjs.com/docs/#/durations/subtract/
        //     const realDate = moment().subtract(timeCount, timeFormat).format();

        //     // Insert real date to last login attribute
        //     dateRow[4].setAttribute('data-order', realDate);

        //     // Set real date for joined column
        //     const joinedDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format(); // select date from 5th column in table
        //     dateRow[5].setAttribute('data-order', joinedDate);
        // });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        // datatable = $(table).DataTable({
        //     "info": false,
        //     'order': [],
        //     "pageLength": 10,
        //     "lengthChange": false,
        //     'columnDefs': [                
        //         { orderable: false, targets: 5 }, // Disable ordering on column 6 (actions)
        //     ]
        // });

        // // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        // datatable.on('draw', function () {
        //     // initToggleToolbar();
        //     // handleDeleteRows();
        //     // toggleToolbars();
        //     console.log("here");
        //     KTMenu.createInstances();
        // });
    }

    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initUserTable();
  
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});
