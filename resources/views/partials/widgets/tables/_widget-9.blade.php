<!--begin::Tables Widget 9-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bolder fs-3 mb-1">Officer Statistics</span>
            @if (!empty($performance))
			<span class="text-muted mt-1 fw-bold fs-7">Over {{ $performance->sum('total') - 1 }} customers served</span>
            @endif
		</h3>

        {{-- <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#mv_modal_invite_friends">
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                New Member
            </a>
        </div> --}}
    </div>
    <!--end::Header-->
   
	<!--begin::Body-->
	<div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="perfSummary">
                <!--begin::Table head-->
                <thead class="sticky-top" >
                    <tr class="fw-bolder text-muted">
                    
                        <th class="sticky-top min-w-150px">Officers</th>
                        <th class="sticky-top min-w-140px">Avg Completion Time</th>
                        <th class="sticky-top min-w-150px">Progress</th>
                        {{-- <th class="min-w-100px text-end">Actions</th> --}}
                    </tr>
                </thead>
                <!--end::Table head-->

                <!--begin::Table body-->
                <tbody>
                    {{-- @foreach($tableRows as $row) --}}
                     @if (!empty($performance))   
                        @foreach($performance as $user)
                        <?php
                            $pending = number_format(((($user->pending?$user->pending:0)/($user->total?$user->total:1))*100),1);
                            $complete = number_format(((($user->complete?$user->complete:0)/($user->total?$user->total:1))*100),1);
                            $stop = number_format(((($user->stop?$user->stop:0)/($user->total?$user->total:1))*100),1);
                            $max = $complete + $pending;
                            $color = ($complete >= 50) ? "primary" : "warning";
                            $color = ($complete > 70) ? "success" : $color;
                            $color = ($complete < 20) ? "danger" : $color;
                            $photo = (!empty($user->photo))? $user->photo : asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
                        ?>
                        <tr>
                           

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="{{  $photo }}" alt=""/>
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $user->username }}</a>

                                        <span class="text-muted fw-bold text-muted d-block fs-7">{{ $user->department }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $user->avg }}</a>
                                <span class="text-muted fw-bold text-muted d-block fs-7">{{ __() }}</span>
                            </td>

                            <td class="text-end">
                                <div class="d-flex flex-column w-100 me-2">
                                    <div class="d-flex flex-stack mb-2">
                                        <span class="text-muted me-2 fs-7 fw-bold">
                                            {{ $complete }}%
                                        </span>
                                    </div>

                                    <div class="progress h-6px w-100">
                                        <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $complete }}%" aria-valuenow="{{ $complete }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </td>
                      
                        </tr>
                        @endforeach
                    @endif
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
	</div>
	<!--begin::Body-->
</div>
<!--end::Tables Widget 9-->
