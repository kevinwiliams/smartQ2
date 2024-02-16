<x-base-layout>
    <div class="card shadow-sm" id="mv_modal_staff">
        {{ theme()->getView('partials/general/onboarding/_header', 
        array(
            'title' => "Staff Information",
            'step_total_count' => $step_total_count,
            'step_current' => $step_current
            )) }}
        <div class="card-body">
            <h5>Invite your coworkers</h5>
            <br />
            <div class="col">
                <div class="d-flex flex-wrap flex-stack pb-1">
                    <!--begin::Title-->
                    <div class="d-flex flex-wrap align-items-center my-1">

                    </div>
                    <!--end::Title-->
                    <div class="">
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_add_staff" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new staff">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                            <!--end::Svg Icon-->New Invite
                        </a>
                    </div>
                </div>
                <div class="row g-6 g-xl-9">
                    <table class="table" id="mv_officers_list" name="mv_officers_list">
                        <thead>
                            <tr>
                                <th width="25%"></th>
                                <th width="25%"></th>
                                <th width="25%"></th>
                                <th width="25%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($data))
                            <?php
                            $sl = 0;
                            // columns count
                            $colCnt = 4;
                            $officerCnt  = count($data);
                            //last item in object
                            $key = $officerCnt - 1;

                            foreach ($data as $current_key => $officer) {
                                if ($sl == 0) { ?>
                                    <!--begin::TR-->
                                    <tr>
                                    <?php }
                                //increment column count
                                $sl++;
                                    ?>
                                    <td>
                                        <div class="col">
                                            <!--begin::Card-->
                                            <div class="card border">
                                                @if($officer->status == 0) 
                                                <span style="position: absolute; top: 0; right: 0;"><a href="#" class="float-end me-2 mt-2" data-mv-staff-table-filter="delete_invite" data-id="{{ $officer->id }}" id="btnDeleteInvite{{ $officer->id }}"><i class="fa fa-times"></i></a></span>
                                                @endif
                                                <!--begin::Card body-->
                                                <div class="card-body d-flex flex-center flex-column pt-12 p-3">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                                        <img src="{{ $officer->avatar_url }}" alt="image">
                                                        <div class=" {{($officer->status == 0) ? 'bg-danger' : 'bg-success'}} position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{ $officer->name}}</a>
                                                    <!--end::Name-->

                                                    <div class="badge badge-lg badge-light-{{($officer->status == 0) ? 'danger' : 'success'}} d-inline">{{ $officer->role }}</div>

                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                    </td>
                                    <?php
                                    //if last item in object
                                    if ($current_key == $key) {
                                        //check remainding columns 
                                        $emptyCells = $colCnt - $officerCnt;
                                        //insert blank cells
                                        for ($td = 0; $td < $emptyCells; $td++) {
                                            echo '<td>&nbsp;</td>';
                                        }
                                    }

                                    if ($sl == $colCnt || $current_key == $key) {
                                        //remove sets of 4 from officer list
                                        $officerCnt = $officerCnt - $colCnt;
                                    ?>
                                    </tr>
                                    <!--end::TR-->
                            <?php
                                        //reset columns
                                        $sl = 0;
                                    }
                                }   ?>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary" data-mv-staff-modal-action="submit">
                    <span class="indicator-label">Next</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <!-- <a>Skip for now >></a> -->
            </div>
        </div>
    </div>
    <!--begin::Modal - Add role-->
    {{ theme()->getView('partials/modals/users/_invitestaff', 
        array(
            'roles' => $roles,            
            'location_id' => $location->id
            )) }}
    <!--end::Modal - Add role-->
    <!--begin::Modal - Update user details-->

    <!--end::Modal - Update user details-->
    @section('scripts')
    @include('pages.apps.user-management.users._addinvite-js')
    <script>
        $(document).ready(function() {
            $('#mv_officers_list').dataTable({
                "info": false,
                'order': [],
                "pageLength": 5,
                "lengthMenu": [
                    [1, 2, 5, 10, -1],
                    [1, 2, 5, 10, "All"]
                ],
                // "lengthChange": false,
                'columnDefs': []
            });
        });
    </script>
    @endsection
</x-base-layout>