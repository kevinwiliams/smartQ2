<!--begin::Action=-->
<td class="text-end">
    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-mv-menu-trigger="click" data-mv-menu-placement="bottom-end">...
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->

        <!--end::Svg Icon-->
    </a>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-mv-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ url('company/view/' . $model->id ) }}" data-id="{{$model->id}}" data-action="view" data-mv-company-table-filter="view_row" name="view" class="menu-link px-3">View</a>
        </div>
        <!--end::Menu item-->
        @can('edit company')
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" data-id="{{$model->id}}" data-action="edit" data-mv-company-table-filter="edit_row" name="edit" class="menu-link px-3">Edit</a>
        </div>
        <!--end::Menu item-->
        @endcan
        @can('delete company')
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" data-id="{{$model->id}}" class="menu-link px-3" data-mv-company-table-filter="delete_row">Delete</a>
        </div>
        <!--end::Menu item-->
        @endcan
    </div>
    <!--end::Menu-->
    <input type="hidden" value="{{$model->id}}" name="company-id" id="company-id-{{$model->id}}" />
    <input type="hidden" value="{{$model->name}}" name="company-name" id="company-name-{{$model->name}}" />
    <input type="hidden" value="{{$model->address}}" name="company-address" id="company-address-{{$model->address}}" />
    <input type="hidden" value="{{$model->website}}" name="company-website" id="company-website-{{$model->website}}" />
    <input type="hidden" value="{{$model->email}}" name="company-email" id="company-email-{{$model->email}}" />
    <input type="hidden" value="{{$model->phone}}" name="company-phone" id="company-phone-{{$model->phone}}" />
    <input type="hidden" value="{{$model->contact_person}}" name="company-contact_person" id="company-contact_person-{{$model->contact_person}}" />
    <input type="hidden" value="{{$model->description}}" name="company-description" id="company-description-{{$model->description}}" />
    <input type="hidden" value="{{$model->active}}" name="company-active" id="company-active-{{$model->active}}" />
</td>
<!--end::Action=-->