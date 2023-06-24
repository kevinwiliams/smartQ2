<!--begin::Action=-->
<td class="text-end">
    <div class="d-flex justify-content-end flex-shrink-0">
        <!--begin::Menu item-->
        <a href="{{theme()->getPageUrl('alert/view/' . $model->alert_id)}}" data-id="{{$model->alert_id}}" data-action="view" data-mv-alert-table-filter="view_row" name="view" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @can('edit alert')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->alert_id}}" data-action="edit" data-mv-alert-table-filter="edit_row" name="edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
        </a>
        <!--end::Menu item-->
        @endcan
        @can('delete alert')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->alert_id}}" data-mv-alert-table-filter="delete_row" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @endcan

    </div>

    <input type="hidden" value="{{$model->alert_id }}" name="alert-id" id="alert-id-{{$model->alert_id}}" />
    <input type="hidden" value="{{$model->title}}" name="alert-title" id="alert-title-{{$model->id}}" />
    <input type="hidden" value="{{$model->message}}" name="alert-message" id="alert-message-{{$model->id}}" />
    <input type="hidden" value="{{ $model->image_url }}" name="alert-image_url" id="alert-image_url-{{$model->id}}" />
    <input type="hidden" value="{{ $model->image_path }}" name="alert-image_path" id="alert-image_path-{{$model->id}}" />
    <input type="hidden" value="{{$model->start_date}}" name="alert-start_date" id="alert-start_date-{{$model->id}}" />
    <input type="hidden" value="{{$model->end_date}}" name="alert-end_date" id="alert-end_date-{{$model->id}}" />
    <input type="hidden" value="{{$model->active}}" name="alert-active" id="alert-active-{{$model->id}}" />
    <input type="hidden" value="{{ implode(',',$locations->pluck('locations.id')->toArray())}}" name="alert-locations" id="alert-locations-{{$model->id}}" />
</td>
<!--end::Action=-->