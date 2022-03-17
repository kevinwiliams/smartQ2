<x-base-layout>
<!--begin::Card-->
<div class="card">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Heading-->
        <div class="card-px text-center pt-15 pb-15">
            <!--begin::Title-->
            <h2 class="fs-2x fw-bolder mb-0">Welcome to </h2><br><img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'logos/logo-1.svg') }}" class="h-85px"/>
            <!--end::Title-->
            <!--begin::Description-->
            <p class="text-gray-400 fs-4 fw-bold py-7">Click on the below button to  
            <br />join our queue .</p>
            <!--end::Description-->
            <!--begin::Action-->
            <a href="{{url("admin/home/home")}}" class="btn btn-primary er fs-6 px-8 py-4">Join the line</a>
            <!--end::Action-->
        </div>
        <!--end::Heading-->
        <!--begin::Illustration-->
        <div class="text-center pb-15 px-5">
			<img src="{{ asset(theme()->getMediaUrlPath() . 'media/illustrations/sketchy-1/2.png') }}" alt="" class="mw-100 h-200px h-sm-325px" />

        </div>
        <!--end::Illustration-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
</x-base-layout>
