<x-base-layout>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="mv_post">
        <!--begin::Container-->
        <div id="mv_content_container" class="container-xxl">
            {{ theme()->getView('pages/location/_navbar', array('officers' => $officers, 'counters' => $counters, 'departments' => $departments, 'location' => $location )) }}

            <div class="row g-6 g-xl-9" data-sticky-container>
                {{ theme()->getView('pages/location/_sidemenu',  array('location' => $location )) }}
                <!--begin::Col-->
                <div class="col-lg-10">
                    <!--begin::Card-->
                    <div class="card">                       
                        <!--begin::Card body-->
                        <div class="card-body pt-6">
                            <!--begin::Table-->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ __("Key") }}
                                        </th>
                                        <th>
                                            {{ __("Value") }}
                                        </th>
                                    </tr>
                                </thead>
                                @foreach($location->locationSettings as $setting)
                                <tr>
                                    <td class="w-25"><span class="fs-5">{{ $setting->key_name }}</span></td>
                                    <td><span class="fw-bold fs-5">{{ $setting->value }}</span></td>
                                </tr>
                                @endforeach
                            </table>


                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    
    @section('scripts')
    
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