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


$years = array_unique($data->pluck('year')->toArray());

$locations = array_unique($data->pluck('location_name')->toArray());
@endphp
<div class="tab-content">
    <div class="tab-pane fade show active" id="mv_tab_pane_table" role="tabpanel">

        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th rowspan="2" class="align-middle border-bottom border-end w-200px">Name</th>
                    @foreach($years as $_year)
                    <th colspan="{{ idate('W', mktime(0, 0, 0, 12, 28, $_year)) }}" class="border-bottom">{{ $_year }}</th>
                    @endforeach
                </tr>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    @foreach($years as $_year)                
                    @for($i = 1;$i <= 12 ;$i++) @php $dateObj=DateTime::createFromFormat('!m', $i); $monthName=$dateObj->format('F'); // March
                        @endphp
                        <th>{{ $monthName }}</th>
                        @endfor
                        @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $_location)
                <tr>
                    <td>{{ $_location }}</td>
                    @foreach($years as $_year)
                    @for($i = 1;$i <= 12 ;$i++) @php $info=$data->where('year',$_year)->where('location_name', $_location)->where('month',$i)->first();
                        @endphp
                        <td>{{ ($info)?$info->total:0 }}</td>
                        @endfor
                        @endforeach
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    @php
    $chartColor = $chartColor ?? 'primary';
    $chartHeight = $chartHeight ?? '175px';
    @endphp
    <div class="tab-pane fade" id="mv_tab_pane_graph" role="tabpanel">
        <!--begin::Chart-->
        <div class="card-rounded-bottom" data-mv-color="{{ $chartColor }}" style="height: {{ $chartHeight }}" id="weekly-token-report-chart"></div>
        <!--end::Chart-->
    </div>
</div>
@endif