<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="flex-column-fluid">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}

            <!--begin::Row-->
            <div class="row g-6 g-xl-9" data-sticky-container>
                {{ theme()->getView('pages/location/_sidemenu',  array('location' => $location )) }}
                <!--begin::Col-->
                <div class="col-lg-5">
                    <!--begin::Summary-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">Visitor Summary</h3>
                                <div class="fs-6 fw-bold text-gray-400">24 Overdue Tasks</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-light btn-sm">View Tasks</a>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-5">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Chart-->
                                <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                                    <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                                        <span class="fs-2qx fw-bolder">{{ $location->visitorslastweek_count }}</span>
                                        <span class="fs-6 fw-bold text-gray-400">Tokens</span>
                                    </div>
                                    <canvas id="project_overview_chart"></canvas>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Labels-->
                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-primary me-3"></div>
                                        <div class="text-gray-400">Active</div>
                                        <div class="ms-auto fw-bolder text-gray-700">{{ $visitor_summary[0]->active }}</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-success me-3"></div>
                                        <div class="text-gray-400">Completed</div>
                                        <div class="ms-auto fw-bolder text-gray-700">{{ $visitor_summary[0]->complete }}</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-danger me-3"></div>
                                        <div class="text-gray-400">No Show</div>
                                        <div class="ms-auto fw-bolder text-gray-700">{{ $visitor_summary[0]->no_show }}</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet bg-gray-300 me-3"></div>
                                        <div class="text-gray-400">Booked</div>
                                        <div class="ms-auto fw-bolder text-gray-700">{{ $visitor_summary[0]->booked }}</div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut risus vitae mi feugiat molestie non at tellus. Integer elementum mattis lectus id tempus. Integer tristique gravida fermentum. Integer nec tortor nunc.</div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Summary-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-5">
                    <!--begin::Graph-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">Visitors Over Time (6 Months)</h3>
                                <!--begin::Labels-->
                                <div class="fs-6 d-flex text-gray-400 fs-6 fw-bold">
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center me-6">
                                    <span class="menu-bullet d-flex align-items-center me-2">
                                        <span class="bullet bg-success"></span>
                                    </span>Complete</div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center">
                                    <span class="menu-bullet d-flex align-items-center me-2">
                                        <span class="bullet bg-danger"></span>
                                    </span>No Show</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Card title-->
                           
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-10 pb-0 px-5">
                            <!--begin::Chart-->
                            <div id="mv_project_overview_graph" class="card-rounded-bottom" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Graph-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->



        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    @section('scripts')
    @include('pages.location._action-js')

    @endsection
</x-base-layout>