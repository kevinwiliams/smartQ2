@if( count($data) == 0)
<br />
<h1>
    No Results found
</h1>
@else

<div class="tab-content">
    <div class="tab-pane fade show active" id="mv_tab_pane_table" role="tabpanel">

        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="mv_report_table_1">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>{{ trans('app.location') }}</th>
                    <th>{{ trans('app.officer') }}</th>
                    <th>{{ trans('app.min_time') }}</th>
                    <th>{{ trans('app.max_time') }}</th>
                    <th>{{ trans('app.avg_time') }}</th>
                    <th>{{ trans('app.customers') }}</th>
                </tr>

            </thead>
            <tbody>
                @foreach($data as $token)

                <tr>
                    <td>{{ $token->location }}</td>
                    <td>{{ $token->officer }}</td>
                    <td>{{ $token->min }}</td>
                    <td>{{ $token->max }}</td>
                    <td>{{ $token->avg }}</td>
                    <td>{{ $token->total }}</td>
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
        <div class="card-rounded-bottom" data-mv-color="{{ $chartColor }}" style="height: {{ $chartHeight }}" id="report-bar-chart"></div>
        <!--end::Chart-->
    </div>
</div>


@endif