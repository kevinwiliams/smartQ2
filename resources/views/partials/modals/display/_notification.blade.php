	<!--begin::Modal - Add role-->
	<div class="modal bg-success fade" id="mv_modal_now_serving" tabindex="-1" aria-hidden="true">
	    <!--begin::Modal dialog-->
	    <div class="modal-dialog modal-dialog-centered mw-750px">
	        <!--begin::Modal content-->
	        <div class="modal-content">
	            <!--begin::Modal header-->
	            {{-- <div class="modal-header">
	                <!--begin::Modal title-->
	                <h2 class="fw-bolder">Now Serving</h2>
	                <!--end::Modal title-->
	                <!--begin::Close-->
	                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-mv-roles-modal-action="close">
	                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
	                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
	                    <!--end::Svg Icon-->
	                </div>
	                <!--end::Close-->
	            </div> --}}
	            <!--end::Modal header-->
	            <!--begin::Modal body-->
	            <div class="modal-body  text-center scroll-y mx-lg-5 my-7">
	         
	                <!--begin::Scroll-->
	                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="mv_modal_now_serving_scroll" data-mv-scroll="true" data-mv-scroll-activate="{default: false, lg: true}" data-mv-scroll-max-height="auto" data-mv-scroll-dependencies="#mv_modal_add_role_header" data-mv-scroll-wrappers="#mv_modal_add_role_scroll" data-mv-scroll-offset="300px">
	              {{-- content  --}}

                  <h2 class="fw-bolder">Now Serving</h2>
                  <h1 class="fw-bolder fs-5tx" id="token_no">BD001</h1>
                  <h2 class="fw-bolder fs-3tx">Counter <span id="counter_no">1</span></h2>
	                </div>
	                <!--end::Scroll-->
	               
	             
            </div>
	            <!--end::Modal body-->
	        </div>
	        <!--end::Modal content-->
	    </div>
	    <!--end::Modal dialog-->
	</div>
	<!--end::Modal - Add role-->