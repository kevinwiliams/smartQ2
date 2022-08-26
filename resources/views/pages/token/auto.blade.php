<x-base-layout>
    <!--begin::Row-->
    <div class="row gy-5 gx-xl-12">
        <!--begin::Col-->
        <div class="col-4">
            @if($display->sms_alert || $display->show_note)
                <!-- With Mobile No -->
                @foreach ($departmentList as $department) 
                <div class="col min-w-300px p-1 m-1 btn btn-primary text-capitalize text-center">
                    <button 
                        type="button" 
                        class="m-1 btn btn-primary text-center"
                        style="background-color: #<?= substr(dechex(crc32($department->name)), 0, 6); ?>" 
                        data-bs-toggle="modal" 
                        data-bs-target="#mv_modal_dept_token"
                        data-department-id="{{ $department->department_id }}"
                        data-counter-id="{{ $department->counter_id }}"
                        data-user-id="{{ $department->user_id }}"
                        >
                        {{-- <div class="symbol symbol-60px mb-5 lh-1" style="display: block !important;"><img src="{{ asset(theme()->getMediaUrlPath() . "svg/misc/puzzle.svg" ?? '') }}" class="h-50 align-self-center" alt=""/> --}}
                            <div class="fs-3 fw-bolder m-0 text-capitalize">{{ $department->name }} </div>
                            <div class="fs-7 fw-bold text-gray-100 p-0 m-0">{{ $department->officer }}</div>
                            
                    </button>  
                </div>
                @endforeach  
                <!--Ends of With Mobile No -->
            @else
                <!-- Without Mobile No -->
                @foreach ($departmentList as $department )
                {{ Form::open(['url' => 'token/auto', 'class' => 'AutoFrm p-1 m-1 btn btn-primary text-capitalize ']) }} 
                    <input type="hidden" name="department_id" value="{{ $department->department_id }}">
                    <input type="hidden" name="counter_id" value="{{ $department->counter_id }}">
                    <input type="hidden" name="user_id" value="{{ $department->user_id }}">
                    <button 
                        type="submit" 
                        class="p-1 m-1 btn btn-primary  text-center"
                        style="white-space: pre-wrap;box-shadow:0px 0px 0px 2px#<?= substr(dechex(crc32($department->name)), 0, 6); ?>" 
                    >
                    {{-- <div class="symbol symbol-60px mb-5 lh-1" style="display: block !important;"><img src="{{ asset(theme()->getMediaUrlPath() . "svg/misc/puzzle.svg" ?? '') }}" class="h-50 align-self-center" alt=""/> --}}
                    <p class="fs-5 fw-bolder mb-0 text-capitalize">{{ $department->name }}</p>
                    {{-- <div class="fs-5 mb-0 text-capitalize">{{ $department->description }}</div> --}}
                    {{-- <p class="fs-7 fw-bold text-gray-100">{{ $department->officer }}</p> --}}
                    </button>
                    {{ Form::close() }}
                @endforeach <!--Ends of Without Mobile No -->
            @endif
       </div>
       <!--end::Col-->

       <!--begin::Col-->
       <div class="col-8">
           {{ theme()->getView('partials/widgets/tables/_active-tokens', array(
            'dataTable' => $dataTable,
            'officers' => $officers, 
            'counters' => $counters, 
            'departments' => $departments
            )) }}
       </div>
       <!--end::Col-->
   </div>
   <!--end::Row-->

   {{ theme()->getView('partials/modals/token/_department', 
        array(
            'officers' => $officers, 
            'counters' => $counters, 
            'departments' => $departments
            )) }}




<div class="modal fade" tabindex="-1" id="mv_modal_dept_token" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
      <div class="modal-content">
        {{ Form::open(['url' => 'token/auto', 'class' => 'AutoFrm']) }} 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ trans('app.user_information') }}</h4>
        </div>
        <div class="modal-body">
          @if($display->sms_alert)
          <p><input type="phone" name="client_mobile" class="form-control" placeholder="{{ trans('app.client_mobile') }}" data-inputmask="'mask': '1 (999) 999-9999'" required>
            <span class="text-danger">The Mobile No. field is required!</span></p>
          @endif
  
          @if($display->show_note)
              <p>
                  <textarea name="note" id="note" class="form-control" placeholder="{{ trans('app.note') }}">{{ old('note') }}</textarea>
                  <span class="text-danger">The Note field is required!</span>
              </p>
          @endif
  
          <input type="hidden" name="department_id">
          <input type="hidden" name="counter_id">
          <input type="hidden" name="user_id">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success hidden">{{ trans('app.submit') }}</button>
        </div>
        {{ Form::close() }}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  @section('scripts2')
  <script>
   $(document).ready(function() {
     
    $('#mv_modal_dept_token').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        console.log("here");

        $('input[name=department_id]').val(button.data('department-id'));
        $('input[name=counter_id]').val(button.data('counter-id'));
        $('input[name=user_id]').val(button.data('user-id'));

        $("input[name=client_mobile]").val("");
        $("textarea[name=note]").val("");
        $('.modal button[type=submit]').addClass('hidden');
    });

    $('#mv_modal_dept_token').on('hide.bs.modal', function () {
        $('.modal-backdrop').remove();
    });

    $("input[name=client_mobile], textarea[name=note]").on('keyup change', function(e){
        var valid = false;
        var mobileErrorMessage = "";
        var noteErrorMessage = "";
        var mobile = $('input[name=client_mobile]').val();
        var note   = $('textarea[name=note]').val();

        if ($('input[name=client_mobile]').length)
        {
            if (mobile == '')
            {
                mobileErrorMessage = "The Mobile No. field is required!";
                valid = false;
            } 
            else if(!$.isNumeric(mobile)) 
            {
                mobileErrorMessage = "The Mobile No. is incorrect!";
                valid = false;
            }
            else if (mobile.length >= 15 || mobile.length < 7)
            {
                mobileErrorMessage = "The Mobile No. must be between 7-15 digits";
                valid = false;
            } 
            else
            { 
                mobileErrorMessage = "";
                valid = true;
            }   
        }   

        if ($('textarea[name=note]').length)
        {
            if (note == '')
            {
                noteErrorMessage = "The Note field is required!";
                valid = false;
            }
            else if (note.length >= 255 || note.length < 0)
            {
                noteErrorMessage = "The Note must be between 1-255 characters";
                valid = false;
            }
            else
            {
                noteErrorMessage = "";
                valid = true;
            }
        }


        if(!valid && mobileErrorMessage.length > 0)
        {
            $('.modal button[type=submit]').addClass('hidden');
        } 
        else if(!valid && noteErrorMessage.length > 0)
        {
            $('.modal button[type=submit]').addClass('hidden');
        } 
        else
        {
            $(this).next().html(" ");
            $('.modal button[type=submit]').removeClass('hidden');
        }
        $('textarea[name=note]').next().html(noteErrorMessage);
        $('input[name=client_mobile]').next().html(mobileErrorMessage);  

    });

    var frm = $("#mv_modal_add_auto_token_form");
    frm.on('submit', function(e){
        e.preventDefault(); 
        $(".modal").modal('hide');
        var formData = new FormData($(this)[0]);
        ajax_request(formData);
    });

    function ajax_request(formData)
    {
        $.ajax({
            url: '{{ url("token/auto") }}',
            type: 'post',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            data:  formData,
            success: function(data)
            {
                if (data.status)
                {
                   
                    var content = "";
                    content += "<div class=\"float-left\">";
                    content += "<h1>#"+data.token.token_no+"</h1>";
                    content +="<ul class=\"list-unstyled\">";
                    // content += "<li><strong>{{ trans('app.location') }}: </strong>"+data.token.location+"</li>";
                    content += "<li><strong>{{ trans('app.department') }}: </strong>"+data.token.department+"</li>";
                    content += "<li><strong>{{ trans('app.counter') }}: </strong>"+data.token.counter+"</li>";
                    content += "<li><strong>{{ trans('app.officer') }}: </strong>"+data.token.firstname+' '+data.token.lastname+"</li>";
                    content += "<li><strong>{{ trans('app.date') }}: </strong>"+data.token.created_at+"</li>";
                    content += "</ul>";
                    content += "</div>";
                    
                    // print 
                    //printThis(content);

                    Swal.fire({
                        // html: "You have created " + data.token.token_no + "<br>"+
                        // "Assigned to: "+data.token.firstname+' '+data.token.lastname+ "<br>"+
                        // "("++") <br>"+
                        // "Counter : " + ,
                        html: content,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {     
                            document.location.href = '/token/auto';                              
                            form.reset();
                            modal.hide();
                        }
                    });

                    $("input[name=client_mobile]").val("");
                    $("textarea[name=note]").val("");
                }
            },
            error: function(xhr)
            {
                Swal.fire({
                    text: " wbr>" + xhr + "<br>",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                });
            }
        });
    }

    
    $('body').on("keydown", function (e) { 
        var key = e.key;
        var code = e.keyCode; 
  
        if ($('.modal.in').length == 0 && '{{$display->keyboard_mode}}'==1 && ((code >= 48 && code <=57) ||  (code >= 96 && code <=105) || (code >= 65 && code <=90)))
        {
            var keyList = '<?= $keyList; ?>';
            $.each(JSON.parse(keyList), function (id, obj) {
                if (obj.key == key) {
                    // check form and ajax submit
                    @if($display->sms_alert || $display->show_note)
                        var modal = $('#mv_modal_dept_token');
                        modal.modal('show');
                        modal.find('input[name=department_id]').val(obj.department_id);
                        modal.find('input[name=counter_id]').val(obj.counter_id);
                        modal.find('input[name=user_id]').val(obj.user_id);
                        modal.find("input[name=client_mobile]").val("");
                        modal.find("textarea[name=note]").val("");
                        modal.find('.modal button[type=submit]').addClass('hidden');
                    @else
                        var formData = new FormData();
                        formData.append("department_id", obj.department_id);
                        formData.append("counter_id", obj.counter_id);
                        formData.append("user_id", obj.user_id);
                        ajax_request(formData);
                        return false;
                    @endif
                }
            });
        }
    });
});
</script>
@include('pages.token._add-autotoken-js')
@include('pages.token._print-token-js')
@endsection


</x-base-layout>