<!--begin::Action=-->
<td class="text-end">
    <div class="d-flex justify-content-end flex-shrink-0">
        <!--begin::Menu item-->
        <a href="{{theme()->getPageUrl('company/view/' . $model->id)}}" data-id="{{$model->id}}" data-action="view" data-mv-company-table-filter="view_row" name="view" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @can('edit company')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-action="edit" data-mv-company-table-filter="edit_row" name="edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
        </a>
        <!--end::Menu item-->
        @endcan
        @can('delete company')
        <!--begin::Menu item-->
        <a href="#" data-id="{{$model->id}}" data-mv-company-table-filter="delete_row" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-1") !!}
        </a>
        <!--end::Menu item-->
        @endcan
    
    </div>
  
    <input type="hidden" value="{{$model->id}}" name="company-id" id="company-id-{{$model->id}}" />
    <input type="hidden" value="{{$model->business_category_id}}" name="company-business-category-id" id="company-business-category-id-{{$model->id}}" />
    <input type="hidden" value="{{$model->name}}" name="company-name" id="company-name-{{$model->id}}" />
    <input type="hidden" value="{{$model->address}}" name="company-address" id="company-address-{{$model->id}}" />
    <input type="hidden" value="{{$model->website}}" name="company-website" id="company-website-{{$model->id}}" />
    <input type="hidden" value="{{$model->email}}" name="company-email" id="company-email-{{$model->id}}" />
    <input type="hidden" value="{{$model->phone}}" name="company-phone" id="company-phone-{{$model->id}}" />
    <input type="hidden" value="{{$model->contact_person}}" name="company-contact_person" id="company-contact_person-{{$model->id}}" />
    <input type="hidden" value="{{$model->description}}" name="company-description" id="company-description-{{$model->id}}" />
    <input type="hidden" value="{{$model->active}}" name="company-active" id="company-active-{{$model->id}}" />
    <input type="hidden" value="{{$model->logo_url}}" name="company-logourl" id="company-logourl-{{$model->id}}" />
    <input type="hidden" value="{{$model->logo}}" name="company-logo" id="company-logo-{{$model->id}}" />
    <input type="hidden" value="{{$company->shortname}}" name="company-shortname" id="company-shortname" />
</td>
<!--end::Action=-->