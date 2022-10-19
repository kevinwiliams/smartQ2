<ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 justify-content-center" id="busy-hours-dayofweek" style="display: none">
    @php
    $weekdays = \App\Core\Data::getShortDayNames();
    $shrtweekdays = \App\Core\Data::getShortDayNames();
    $new_date = date('l');
    @endphp
    @for($i = 0; $i < count($weekdays);$i++)
    <li class="nav-item">
        <a class="nav-link {{ ($new_date==$weekdays[$i])?'active':'' }}" data-bs-toggle="tab" href="#mv_tab_pane_{{ $i }}" data-mv-busyhours-table-filter="fetch_data" data-weekday="{{ $weekdays[$i] }}">{{ $shrtweekdays[$i] }}</a>
    </li>
    @endfor
</ul>

<div class="tab-content" id="myTabContent" style="display: none">
    @for($i = 0; $i < count($weekdays);$i++)
    <div class="tab-pane fade {{ ($new_date==$weekdays[$i])?'show active':'' }}" id="mv_tab_pane_{{ $i }}" role="tabpanel">
    
    </div>
    @endfor
    <div id="mv_charts_widget_9_chart" style="height: 200px" class="card-rounded-bottom"></div>
    <!-- <div id="chart_div" style="width: 100%;"></div> -->
</div>