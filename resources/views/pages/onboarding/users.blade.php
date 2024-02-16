<x-base-layout>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">User Information</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-danger">
                    Quit
                </button>
            </div>
        </div>
        <div class="separator border-primary" style="width: 40%;"></div>
        <div class="card-body">
            <h5>Invite your coworkers</h5>
            <br />
            <!--begin::Form-->
            {{ Form::open(['url' => 'company/create', 'class'=>'manualFrm form', 'id'=>'mv_modal_add_company_form']) }}
            @csrf
            <table class="table w-100">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="email" name="email" id="email" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.email') }}" value="{{ old('email') }}">
                        </td>
                        <td>
                            <input type="text" name="name" id="name" class="form-control form-control-lg form-control-solid" placeholder="{{ trans('app.name') }}" value="{{ old('name') }}">
                        </td>
                        <td>
                            {{ Form::select('role_id', $roles->pluck('name', 'id'), null, ['data-placeholder' => 'Select Role','placeholder' => 'Select Role', 'data-control' => 'select2' , 'class'=>'form-select form-select-solid form-select-lg fw-bold', 'data-hide-search'=>'true']) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="button" class="btn btn-sm btn-outline btn-outline-primary">
                                + Add another user
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
                       

            {{ Form::close() }}
            <!--end::Form-->
        </div>
        <div class="card-footer p-4 text-center">
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-secondary">
                    Back
                </button>
                <button type="button" class="btn btn-sm btn-primary">
                    Next
                </button>
                <a href="#">Skip for now >></a>
            </div>
        </div>
    </div>
    @section('scripts')


    @endsection
</x-base-layout>