<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <?php echo theme()->getSvgIcon("icons/duotune/communication/com009.svg", "svg-icon-2 svg-icon-gray-500")?>
            {{-- <?php echo theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-2 svg-icon-gray-500")?> --}}
        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-bold mb-2">Default screen views</div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                {{-- <div class="text-muted me-2 fs-7">Created at 4:23 PM by</div> --}}
                <!--end::Info-->

                <!--begin::User-->
                {{-- <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Marcus Dotson">
                    <img src="{{ asset(theme()->getMediaUrlPath() . 'avatars/150-3.jpg') }}" alt="img"/>
                </div> --}}
                <!--end::User-->
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->

        <!--begin::Timeline details-->
        <div class="overflow-auto pb-5">
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
                <!--begin::Item-->
                <div class="overlay me-10">
                    <!--begin::Image-->
                    <div class="overlay-wrapper">
                        <span class="badge bg-primary">Single Line</span>
                        <img alt="img" class="rounded w-150px" src="{{ asset(theme()->getMediaUrlPath() . 'screens/single-line.png') }}"/>
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="common/display?type=1" target="_blank" class="btn btn-sm btn-danger btn-shadow">Open View</a>
                    </div>
                    <!--end::Link-->
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="overlay me-10">
                    <!--begin::Image-->
                    <div class="overlay-wrapper">
                        <span class="badge bg-primary">Counter Wise-1</span>
                        
                        <img alt="img" class="rounded w-150px" src="{{ asset(theme()->getMediaUrlPath() . 'screens/counter-wise-1.png') }}"/>
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="common/display?type=2" target="_blank" class="btn btn-sm btn-primary btn-shadow">Open View</a>
                    </div>
                    <!--end::Link-->
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="overlay me-10">
                    <!--begin::Image-->
                    <div class="overlay-wrapper">
                        <span class="badge bg-primary">Counter Wise-2</span>
                        
                        <img alt="img" class="rounded w-150px" src="{{ asset(theme()->getMediaUrlPath() . 'screens/counter-wise-2.png') }}"/>
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="common/display?type=3" target="_blank" class="btn btn-sm btn-primary btn-shadow">Open View</a>
                    </div>
                    <!--end::Link-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="overlay">
                    <!--begin::Image-->
                    <div class="overlay-wrapper">
                        <span class="badge bg-primary">Department Wise</span>
                        
                        <img alt="img" class="rounded w-150px" src="{{ asset(theme()->getMediaUrlPath() . 'screens/department-wise.png') }}"/>
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="common/display?type=4" target="_blank" class="btn btn-sm btn-primary btn-shadow">Open View</a>
                    </div>
                    <!--end::Link-->
                </div>
                <!--end::Item-->
            </div>
        </div>
        <!--end::Timeline details-->
    </div>
    <!--end::Timeline content-->
</div>
<!--end::Timeline item-->
