<x-base-layout>
{{ Form::open(['url' => 'token/performance', 'class' => 'performance form-inline mb-0', 'method' => 'get']) }}
<!--begin::Card-->
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 pt-6">
		<!--begin::Card title-->
		<div class="card-title">
			<!--begin::Search-->
			<div class="d-flex align-items-center position-relative my-1">
				<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
				{!! theme()->getSvgIcon("icons/duotune/general/gen021.svg", "svg-icon-1 position-absolute ms-6") !!}
				<!--end::Svg Icon-->
				<input type="text" data-mv-performance-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Officers" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		{{ theme()->getView('pages/token/_performance-toolbar', array(
            'report' => $report
            )) }}
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body py-4">
    
        <!--begin::Datatable-->
        <table id="performance-table" class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>{{ trans('app.officer') }}</th>
                    <th>Total</th>
                    <th>Stoped</th>
                    <th>Pending</th>
                    <th>Complete</th>
                </tr>  
            </thead> 
            <tbody class="text-gray-600 fw-bold">
                <?php 
                    $sl = 1; 
                    $grand_total   = 0;
                    $total_stoped  = 0;
                    $total_pending = 0;
                    $total_success = 0;
                ?>
                @if (!empty($tokens))
                    @foreach ($tokens as $token)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td><a href='{{url("user/view/{$token->uid}")}}'>{{$token->officer}}</a></td>
                            <td>{{ $token->total }}</td> 
                            <td>{{ $token->stoped }}</td> 
                            <td>{{ $token->pending }}</td>  
                            <td>{{ $token->success }}</td>
                        </tr> 
                        <?php 
                            $grand_total   += $token->total;
                            $total_stoped  += $token->stoped;
                            $total_pending += $token->pending;
                            $total_success += $token->success;
                        ?>
                    @endforeach
                @endif
            </tbody>
            <tfoot> 
                <tr>
                    <th>#</th>
                    <th>
                        <strong>{{ trans('app.start_date') }}</strong> : {{ (!empty($report->start_date)?date('j M Y h:i a',strtotime($report->start_date)):null) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br/>
                        <strong>{{ trans('app.end_date') }}</strong>&nbsp; : {{ (!empty($report->end_date)?date('j M Y h:i a',strtotime($report->end_date)):null) }}<br/>
                    </th>
                    <th>{{ $grand_total }}</th> 
                    <th>{{ $total_stoped }}</th> 
                    <th>{{ $total_pending }}</th>  
                    <th>{{ $total_success }}</th>
                </tr>  
            </tfoot>
        </table>
        <!--end::Datatable-->

    </div>
	<!--end::Card body-->
</div>
<!--end::Card-->
{{ Form::close() }}



@section('scripts')
<script type="text/javascript">
    $(function () {
            //drawDataTable();
        $('#performance-table').DataTable();

        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#mv_performance_report_daterangepicker").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            $('#start_date').val(start);
            $('#end_date').val(end);
            // alert($('#start_date').val());
            $('.performance').submit();
        }

        $("#mv_performance_report_daterangepicker").daterangepicker({
            // autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            startDate: start,
            endDate: end,
            ranges: {
            "Today": [moment(), moment()],
            "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);
    
    });

    const filterSearch = document.querySelector('[data-mv-performance-table-filter="search"]');

    filterSearch.addEventListener('keyup', function (e) {
        var table = $('#performance-table').DataTable();
        table.search(e.target.value).draw();
    });

</script>

@endsection
</x-base-layout>