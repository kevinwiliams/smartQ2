<!--begin::Action=-->
<td class="text-end">
    <div class="d-flex justify-content-end flex-shrink-0">
        
        @can('edit business category')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-action="edit" data-mv-category-table-filter="edit_row" name="edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
        </a>
        <!--end::Menu item-->
        @endcan
        @can('delete business category')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-mv-category-table-filter="delete_row" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @endcan
    
    </div>
  
    <input type="hidden" value="{{$model->id}}" name="category-id" id="category-id-{{$model->id}}" />
    <input type="hidden" value="{{$model->name}}" name="category-name" id="category-name-{{$model->id}}" />
    <input type="hidden" value="{{$model->description}}" name="category-description" id="category-description-{{$model->id}}" />    
</td>
<!--end::Action=-->