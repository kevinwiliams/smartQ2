 <div class="modal fade" id="mv_modal_location_qr" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ trans('app.qr_codes') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-location-edit-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y">
                <!-- <div id="output" class="hide alert alert-danger alert-dismissible fade in shadowed mb-1"></div> -->
                <!--begin::Form-->

                <table class="table table-striped">
                    @if($location->company->shortname)
                    <tr>
                        <td class="align-middle px-2">{{ trans('app.company_page') }}</td>
                        <td class="text-end w-10">
                            <!--begin::Button-->
                            <button id="mv_clipboard_1" class="btn btn-light-primary" data-clipboard-text="{{ config('app.url') }}/in/{{ $location->company->shortname }}">
                                Copy to clipboard
                            </button>
                            <!--end::Button-->
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="align-middle px-2">{{ trans('app.check_in') }}</td>
                        <td class="text-end w-10">
                            <!--begin::Button-->
                            <button id="mv_clipboard_2" class="btn btn-light-primary" data-clipboard-text="{{ $location->key() }}">
                                Copy to clipboard
                            </button>
                            <!--end::Button-->
                        </td>
                    </tr>
                    <!-- <tr>
                        <td class="align-middle px-2">{{ trans('app.quick_link') }}</td>
                        <td class="text-end w-10">
                            
                            <button id="mv_clipboard_2" class="btn btn-light-primary" data-clipboard-text="{{ config('app.url') }}/home/joinqueue/L-{{ $location->key() }}">
                                Copy to clipboard
                            </button>
                            
                        </td>
                    </tr> -->

                </table>              
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-mv-location-edit-modal-action="cancel">Discard</button>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>