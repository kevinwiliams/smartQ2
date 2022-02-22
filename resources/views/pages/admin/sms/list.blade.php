<x-base-layout>
    <!--begin::Card-->
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('app.sms_history') }}</h6>
            <a href="{{ url('admin/sms/new') }}" class="btn btn-success btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">{{ trans('app.new_sms') }}</span>
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showApiResponse">
                Launch demo modal
            </button>
        </div>
        <div class="card-body">
            <table class="dataTables-server display table " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <td>
                            <label>{{ trans('app.start_date') }}</label><br/>
                            <input type="text" class="datepicker form-control input-sm filter" id="start_date" placeholder="{{ trans('app.start_date') }}" autocomplete="off" style="width:100px" />
                        </td>
                        <td>
                            <label>{{ trans('app.end_date') }}</label><br/>
                            <input type="text" class="datepicker form-control input-sm filter" id="end_date" placeholder="{{ trans('app.end_date') }}" autocomplete="off" style="width:100px"/>
                        </td>
                        <th colspan="2">
                            
                        </th>
                    </tr> 
                    <tr>
                        <th>{{ trans('app.send_to') }}</th>
                        <th>{{ trans('app.message') }}</th>
                        <th>{{ trans('app.date') }}</th>
                        <th width="80"><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>   
            </table>
        </div>
        
    </div>
    <!--end::Card-->

    <!-- Modal -->
<div class="modal fade" id="showApiResponse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>  

@push('scripts') 
<script> 

</script>
@endpush
</x-base-layout>