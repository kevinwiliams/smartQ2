<x-base-layout>

    <!--begin::Row-->
    <div class="row g-9" id="token-cards">
        {{-- flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0 --}}
        <div class="col-md-4 col-lg-4 col-xl-4">
            <!--begin::Col header-->
            <div class="mb-9">
                <div class="d-flex flex-stack">
                    <div class="fw-bolder fs-4">Waiting list
                        <span class="fs-6 text-gray-400 ms-2">{{ (!empty(count($tokens)))? (count($tokens)) - 1 : 0}}</span>
                    </div>

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
                        <div class="badge badge-lg {!! (!empty($token->is_vip)? " badge-danger" :"badge-primary") !!} ">{{$token->token_no}}</div>
                    <!--end::Badge-->
                    <!--begin::Menu-->
                    <div>
                        <button type=" button" class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}

                            <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu 3-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-mv-menu="true">
                                <!--begin::Heading-->
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Options</div>
                                </div>
                                <!--end::Heading-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-mv-token-cards-filter="cancel_item" data-id="{{$token->id}}" data-token-number="{{$token->token_no}}">Cancel Ticket</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-mv-token-cards-filter="delete_item" data-id="{{$token->id}}" data-token-number="{{$token->token_no}}">Remove</a>
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
                        Dept: {{ !empty($token->department)?$token->department->name:null }} <br>
                        Counter: {{ !empty($token->counter)?$token->counter->name:null }} <br>
                        Phone: {{ \Illuminate\Support\Str::limit($token->client_mobile, 7, $end='****') }} <br>
                        {!! (!empty($token->client)?("(<a href='".url("officer/user/view/{$token->client->id}")."'>".$token->client->firstname." ". $token->client->lastname."</a>)"):null) !!}
                    </div>

                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-stack flex-wrapr">
                        <!--begin::Users-->
                        <div class="symbol-group symbol-hover my-1">
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{!! !empty($token->client)? ($token->client->firstname." ". $token->client->lastname): " Auto Token" !!}">
                                <img alt="Pic" src="{{ !empty($token->client)?$token->client->photo : asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }}">

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
        <div class="col-md-8 col-lg-8 col-xl-8">
            <!--begin::Col header-->
            <div class="mb-9">
                <div class="d-flex flex-stack">
                    <div class="fw-bolder fs-4">Now Serving
                        {{-- <span class="fs-6 text-gray-400 ms-2">3</span> --}}
                    </div>

                </div>
                <div class="h-3px w-100 bg-gray-800"></div>
            </div>
            <!--end::Col header-->
            @if (!empty($tokens[0]))
            <!--begin::Card-->
            <div class="card mb-6 mb-xl-9 bg-gray-800" data-mv-sticky="true" data-mv-sticky-name="serving-token" {{-- data-mv-sticky-offset="{default: false, lg: '200px'}"  --}} data-mv-sticky-width="{lg: '720px', xl: '730px'}" data-mv-sticky-left="auto" data-mv-sticky-top="100px" data-mv-sticky-animation="true" data-mv-sticky-zindex="95">
                <!--begin::Card body-->
                <div class="card-body p-10">
                    <!--begin::Header-->
                    <div class="d-flex flex-stack mb-3 ">
                        <!--begin::Badge-->
                        <div class="badge badge-lg {!! (!empty($tokens[0]->is_vip)? " badge-danger" :"badge-primary") !!}">{{$tokens[0]->token_no}}</div>
                        <!--end::Badge-->
                        <!--begin::Menu-->
                        <div>
                            <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_reason_for_visit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add reason for visit">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/".(!empty($tokens[0]->reason_for_visit) ? "general/gen055.svg" : "arrows/arr075.svg"), "svg-icon-3") !!}
                                <!--end::Svg Icon-->
                                {!! (!empty($tokens[0]->reason_for_visit)? "Edit Reason for Visit" :"Add Reason for Visit") !!}
                            </a>
                            <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_add_staff_note" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add note">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/".(!empty($tokens[0]->officer_note) ? "general/gen055.svg" : "arrows/arr075.svg"), "svg-icon-3") !!}
                                <!--end::Svg Icon-->
                                {!! (!empty($tokens[0]->officer_note)? "Edit Note" :"Add Note") !!}
                            </a>
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
                    <div class="mb-13 ">
                        <h1 class="fs-2hx fw-bolder mb-5 text-white text-center"> {!! !empty($tokens[0]->client)? ($tokens[0]->client->firstname." ". $tokens[0]->client->lastname): "Auto Token" !!}</h1>
                        <div class="text-gray-100 fw-bold fs-5 d-flex flex-stack flex-wrapr">


                        </div>
                        <div class="row text-gray-100 fw-bold fs-5">
                            <div class="col-4">
                                Counter: {{ !empty($tokens[0]->counter)?$tokens[0]->counter->name:null }} <br>
                                Name: {{ !empty($tokens[0]->client)? ($tokens[0]->client->firstname." ". $tokens[0]->client->lastname): null }} <br>
                                Phone: {{ \Illuminate\Support\Str::limit($tokens[0]->client_mobile, 7, $end='****') }}<br />
                                <br>
                            </div>

                            <div class="col-6">
                                Client Note :<br>
                                <div class="fs-6 fw-bold text-gray-100 mb-5">{{$tokens[0]->note}} </div>
                                Comments :<br>
                                <div class="fs-6 fw-bold text-gray-100 mb-5">{!! $tokens[0]->officer_note !!} </div>
                                Reason for Visit :<br>
                                <div class="fs-6 fw-bold text-gray-100 mb-5">{!! $tokens[0]->reason_for_visit !!} </div>
                            </div>
                            <div class="col-2">
                                @if (empty($tokens[0]->started_at))
                                <a href="#" class="btn btn-success er w-100 fs-6 px-4 py-4 m-1" data-mv-token-cards-filter="start_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">Start</a>
                                <a href="#" class="btn btn-danger er w-100 fs-6 px-4 py-4 m-1" data-mv-token-cards-filter="noshow_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">No Show</a>
                                <a href="#" class="btn btn-warning er w-100 fs-6 px-4 py-4 m-1" data-mv-token-cards-filter="call_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">Call again</a>
                                @else
                                <a href="#" class="btn btn-primary er w-100 fs-6 px-4 py-4 m-1" data-mv-token-cards-filter="complete_item" data-id="{{$tokens[0]->id}}" data-token-number="{{$tokens[0]->token_no}}">Next Customer</a>
                                @endif
                                @if(!empty($tokens[0]->client))
                                @if(count($history) > 0)                                
                                <a href="#" class="btn btn-secondary er w-100 fs-6 px-4 py-4 m-1" data-mv-token-cards-filter="view_history" data-bs-toggle="modal" data-bs-target="#mv_modal_view_client_history" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to view History">History</a>
                                @endif
                                @endif
                                
                            </div>

                        </div>
                    </div>

                    {{-- <div class="fs-6 fw-bold text-gray-200 mb-5">{{$tokens[0]}}
                </div> --}}

                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-stack flex-wrapr">
                    <!--begin::Users-->
                    {{-- <div class="symbol-group symbol-hover my-1">
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{!! !empty($tokens[0]->client)? ($tokens[0]->client->firstname." ". $tokens[0]->client->lastname): "Auto Token" !!}">
                            <img alt="Pic" src="{{ !empty($tokens[0]->client)?$tokens[0]->client->photo : asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }}">

                </div>

            </div> --}}
            <!--end::Users-->

        </div>
        <!--end::Footer-->
    </div>
    <!--end::Card body-->

    </div>

    <!--begin::Modal - Add Token -->
    {{ theme()->getView('partials/modals/token/_staff_note', 
            array(
                'tokens' => $tokens, 
                               )) }}
    <!--end::Modal - Add Token-->
    <!--begin::Modal - Add Token -->
    {{ theme()->getView('partials/modals/token/_reason_for_visit', 
            array(
                'reasons' => $reasons,
                 'tokens' => $tokens, 
                               )) }}
    <!--end::Modal - Add Token-->
      <!--begin::Modal - View History -->
      {{ theme()->getView('partials/modals/token/_client_history', array('client' => $tokens[0]->client, 'historylist'=> $history )) }}
    <!--end::Modal - View History-->
    @endif


    </div>


    </div>

    @section('scripts')

    @include('pages.token._button-actions-cards-js')
    @endsection
</x-base-layout>