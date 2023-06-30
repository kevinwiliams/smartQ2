@if( count($data) == 0)
<br />
<h1>
    No Results found
</h1>
@else

@php
function compareDates($date1, $date2){
return strtotime($date1) - strtotime($date2);
}




$locations = array_unique($data->pluck('location_name')->toArray());

$daterange = explode("-", $master->daterange);
$startMonth = Carbon\Carbon::parse($daterange[0])->month;
$endMonth = Carbon\Carbon::parse($daterange[1])->month;
$months = App\Core\Util::getMonths($daterange[0],$daterange[1]);

@endphp

<div class="tab-content">
    <div class="tab-pane fade show active" id="mv_tab_pane_table" role="tabpanel">

        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th class="align-middle border-bottom border-end w-200px">Name</th>
                    @foreach($months as $_month)


                    <th style="text-align: center;">{{ $_month["name"] . ' ' . $_month["year"] }}</th>

                    @endforeach
                </tr>

            </thead>
            <tbody>
                @foreach($locations as $_location)
                <tr>
                    <td>{{ $_location }}</td>

                        @foreach($months as $_month)
                         @php 
                         $info=$data->where('year',$_month["year"])->where('location_name', $_location)->where('month',$_month["month"])->first();
                        @endphp
                        <td style="text-align: center;">{{ ($info)?$info->total:0 }}</td>
                        @endforeach

                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    @php
    $chartColor = $chartColor ?? 'primary';
    $chartHeight = $chartHeight ?? '300px';
    @endphp
    <div class="tab-pane fade" id="mv_tab_pane_graph" role="tabpanel">
        <!--begin::Chart-->
        <div class="card-rounded-bottom" data-mv-color="{{ $chartColor }}" style="height: {{ $chartHeight }}" id="weekly-token-report-chart"></div>
        <!--end::Chart-->
    </div>
</div>
@endif