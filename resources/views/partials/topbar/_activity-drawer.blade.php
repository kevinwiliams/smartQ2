<!--begin::Activities drawer-->
<div
	id="mv_activities"
	class="bg-white"

	data-mv-drawer="true"
	data-mv-drawer-name="activities"
	data-mv-drawer-activate="true"
	data-mv-drawer-overlay="true"
    data-mv-drawer-width="{default:'300px', 'lg': '900px'}"
    data-mv-drawer-direction="end"
	data-mv-drawer-toggle="#mv_activities_toggle"
	data-mv-drawer-close="#mv_activities_close">

	<div class="card shadow-none">
		<!--begin::Header-->
		<div class="card-header" id="mv_activities_header">
			<h3 class="card-title fw-bolder text-dark">Display Screen Options</h3>

			<div class="card-toolbar">
				<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="mv_activities_close">
					{!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon-1") !!}
				</button>
			</div>
		</div>
		<!--end::Header-->

		<!--begin::Body-->
		<div class="card-body position-relative" id="mv_activities_body">
			<!--begin::Content-->
			<div id="mv_activities_scroll"
				class="position-relative scroll-y me-n5 pe-5"

				data-mv-scroll="true"
				data-mv-scroll-height="auto"
				data-mv-scroll-wrappers="#mv_activities_body"
				data-mv-scroll-dependencies="#mv_activities_header, #mv_activities_footer"
				data-mv-scroll-offset="5px">

				<!--begin::Timeline items-->
				<div class="timeline">
                    {{-- {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-1', array("compact" => true)) }}

                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-2', array("compact" => true)) }}

                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-3', array("compact" => true)) }}

                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-4', array("compact" => true)) }} --}}

                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-5', array("compact" => true)) }}
                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-5-custom', array("compact" => true)) }}

                    {{-- {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-6', array("compact" => true)) }}

                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-7', array("compact" => true)) }}

                    {{ theme()->getView('pages/pages/profile/activity/timeline/items/_item-8', array("compact" => true)) }} --}}
				</div>
				<!--end::Timeline items-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Body-->

		<!--begin::Footer-->
		<div class="card-footer py-5 text-center" id="mv_activities_footer">
			<a href="{{ theme()->getPageUrl('admin/settings/display') }}" class="btn btn-bg-white text-primary">
				View Display Settings {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-3 svg-icon-primary") !!}
			</a>
		</div>
		<!--end::Footer-->
	</div>
</div>
<!--end::Activities drawer-->
