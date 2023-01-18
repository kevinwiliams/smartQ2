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
$startdate = $daterange[0];
$enddate = $daterange[1];
$years = App\Core\Util::getYears($startdate, $enddate);
@endphp
<table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th rowspan="2" class="align-middle border-bottom border-end w-200px">Name</th>
            @foreach($years as $_year)
            <?php $weeks = App\Core\Util::getWeeks($startdate, $enddate, $_year); ?>
            <th colspan="{{ count($weeks) }}" class="border-bottom">{{ $_year }}</th>
            @endforeach
        </tr>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            @foreach($years as $_year)
            <?php $weeks = App\Core\Util::getWeeks($startdate, $enddate, $_year); ?>

            @foreach($weeks as $_week)
            <th>{{ "W " . $_week["weeknumber"] }}</th>
            @endforeach

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
            @foreach($years as $_year)
            <?php $counter = 0; ?>
            <?php $weeks = App\Core\Util::getWeeks($startdate, $enddate, $_year); ?>

            @foreach($weeks as $_week)
            <?php $info =  $data->where('year', $_year)->where('location_name', $_location)->where('week', $_week["weeknumber"])->first(); ?>
            <td>{{ ($info)?$info->total:0 }}</td>
            <?php $counter++; ?>
            @endforeach
            @endforeach
        </tr>

        @endforeach

    </tbody>
</table>
@endif