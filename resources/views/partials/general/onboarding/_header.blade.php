@php
$title = $title ?? "";
$progresstitle = $progresstitle ?? __('Onboarding Completion');
$step_total_count = $step_total_count ?? 1;
$step_current = $step_current ?? 1;

@endphp

<div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
    <div class="card-toolbar">
        <!--begin::Progress-->
        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3 pe-5">
            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                <span class="fw-bold fs-6 text-gray-400">{{ $progresstitle }}</span>
                <span class="fw-bolder fs-6 text-success">{{ (int)(($step_current/$step_total_count)*100) }}%</span>
            </div>

            <div class="h-5px mx-3 w-100 bg-light mb-3">
                <div class="bg-success rounded h-5px" role="progressbar" style="width: {{ ($step_current/$step_total_count)*100 }}%;" aria-valuenow="{{ $step_current}}" aria-valuemin="0" aria-valuemax="{{ $step_total_count }}"></div>
            </div>
        </div>
        <!--end::Progress-->
        <button type="button" class="btn btn-sm btn-danger" data-mv-onboarding-action="cancel">
            Quit
        </button>
    </div>
</div>
<div class="separator border-primary" style="width: {{ ($step_current/$step_total_count)*100 }}%;"></div>