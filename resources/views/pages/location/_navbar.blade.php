<!--begin::Navbar-->
<div class="card mb-6 mb-xl-9">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
            <!--begin::Image-->
            <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                <img class="mw-80px mw-lg-95px" src="{{ asset(theme()->getMediaUrlPath() . 'icons/duotune/abstract/abs027.svg') }}" alt="image" />
            </div>
            <!--end::Image-->
            <!--begin::Wrapper-->
            <div class="flex-grow-1">
                <!--begin::Head-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::Details-->
                    <div class="d-flex flex-column">
                        <!--begin::Status-->
                        <div class="d-flex align-items-center mb-1">
                            <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ $location->name }}</a>
                            <span class="badge badge-light-success me-auto">{{ $location->status }}</span>
                        </div>
                        <!--end::Status-->
                        <!--begin::Description-->
                        <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">{!! theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-3") !!} {{ $location->address }}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Actions-->
                    <!-- <div class="d-flex mb-4">
                        <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3" data-bs-toggle="modal" data-bs-target="#mv_modal_users_search">Add User</a>
                        <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#mv_modal_new_target">Add Department</a>
                       
                    </div> -->
                    <!--end::Actions-->
                </div>
                <!--end::Head-->
                <!--begin::Info-->
                <div class="d-flex flex-wrap justify-content-start">
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bolder">{{ Carbon\Carbon::parse($location->created_at)->toFormattedDateString() }}</div>
                            </div>
                            <!--end::Number-->
                            <!--begin::Label-->
                            <div class="fw-bold fs-6 text-gray-400">Created</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr065.svg", "svg-icon-3 svg-icon-danger me-2") !!}
                                <!--end::Svg Icon-->
                                <div class="fs-4 fw-bolder" data-mv-countup="true" data-mv-countup-value="{{ $location->staff->count() }}">0</div>
                            </div>
                            <!--end::Number-->
                            <!--begin::Label-->
                            <div class="fw-bold fs-6 text-gray-400">Users</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr066.svg", "svg-icon-3 svg-icon-success me-2") !!}
                                <!--end::Svg Icon-->
                                <div class="fs-4 fw-bolder" data-mv-countup="true" data-mv-countup-value="{{ $location->visitorslastweek }}">0</div>
                            </div>
                            <!--end::Number-->
                            <!--begin::Label-->
                            <div class="fw-bold fs-6 text-gray-400">Visitors</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                    </div>
                    <!--end::Stats-->
                    <!--begin::Officers-->
                    <div class="symbol-group symbol-hover mb-3">


                        @foreach ($officers as $officer)

                        @if (!empty($officer->photo))
                        <!--begin::User-->
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{$officer->firstname}} {{$officer->lastname}}">
                            <img alt="Pic" src="{{ $officer->photo}}" />
                        </div>
                        <!--end::User-->
                        @endif

                        @endforeach


                        <!--begin::All users-->
                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#mv_modal_view_users">
                            <span class="symbol-label bg-dark text-inverse-dark fs-8 fw-bolder" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View more users">+{{ $officers->count() }}</span>
                        </a>
                        <!--end::All users-->
                    </div>
                    <!--end::Officers-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Details-->
        <div class="separator"></div>
        <!--begin::Nav-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='view') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/view/' . $location->id)}}">Overview</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='edit') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/edit/' . $location->id)}}">Details</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <!-- <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='map') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/map/' . $location->id)}}">Map</a>
            </li> -->
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='department') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/department/' . $location->id)}}">Departments</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='counter') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/counter/' . $location->id)}}">Counters</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='visitreason') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/visitreason/' . $location->id)}}">Visit Reason</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='staff') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/staff/' . $location->id)}}">Staff</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='customers') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/customers/' . $location->id)}}">Customers</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='token') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/token/setting/' . $location->id)}}">Queue Setup</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(2)=='visitreasoncounter') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/visitreasoncounter/' . $location->id)}}">Counter Visit Reason</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || Request::segment(3)=='display') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/settings/display/' . $location->id)}}">Display</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <!-- <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6" href="#">Activity</a>
            </li> -->
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <!-- <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ ((Request::is('location') || (Request::segment(2)=='settings' && Request::segment(3) > 0 )) ? 'active' : '') }}" href="{{theme()->getPageUrl('location/settings/' . $location->id)}}">Settings</a>
            </li> -->
            <!--end::Nav item-->
        </ul>
        <!--end::Nav-->
    </div>
</div>
<!--end::Navbar-->