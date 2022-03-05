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
                    <input type="text" data-kt-token-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Active Tokens">
                </div>
            </h3>
            <div class="card-toolbar" >
                <a href="{{ theme()->getPageUrl('admin/token/auto') }}" class="btn btn-sm btn-light-success btn-active-success me-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to auto assign">
                Auto Token</a>
                <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#kt_modal_add_token" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new token">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                    <!--end::Svg Icon-->New Token</a>
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

    {{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}

<script>
    $(document).ready(function() { //required to fire menu on dt
        var table = $('#token-table').DataTable();
        table.on('draw', function () {
                KTMenu.createInstances(); //load action menu options
            });
            setTimeout(() => {
                handleDeleteRows(table);
                
            }, 1000);
        } ); 
    //search bar    
    const filterSearch = document.querySelector('[data-kt-token-table-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        var table = $('#token-table').DataTable();
        table.search(e.target.value).draw();
    });

    var handleDeleteRows = () => {
        // Select all delete buttons
        // vartable = 
        table = document.querySelector('#token-table');
        const deleteButtons = table.querySelectorAll('[data-kt-token-table-filter="delete_row"]');
        console.log(deleteButtons);
        var datatable = $('#token-table').DataTable();
        deleteButtons.forEach(d => {
        console.log(d);

            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get token name
                const tokenNo = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + tokenNo + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + tokenNo + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: tokenNo + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }
    
</script>
@endsection
</x-base-layout>