<!--begin::List Widget 5-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    @php
        
        $activities = Spatie\Activitylog\Models\Activity::where('log_name', 'activity')->orderBy('created_at','desc')->get();
        $showcount = 20;
        
    @endphp
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Activities</span>
            <span class="text-muted fw-bold fs-7">Last {{$showcount}} of {{ count($activities) }} Events</span>
        </h3>

    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Timeline-->
        <div class="scroll h-400px">

        
        <div class="timeline-label">
            @foreach($activities->take($showcount) as $_activity)
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ Carbon\Carbon::parse($_activity->created_at)->format('H:i') }}</div>
                <!--end::Label-->

                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-{{ ($_activity->getExtraProperty('display'))?$_activity->getExtraProperty('display'):'warning' }} fs-1"></i>
                </div>
                <!--end::Badge-->
                @php
                    $font = "normal";
                    if($_activity->getExtraProperty('display')){
                        switch ($_activity->getExtraProperty('display')) {
                            case 'success':
                                $font = "bolder";
                                break;
                            case 'danger':
                                $font = "bolder";
                                break;
                            
                            default:
                                $font = "normal";
                                break;
                        }
                    }
                @endphp
                <!--begin::Text-->
                <div class="fw-{{ $font }} timeline-content text-muted ps-3">
                    {{ $_activity->description }}
                </div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            @endforeach
        </div>
        <!--end::Timeline-->
        </div>
    </div>
    <!--end: Card Body-->
</div>
<!--end: List Widget 5-->