<!--begin::List Widget 5-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    @php
        $activities = auth()->user()->actions->where('log_name','activity');
    @endphp
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Activities</span>
            <span class="text-muted fw-bold fs-7">{{ count($activities) }} Events</span>
        </h3>

        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2"); !!}
            </button>
            {{ theme()->getView('partials/menus/_menu-1') }}
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Timeline-->
        <div class="timeline-label">
            @foreach($activities as $_activity)
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
    <!--end: Card Body-->
</div>
<!--end: List Widget 5-->