<!--begin::Action=-->
<td class="text-end">
    <div class="d-flex justify-content-end flex-shrink-0">        
        
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-action="view" data-mv-blacklist-table-filter="view_row" name="view" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View">
        {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->        
        @can('unblock client')
        @if($model->is_active)
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-action="edit" data-mv-blacklist-table-filter="edit_row" name="edit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1"  title="Unblock">
            {!! theme()->getSvgIcon("icons/duotune/coding/cod008.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @endif
        @endcan

    </div>

    <input type="hidden" value="{{$model->id }}" name="blacklist-id" id="blacklist-id-{{$model->id}}" />
    <input type="hidden" value="{{$model->block_reason}}" name="blacklist-block_reason" id="blacklist-block_reason-{{$model->id}}" />
    <input type="hidden" value="{{$model->unblock_reason}}" name="blacklist-unblock_reason" id="blacklist-unblock_reason-{{$model->id}}" />
    <input type="hidden" value="{{$model->client->name}}" name="blacklist-clientname" id="blacklist-clientname-{{$model->id}}" />
    <input type="hidden" value="{{$model->client->avatar_url}}" name="blacklist-clientphoto" id="blacklist-clientphoto-{{$model->id}}" />
    <input type="hidden" value="{{ \Carbon\Carbon::parse($model->block_date)->format('d M Y, h:i a') }}" name="blacklist-block_date" id="blacklist-block_date-{{$model->id}}" />
    <input type="hidden" value="{{ ($model->unblock_date != null)?\Carbon\Carbon::parse($model->unblock_date)->format('d M Y, h:i a'):'' }}" name="blacklist-unblock_date" id="blacklist-unblock_date-{{$model->id}}" />
    
</td>
<!--end::Action=-->