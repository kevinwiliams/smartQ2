<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}
            <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">

                    </h3>
                    <div class="card-toolbar">

                        <a href="#" class="btn btn-sm btn-light-primary btn-active-primary " data-bs-toggle="modal" data-bs-target="#mv_modal_edit_openhours" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add new counter">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            {!! theme()->getSvgIcon("icons/duotune/arrows/arr075.svg", "svg-icon-3") !!}
                            <!--end::Svg Icon-->Set Opening Hours
                        </a>
                    </div>
                </div>
                <!--begin::Card body-->
                <div class="card-body pt-6">
                    <!--begin::Table-->
                    <table class="table table-striped">
                        @foreach($hours as $hour)
                        <tr>
                            <td class="w-25"><span class="fs-5">{{ \App\Core\Data::getWeekDays()[$hour->day] }}</span></td>
                            <td><span class="fw-bold fs-5">{{ $hour->open_hours }}</span></td>
                        </tr>
                        @endforeach
                    </table>


                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    <!--begin::Modal - Edit Open hours -->
    {{ theme()->getView('partials/modals/openhours/_edit', array('hours' => $hours, 'location_id'=> $location->id)) }}
    <!--end::Modal - Edit Open hours-->
    @section('scripts')
    @include('pages.location.businesshours._actions-js')
    <script>
        $(document).ready(function() {
            var optional_config = {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K"

            };
            $(".timepicker").flatpickr(optional_config);

            $("select[name^='is_open_']").on("change", function() {
                var obj = $(this);
                var _isOpen = obj.find(":selected").val();
                var key = obj.attr('name').split('_')[2];

                switch (_isOpen) {
                    case 'all':
                        $('#start_time_' + key + ',#end_time_' + key).hide();
                        break;
                    case 'true':
                        $('#start_time_' + key + ',#end_time_' + key).show();
                        break;
                    case 'false':
                        $('#start_time_' + key + ',#end_time_' + key).hide();
                        break;
                    default:
                        break;
                }                
            });
            $("select[name^='is_open_']").trigger('change');
        });
    </script>

    @endsection
</x-base-layout>