<!--begin::Card toolbar-->
<div class="flex-row-fluid justify-content-end gap-5">
    <!--begin::Toolbar-->
    <div class="d-flex justify-content-end" data-kt-performance-table-toolbar="base">
        <!--begin::Daterangepicker-->
        <input autocomplete="off" class="form-control form-control-solid w-100 mw-250px mx-5" placeholder="Pick date range" id="kt_performance_report_daterangepicker">
        <!--end::Daterangepicker-->
    </div>
    <!--end::Toolbar-->

</div>
<!--end::Card toolbar-->
<input type="hidden"  name="start_date" id="start_date" value="{{$report->start_date}}">
<input type="hidden"  name="end_date" id="end_date" value="{{$report->end_date}}">