<x-base-layout>
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="mv_post">
    <!--begin::Container-->
    <div id="mv_content_container" class="container-xxl">
        {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}
        
        <div class="d-flex flex-wrap flex-stack pb-1">
            <!--begin::Title-->
            <div class="d-flex flex-wrap align-items-center my-1">
                <h3 class="fw-bolder me-5 my-1">Users ({{ count($officerList) }})</h3>
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
					{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-3 position-absolute ms-3") !!}
                    <!--end::Svg Icon-->
                    <input type="text" data-mv-officers-table-filter="search" class="form-control form-control-sm border-body bg-body w-150px ps-10" placeholder="Search">
                </div>
                <!--end::Search-->
            </div>
            <!--end::Title-->
        </div>
        <div class="row g-6 g-xl-9">
            <table class="table table-bordered table-striped" id="mv_officers_list" name="mv_officers_list">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($officerList))
                    <?php 
                    $sl = 0;
                    // columns count
                    $colCnt = 4;
                    $officerCnt  = count($officerList);
                    //last item in object
                    $key = $officerCnt -1;

                foreach ($officerList as $current_key => $officer){
                    if($sl == 0 ){ ?>
                    <!--begin::TR-->
                    <tr>
                    <?php } 
                    //increment column count
                    $sl++;
                    ?>
                        <td>
                            <div class="col">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-center flex-column pt-12 p-3">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-65px symbol-circle mb-5">
                                            {{-- <img src="/metronic8/demo1/assets/media//avatars/300-2.jpg" alt="image"> --}}
                                            <span class="symbol-label fs-2x fw-bold text-primary bg-light-primary">{{substr($officer->firstname, 0, 1)}}</span>
                                            <div class=" {{($officer->status == 0) ? 'bg-danger' : 'bg-success'}} position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <a href="{{theme()->getPageUrl('apps/user-management/users/edit/' . $officer->id)}}" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{ $officer->lastname. ', '.$officer->firstname}}</a>
                                        <!--end::Name-->
                                        <!--begin::Position-->
                                        <div class="fw-bold text-gray-400 mb-6">Officer </div>
                                        <!--end::Position-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-center flex-wrap">
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                <div class="fs-6 fw-bolder text-gray-700">{{ ($officer->stats)?$officer->stats->wait_time:'-' }} mins</div>
                                                <div class="fw-bold text-gray-400">Avg. Wait</div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                <div class="fs-6 fw-bolder text-gray-700">{{ ($officer->pendingtokens_count)?$officer->pendingtokens_count:'0' }}</div>
                                                <div class="fw-bold text-gray-400">in Queue</div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>    
                        </td>
                    <?php
                    //if last item in object
                    if($current_key == $key){
                        //check remainding columns 
                        $emptyCells = $colCnt - $officerCnt;
                        //insert blank cells
                        for ($td=0; $td < $emptyCells; $td++) { 
                            echo '<td>&nbsp;</td>';
                        }
                    }
                     
                    if($sl == $colCnt || $current_key == $key){
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
    <!--end::Container-->
</div>
<!--end::Post-->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#mv_officers_list').dataTable({
            "info": false,
            'order': [],
            "pageLength": 5,
            "lengthMenu": [[1, 2, 5, 10, -1], [1, 2, 5, 10, "All"]],
            // "lengthChange": false,
            'columnDefs': []
        });

        const filterSearch = document.querySelector('[data-mv-officers-table-filter="search"]');
    filterSearch.addEventListener('keyup', function(e) {
        var datatable = $('#mv_officers_list').DataTable();
        datatable.search(e.target.value).draw();
    });
} );
</script>    
@endsection
</x-base-layout>