<!--begin::Action=-->
<td class="text-end">
    <div class="d-flex justify-content-end flex-shrink-0">        
        @can('edit vip')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-action="edit" data-mv-viplist-table-filter="edit_row" name="edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
        </a>
        <!--end::Menu item-->
        @endcan
        @can('delete vip')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-mv-viplist-table-filter="delete_row" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @endcan

    </div>

    <input type="hidden" value="{{$model->id }}" name="viplist-id" id="viplist-id-{{$model->id}}" />
    <input type="hidden" value="{{$model->reason}}" name="viplist-reason" id="viplist-reason-{{$model->id}}" />
    <input type="hidden" value="{{$model->client->name}}" name="viplist-clientname" id="viplist-clientname-{{$model->id}}" />
    <input type="hidden" value="{{$model->client->avatar_url}}" name="viplist-clientphoto" id="viplist-clientphoto-{{$model->id}}" />
    <input type="hidden" value="{{ \Carbon\Carbon::parse($model->created_at)->format('d M Y, h:i a') }}" name="viplist-createdat" id="viplist-createdat-{{$model->id}}" />
    
</td>
<!--end::Action=-->