@if( count($data) == 0)
<br />
<h1>
    No Results found
</h1>
@else
<link href="{{ public_path('demo1/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th class="w-10px pe-2">
                ID
            </th>
            <th>{{ trans('app.location') }}</th>
            <th>{{ trans('app.token_no') }}</th>
            <th>{{ trans('app.department') }}</th>
            <th>{{ trans('app.counter') }}</th>
            <th>{{ trans('app.officer') }}</th>
            <!-- <th>{{ trans('app.client_mobile') }}</th> -->
            <th>{{ trans('app.note') }}</th>
            <th>{{ trans('app.status') }}</th>                       
            <th>{{ trans('app.wait_time') }}</th>
            <th>{{ trans('app.service_time') }}</th>
            <th>{{ trans('app.created_by') }}</th>
            <th>{{ trans('app.created_at') }}</th> 
        </tr>

    </thead>
    <tbody>
        @foreach($data as $token)
        @php
        # complete time calculation             

                switch ($token->status) {
                    case 0:
                        $color  = 'badge-light-primary';
                        $bg     = 'bg-primary';
                        $txt    = trans('app.pending');
                        break;
                    case 1:
                        $color = 'badge-light-success';
                        $bg     = 'bg-success';
                        $txt    = trans('app.complete');
                        break;
                    case 2:
                        $color = 'badge-light-danger';
                        $bg     = 'bg-danger';
                        $txt    = trans('app.stop');
                        break;
                    case 3:
                        $color = 'badge-light-warning';
                        $bg     = 'bg-warning';
                        $txt    = 'Booked';
                        break;
                    default:
                        $color = 'badge-light-danger';

                        break;
                }
        @endphp
        <tr>
            <td>{{ $token->id }}</td>
            <td>{{ $token->location->name }}</td>
            <td>{{ $token->token_no }}</td>
            <td>{{ !empty($token->department) ? $token->department->name : null}}</td>
            <td>{{ !empty($token->counter) ? $token->counter->name : null }}</td>
            <td>{{ $token->officer->name }}</td>
            <!-- <td>{{ $token->client_mobile }}</td> -->
            <td>{{ $token->note}}</td>
            <td>{{$txt}} </td>                                  
            <td>{{ $token->wait_time }}</td>              
            <td>{{ $token->service_time }}</td>              
            <td>{{ $token->generated_by->name }}</td>
            <td>{{ date('j M Y h:i a', strtotime($token->created_at))  }}</td>  
        </tr>

        @endforeach

    </tbody>
</table>
@endif