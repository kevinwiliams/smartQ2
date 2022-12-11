<x-base-layout>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Heading-->
            <div class="card-px text-center pt-5 pb-5">
                <!-- <center>
                    @if(!auth()->user()->user_token && auth()->user()->push_notifications)
                    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-success btn-xs btn-flat mb-10">Allow Push Notification</button>
                    @endif
                </center> -->
                <!--begin::Title-->
                <h2 class="fs-2x fw-bolder mb-0">Welcome to </h2><br><img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'logos/logo-1.svg') }}" class="img-fluid h-85px" />
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-bold py-7">

                    
                    @if(count(auth()->user()->clientpendingtokens) == 0)
                    Click on the below button to
                    <br />join a queue.
                    @elseif(count(auth()->user()->clientpendingtokens) == 1)
                    Click on one of the below buttons to
                    <br />join a queue or view existing token.
                    @elseif(count(auth()->user()->clientpendingtokens) > 1)
                    Click on one of the below buttons to
                    <br />join a queue or view existing tokens.
                    @endif

                </p>
                <!--end::Description-->
                <!--begin::Action-->
                <a href="{{theme()->getPageUrl("home/home")}}" class="btn btn-primary er fs-6 px-8 py-4 px-2 my-2">Join the queue</a>
                <!--end::Action-->
                <!--begin::Action-->
                @if(count(auth()->user()->clientpendingtokens) == 1)
                <a href="{{theme()->getPageUrl("home/list")}}" class="btn btn-success er fs-6 px-8 py-4 px-2 my-2">View my token</a>
                @elseif(count(auth()->user()->clientpendingtokens) > 1)
                <a href="{{theme()->getPageUrl("home/list")}}" class="btn btn-success er fs-6 px-8 py-4 px-2 my-2">View my tokens</a>
                @endif
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
    @section('scripts')
    @include('pages.home._firebase-js')
    @endsection
</x-base-layout>