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
<link href="{{ public_path('demo1/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th class="align-middle border-bottom border-end w-200px">Name</th>
            @foreach($dates as $_date)
            <th class="border-bottom">{{ $_date }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
             @foreach($locations as $_location)
             <tr>
                 <td>{{ $_location }}</td>
                 @foreach($dates as $_date)
                    
                    @php
                        $info =  $data->where('day',$_date)->where('location_name', $_location)->first();
                    @endphp
                    <td>{{ ($info)?$info->total:0 }}</td>
                    
                 @endforeach
             </tr>
            
            @endforeach
        
    </tbody>
</table>
@endif