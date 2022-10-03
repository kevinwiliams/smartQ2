@if( count($data) == 0)
<br />
<h1>
    No Results found
</h1>
@else

<table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>{{ trans('app.reason_for_visit') }}</th>
            <th>{{ trans('app.count') }}</th>
            <th>{{ trans('app.percentage') }}</th>
        </tr>

    </thead>
    <tbody>
        @foreach($data as $token)

        <tr>
            <td>{{ $token->reason_for_visit }}</td>
            <td>{{ $token->count }}</td>
            <td>{{ round($token->percentage,2) }}%</td>
        </tr>

        @endforeach

    </tbody>
</table>
@endif