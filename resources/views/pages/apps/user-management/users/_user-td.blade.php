<!--begin::User=-->
<td class="d-flex align-items-center">
    <!--begin:: Avatar -->
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <a href="{{ theme()->getPageUrl('/apps/users/view/' . $model->id) }}">
            <div class="symbol-label">
                <img src="{{ $model->avatar_url }}" alt="{{ $model->name }}" class="w-100" />
            </div>
        </a>
    </div>
    <!--end::Avatar-->
    <!--begin::User details-->
    <div class="d-flex flex-column">
        <a href="{{ theme()->getPageUrl('/apps/users/view/' . $model->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $model->name }}</a>
        <span>{{ $model->email }}</span>
    </div>
    <!--begin::User details-->
</td>
<!--end::User=-->