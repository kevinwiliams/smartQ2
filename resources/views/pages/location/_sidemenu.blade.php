<div class="col-lg-3 col-xl-2">
    <div class="card card-custom sticky" data-mv-sticky="true" data-mv-sticky-top="200px" data-mv-sticky-for="1023" data-mv-sticky-animation="true" data-mv-sticky-class="sticky" style="">
        <div class="card-body p-0">
            <ul class="navi navi-bold navi-hover my-5" role="tablist">
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='view') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/view/' . $location->id)}}">
                        <span class="navi-text">Overview</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='edit') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/edit/' . $location->id)}}">
                        <span class="navi-text">Details</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='openhours') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/openhours/' . $location->id)}}">
                        <span class="navi-text">Opening Hours</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='services') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/services/' . $location->id)}}">
                        <span class="navi-text">Services</span> 
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='department') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/department/' . $location->id)}}" >
                        <span class="navi-text">Departments</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='counter') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/counter/' . $location->id)}}">
                        <span class="navi-text">Counters</span>
                    </a>
                </li>
                <li class="navi__separator"></li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='visitreason') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/visitreason/' . $location->id)}}" >
                        <span class="navi-text">Visit Reason</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='staff') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/staff/' . $location->id)}}" >
                        <span class="navi-text">Staff</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='customers') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/customers/' . $location->id)}}" >
                        <span class="navi-text">Customers</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='token') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/token/setting/' . $location->id)}}" >
                        <span class="navi-text">Queue Setup</span> 
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(2)=='visitreasoncounter') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/visitreasoncounter/' . $location->id)}}" >
                        <span class="navi-text">Counter Visit Reason</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a class="navi-link {{ ((Request::is('location') || Request::segment(3)=='display') ? 'active' : '') }}" href="{{theme()->getPageUrl('location/settings/display/' . $location->id)}}" >
                        <span class="navi-text">Display</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>