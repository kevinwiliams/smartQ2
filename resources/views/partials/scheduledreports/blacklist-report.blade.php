@if( count($data) == 0)
<br />
<h1>
    No Results found
</h1>
@else
<link href="{{ public_path('qsmart/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">           
            <th>{{ trans('app.location') }}</th>
            <th>{{ trans('app.client') }}</th>         
            <th>{{ trans('app.block_date') }}</th> 
            <th>{{ trans('app.reason') }}</th> 
        </tr>

    </thead>
    <tbody>
        @foreach($data as $token)       
        <tr>
            <td>{{ $token->location }}</td>
            <td>{{ $token->name }}</td>    
            <td>{{ $token->block_date }}</td>    
            <td>{{ $token->block_reason }}</td> 
        </tr>
        @endforeach

    </tbody>
</table>
@endif