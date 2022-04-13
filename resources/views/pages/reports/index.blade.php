<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            <!--begin::Navbar-->
            <form action="#" method="POST">
                <!--begin::Card-->
                <div class="card mb-7">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <div class="col-xxl-5">
                            <!--begin::Row-->
                            <div class="row" style="flex-wrap: nowrap;">
                                <!--begin::Col-->
                                <div class="col-lg-6 pe-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Report Type</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid " data-control="select2" data-placeholder="Select Report" tabindex="-1" aria-hidden="true" name="report_name">
                                        <option value=""></option>
                                        <optgroup label="Visit Reports">
                                            <option value="1">Hourly</option>
                                            <option value="2">Daily</option>
                                            <option value="3">Weekly</option>
                                            <option value="4">Monthly</option>
                                        </optgroup>
                                        <optgroup label="KPI Reports">
                                            <option value="5">Wait Time</option>
                                            <option value="6">Service Time</option>
                                        </optgroup>
                                        <optgroup label="Stat Reports">
                                            <option value="7">Customers Served</option>
                                            <option value="8">No Shows</option>
                                        </optgroup>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-12 pe-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Location</label>
                                    <!--begin::Select-->
                                    {{ Form::select('location_id', $locations, null, ['data-placeholder' => 'Select Location', 'data-control' => 'select2', 'multiple' => 'multiple' , 'class'=>'form-select form-select-solid form-select-lg fw-bold']) }}
                                    <!--end::Select-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <label class="fs-6 form-label fw-bolder text-dark">Date</label>
                                    <!--begin::Select-->
                                    <input class="form-control form-control-solid" placeholder="Pick date rage" id="mv_daterangepicker" name="daterange" />
                                    <!--end::Select-->
                                </div>
                                <!--end::Col-->
                                <!--begin:Action-->
                                <div class="col-lg-1 align-items-bottom">
                                    <label class="fs-6 form-label fw-bolder text-dark">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary me-5">Search</button>
                                </div>
                                <!--end:Action-->
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </form>
            <!--end::Navbar-->

            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Summary-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-5">                
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
            </div>
            <!--end::Row-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    @section('scripts')
    @include('pages.reports._action-js')

    @endsection
</x-base-layout>