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
            <th rowspan="2" class="align-middle border-bottom border-end w-200px">Name</th>
            @foreach($dates as $_date)
            <th colspan="24" class="border-bottom">{{ $_date }}</th>
            @endforeach
        </tr>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            @foreach($dates as $_date)
            @for($i = 0;$i <= 23 ;$i++) 
            <th style="white-space: nowrap;">{{ date('g a', mktime($i, 0)) }}</th>
                @endfor
                @endforeach
                <!-- <th class="ps-2">Position</th>
            <th>Salary</th>
            <th>Office</th>
            <th>Extn.</th>
            <th>E-mail</th> -->
        </tr>
    </thead>
    <tbody>
             @foreach($locations as $_location)
             <tr>
                 <td>{{ $_location }}</td>
                 @foreach($dates as $_date)
                    @for($i = 0;$i <= 23 ;$i++) 
                        @php
                            $info =  $data->where('day',$_date)->where('location_name', $_location)->where('hour',$i)->first();
                        @endphp
                        <td style="text-align:center;">{{ ($info)?$info->total:0 }}</td>
                    @endfor
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
        <div class="card-rounded-bottom" data-mv-color="{{ $chartColor }}" style="height: {{ $chartHeight }}" id="report-column-chart"></div>
        <!--end::Chart-->
    </div>
</div>

@endif