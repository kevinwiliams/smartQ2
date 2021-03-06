<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}
             <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <div class="d-flex align-items-center position-relative my-1 me-5">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
                            <!--end::Svg Icon-->
                            <input type="text" data-mv-dept-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Depts">
                        </div>
                    </h3>
                    <div class="card-toolbar" >
                    
                        <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_dept" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new dept">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                            <!--end::Svg Icon-->New Dept</a>
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
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
   
    <!--begin::Modal - Add Dept -->
     {{ theme()->getView('partials/modals/department/_add', array('keyList' => $keyList, 'avg_wait_time' => '4', 'location' => $location)) }}
    <!--end::Modal - Add Dept-->   
    <!--begin::Modal - Edit Dept -->
    <{{ theme()->getView('partials/modals/department/_edit') }}
    <!--end::Modal dialog-->
@section('scripts')
{{ $dataTable->scripts() }}

<script>
    $(document).ready(function() { //required to fire menu on dt
        var table = $('#department-table').DataTable();

        table.on('draw', function () {
                MVMenu.createInstances(); //load action menu options
                handleEditRows(table); // setup edit buttons
            });
        } ); 

    //search bar    
    const filterSearch = document.querySelector('[data-mv-dept-table-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        var table = $('#department-table').DataTable();
        table.search(e.target.value).draw();
    });

    
    var handleEditRows = () => {

        table = document.querySelector('#department-table');
        const editButtons = table.querySelectorAll('[data-mv-dept-table-filter="edit_row"]');
        // console.log(editButtons);
        // var datatable = $('#department-table').DataTable();

        editButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                // Select parent row
                const parent = e.target.closest('tr');
                const deptID = parent.querySelectorAll('td')[0].innerText;

                $.ajax({
                    url: '/location/department/edit/'+ deptID,
                    data:   {
                        _token: $("input[name=_token]").val() },
                        success: function (data) {
                            // Remove current row
                            $('#mv_modal_edit_dept').modal('show');

                            $('#mv_modal_edit_dept').on('shown.bs.modal', function(){
                                $('#mv_modal_edit_dept .load_modal').html(data);
                                MVTokenEditDept.init();
                            });
                            //remove old data
                            $('#mv_modal_edit_dept').on('hidden.bs.modal', function(){
                                $('#mv_modal_edit_dept .load_modal').html('');
                            });
                        }
                });
            })
        })

    }

    var MVTokenEditDept = function () {
        // Shared variables
        const element = document.getElementById('mv_modal_edit_dept');
        const form = element.querySelector('#mv_modal_edit_dept_form');
        const modal = new bootstrap.Modal(element);

            // Init add schedule modal
        var initEditDept = () => {  

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Dept name is required'
                                }
                            }
                        },
                        'key': {
                            validators: {
                                notEmpty: {
                                    message: 'Keyboard shortcut required'
                                }
                            }
                        }
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            // Submit button handler
            const submitButton = element.querySelector('[data-mv-dept-edit-modal-action="submit"]');
            submitButton.addEventListener('click', e => {
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        console.log('validated!');
                        var location = $("input[name=location_id]").val();

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-mv-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;

                            $.ajax({
                                url: form.action,
                                type: form.method,
                                dataType: 'json', 
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                contentType: false,  
                                cache: false,  
                                processData: false,
                                data:  new FormData(form),
                                // success: function(data)

                                // url: '{{ URL::to("client/token/checkin") }}/' + id,
                                // type: 'get',
                                // dataType: 'json',
                                success: function(data) {
                                    // document.location.href = '/client';
                                    // setInterval( function () {
                                    //     table.ajax.reload();
                                    // }, 2000 );
                                    // Remove loading indication
                                    submitButton.removeAttribute('data-mv-indicator');

                                    // Enable button
                                    submitButton.disabled = false;

                                    // Show popup confirmation 
                                    Swal.fire({
                                        text: "Form has been successfully submitted!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {     
                                            document.location.href = '/location/department/' + location;                              
                                            form.reset();
                                            modal.hide();
                                        }
                                    });
                                }
                            });

                        } else {
                            // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                }
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-mv-dept-edit-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset(); // Reset form			
                        modal.hide();	
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            // Close button handler
            const closeButton = element.querySelector('[data-mv-dept-edit-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset(); // Reset form			
                        modal.hide();	
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });
        }

        return {
            // Public functions
            init: function () {
                initEditDept();
            }
        };
    }();

</script>
    
@endsection
</x-base-layout>