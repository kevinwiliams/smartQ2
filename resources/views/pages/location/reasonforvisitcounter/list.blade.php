<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}

            <div class="row g-6 g-xl-9" data-sticky-container>
                {{ theme()->getView('pages/location/_sidemenu',  array('location' => $location )) }}
                <!--begin::Col-->
                <div class="col-lg-10">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body pt-6">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive" id="visitreasoncounter-table">
                                @php

                                $departments = array_unique($data->pluck('department_name')->toArray());
                                asort($departments);
                                $rowcounter = 1;
                                $rowtotal = count($departments);
                                @endphp

                                @foreach($departments as $dept)
                                <h2>{{ $dept }}</h2>


                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="fs-6 fw-bold text-gray-600">
                                        @foreach($data->where('department_name',$dept) as $counterinfo)
                                        <tr>
                                            <td style="width:10%" >Counter: {{ $counterinfo->counter_name }}</td>
                                            <td>
                                                @foreach($counterinfo->reasons as $_reason)
                                                <div class='badge badge-secondary fw-bolder'>{{ $_reason }}</div>
                                                @endforeach
                                            </td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-mv-visitreasoncounter-table-filter="edit_row" data-counter-id="{{ $counterinfo->counter_id }}" data-department-id="{{ $counterinfo->department_id }}"data-reasons="{{ json_encode($counterinfo->reason_ids,true) }}">
                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                                @if($rowcounter < $rowtotal) <div class="separator border-primary my-10">
                            </div>
                            @endif
                            @php
                            $rowcounter++;
                            @endphp
                            @endforeach




                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::Post-->

 
    <!--begin::Modal - Edit Reason for Visit -->
    {{ theme()->getView('partials/modals/reasonforvisitcounter/_edit') }}
    <!--end::Modal Edit Reason for Visit-->
 
@section('scripts')
@include('pages.location.reasonforvisitcounter._button-actions-js')    
@endsection
</x-base-layout>