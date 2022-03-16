<x-base-layout>
   
<!--begin::Row--> 
<div class="row g-9" id="token-cards">
    {{-- flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0 --}}
    <div class="col-md-4 col-lg-12 col-xl-4">
        <!--begin::Col header-->
        <div class="mb-9">
            <div class="d-flex flex-stack">
                <div class="fw-bolder fs-4">Waiting list
                <span class="fs-6 text-gray-400 ms-2">{{ (!empty(count($tokens)))? (count($tokens)) - 1 : 0}}</span></div>
              
            </div>
            <div class="h-3px w-100 bg-primary"></div>
        </div>
        <!--end::Col header-->
        @if (!empty($tokens))
                <?php $sl = 0 ?>
                @foreach ($tokens as $token)
                <?php $sl++; 
                ?>
                    @if ($sl > 1)
        <!--begin::Card-->
        <div class="card mb-6 mb-xl-9 ">
            <!--begin::Card body-->
            <div class="card-body p-5">
                <!--begin::Header-->
                <div class="d-flex flex-stack mb-3">
                    <!--begin::Badge-->
                    <div class="badge badge-lg {!! (!empty($token->is_vip)? "badge-danger" :"badge-primary") !!} ">{{$token->token_no}}</div>
                    <!--end::Badge-->
                    <!--begin::Menu-->
                    <div>
                        <button type="button" class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}

                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 3-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                            <!--begin::Heading-->
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Options</div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-token-cards-filter="cancel_item" data-id="{{$token->id}}" data-token-number="{{$token->token_no}}">Cancel Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-token-cards-filter="delete_item" data-id="{{$token->id}}" data-token-number="{{$token->token_no}}">Remove</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 3-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Header-->
                <!--begin::Title-->
                <div class="mb-2">
                    <a href="#" class="fs-4 fw-bolder mb-1 text-gray-900 text-hover-primary">{{ !empty($token->client)? ($token->client->firstname." ". $token->client->lastname): "Auto Token" }}</a>
                </div>
                <!--end::Title-->
                <!--begin::Content-->
                <div class="fs-6 fw-bold text-gray-600 mb-5">
                    Dept: {{ !empty($token->department)?$token->department->name:null }} <br >
                    Counter: {{ !empty($token->counter)?$token->counter->name:null }} <br>
                    Phone: {{ $token->client_mobile }}<br/> {{ \Illuminate\Support\Str::limit($token->client_mobile, 7, $end='****') }} <br>
                    {!! (!empty($token->client)?("(<a href='".url("officer/user/view/{$token->client->id}")."'>".$token->client->firstname." ". $token->client->lastname."</a>)"):null) !!}
                    </div>
                    
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-stack flex-wrapr">
                    <!--begin::Users-->
                    <div class="symbol-group symbol-hover my-1">
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Melody Macy">
                            <img alt="Pic" src="{{ asset(theme()->getMediaUrlPath() . 'avatars/300-2.jpg') }}">
                            
                        </div>
                        
                    </div>
                    <!--end::Users-->
                    <!--begin::Stats-->
                    <div class="d-flex my-1">
                        <!--begin::Stat-->
                        <div class="border border-dashed border-gray-300 rounded py-2 px-3">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/general/gen014.svg", "svg-icon-3") !!}

                            <!--end::Svg Icon-->
                            <span class="ms-1 fs-7 fw-bolder text-gray-600">{{ (!empty($token->created_at)?date('j M h:i a',strtotime($token->created_at)):null) }}</span>
                        </div>
                        <!--end::Stat-->
                        <!--begin::Stat-->
                        <div class="border border-dashed border-gray-300 rounded py-2 px-3 ms-3">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/general/gen013.svg", "svg-icon-3") !!}

                            <!--end::Svg Icon-->
                            <span class="ms-1 fs-7 fw-bolder text-gray-600">{{ \Carbon\Carbon::parse($token->created_at)->longAbsoluteDiffForHumans() }}</span>
                        </div>
                        <!--end::Stat-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
            @endif
            @endforeach
        @endif
        
        
    </div>
    <div class="col-md-8 col-lg-12 col-xl-8">
        <!--begin::Col header-->
        <div class="mb-9">
            <div class="d-flex flex-stack">
                <div class="fw-bolder fs-4">Now Serving 
                {{-- <span class="fs-6 text-gray-400 ms-2">3</span> --}}
            </div>
           
            </div>
            <div class="h-3px w-100 bg-success"></div>
        </div>
        <!--end::Col header-->
        @if (!empty($tokens[0]))
        <!--begin::Card-->
        <div class="card mb-6 mb-xl-9 bg-success" 
            data-kt-sticky="true" 
            data-kt-sticky-name="serving-token" 
            {{-- data-kt-sticky-offset="{default: false, lg: '200px'}"  --}}
            data-kt-sticky-width="{lg: '720px', xl: '730px'}" 
            data-kt-sticky-left="auto" 
            data-kt-sticky-top="100px" 
            data-kt-sticky-animation="true" 
            data-kt-sticky-zindex="95"
            >
            <!--begin::Card body-->
            <div class="card-body p-10">
                <!--begin::Header-->
                <div class="d-flex flex-stack mb-3 ">
                    <!--begin::Badge-->
                    <div class="badge badge-lg {!! (!empty($tokens[0]->is_vip)? "badge-danger" :"badge-primary") !!}">{{$tokens[0]->token_no}}</div>
                    <!--end::Badge-->
                    <!--begin::Menu-->
                    <div>
                        <button type="button" class="btn btn-sm btn-icon btn-color-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                        <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                        <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                        <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 3-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                            <!--begin::Heading-->
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Options</div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-token-cards-filter="cancel_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">Cancel</a>
                            </div>
                            <!--end::Menu item-->
                                                       <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-token-cards-filter="delete_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">Close</a>
                            </div>
                            <!--end::Menu item-->
                                                        
                        </div>
                        <!--end::Menu 3-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Header-->
                <!--begin::Title-->
                <div class="mb-2">
                    <a href="#" class="fs-4 fw-bolder mb-1 text-gray-100 text-hover-primary">{{ !empty($tokens[0]->department)?$tokens[0]->department->name:null }}</a>
                </div>
                <!--end::Title-->
                <!--begin::Content-->
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bolder mb-5 text-white"> {!! !empty($tokens[0]->client)? ($tokens[0]->client->firstname." ". $tokens[0]->client->lastname): "Auto Token" !!}</h1>
                    <div class="text-gray-100 fw-bold fs-5">
                        Counter: {{ !empty($tokens[0]->counter)?$tokens[0]->counter->name:null }} <br>
                        Name: {{ !empty($tokens[0]->client)? ($tokens[0]->client->firstname." ". $tokens[0]->client->lastname): null }} <br> 
                        Phone: {{ $tokens[0]->client_mobile }}<br/> {{ \Illuminate\Support\Str::limit($tokens[0]->client_mobile, 7, $end='****') }} <br>
                        {!! (!empty($tokens[0]->client)?("(<a href='".url("officer/user/view/{$tokens[0]->client->id}")."'>".$tokens[0]->client->firstname." ". $tokens[0]->client->lastname."</a>)"):null) !!}
                         
                    </div>
                </div>
                Note :
                <div class="fs-6 fw-bold text-gray-200 mb-5">{{$tokens[0]->note}} </div>
                {{-- <div class="fs-6 fw-bold text-gray-200 mb-5">{{$tokens[0]}} </div> --}}
                
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-stack flex-wrapr">
                    <!--begin::Users-->
                    <div class="symbol-group symbol-hover my-1">
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Perry Matthew">
                            <span class="symbol-label bg-success text-inverse-success fw-bolder">R</span>
                        </div>
                       
                    </div>
                    <!--end::Users-->
                    <a href="#" class="btn btn-primary er w-50 fs-6 px-8 py-4" data-kt-token-cards-filter="complete_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">Call next customer</a>
                   
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card body-->
            
        </div>
        @endif
        
    
    </div>
    

</div>   

@section('scripts')

@include('pages.admin.token._button-actions-cards-js')
@endsection
</x-base-layout>