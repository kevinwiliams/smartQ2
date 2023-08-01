<!--begin::List Widget 2-->
<?php
$viplocations = auth()->user()->viplocations;
$length = count($viplocations) - 1;
?>

<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title fw-bolder text-dark">VIP Locations</h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-2">
        <div class="scroll h-400px">
            @foreach($viplocations as $index => $row)
            <!--begin::Item-->
            <div class="d-flex align-items-center {{ util()->putIf($index < $length, 'mb-7') }}">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <img src="{{ $row->company->logo_url }}" class="" alt="" />
                </div>
                <!--end::Avatar-->

                <!--begin::Text-->
                <div class="flex-grow-1">
                    <span class="d-block fw-bold">{{ $row->company->name }}</span>
                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $row->name }}</a>

                    <span class="text-muted d-block fw-bold">{{ $row->address }}</span>
                </div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            @endforeach

        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::List Widget 2-->