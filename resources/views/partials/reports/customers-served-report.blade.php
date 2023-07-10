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

$dates = array_unique($data->pluck('day')->toArray());
usort($dates, "compareDates");

$locations = array_unique($data->pluck('location_name')->toArray());

@endphp


<div class="tab-content">
    <div class="tab-pane fade show active" id="mv_tab_pane_table" role="tabpanel">
        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th class="align-middle border-bottom border-end w-200px">Location</th>
                    <th class="align-middle border-bottom border-end w-200px">Officer</th>
                    @foreach($dates as $_date)
                    <th class="border-bottom">{{ $_date }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $_location)
                @php
                $officers = array_unique($data->where('location_name', $_location)->pluck('officer')->toArray());
                sort($officers);
                @endphp
                @foreach($officers as $_officerdata)
                <tr>
                    <td>{{ $_location }}</td>
                    <td>{{ $_officerdata }}</td>
                    @foreach($dates as $_date)

                    @php
                    $info = $data->where('day',$_date)->where('location_name', $_location)->where('officer', $_officerdata)->first();
                    @endphp
                    <td>{{ ($info)?$info->total:0 }}</td>

                    @endforeach
                </tr>
                @endforeach
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
        <div class="card-rounded-bottom" data-mv-color="{{ $chartColor }}" style="height: {{ $chartHeight }}" id="report-bar-chart"></div>
        <!--end::Chart-->
    </div>
</div>


@endif