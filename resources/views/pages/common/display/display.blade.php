<x-auth-layout>

@section('content') 


@include('pages.common.display._header', array('title' => trans('app.display_1')))


      <div class="row">  
         <div id="display1"></div>
      </div>
 
      <div class="card-footer col-xs-12"> 
        {{-- <span class="col-xs-10 text-left">@yield('info.powered-by')</span>
        <span class="col-xs-2 text-right">@yield('info.version')</span> --}}
      </div>
    </div> 
</div>  

<!--begin::Modal - Now Serving -->
{{ theme()->getView('partials/modals/display/_notification', 
   ) }}
<!--end::Modal - Now Serving -->
@endsection

@section('scripts')
<script type="text/javascript"> 
$(document).ready(function(){
  //get previous token
  var view_token = [];
  var interval = 1000; 

  var display = function()
  {
    var width  = $(window).width();
    var height = $(window).height();
    var isFullScreen = document.fullScreen ||
    document.mozFullScreen ||
    document.webkitIsFullScreen || (document.msFullscreenElement != null);
    if (isFullScreen)
    {
      var width  = $(window).width();
      var height = $(window).height();
    } 
    
    $.ajax({
        type:'post',
        url:'{{ URL::to("common/display1") }}',
        data:
        {
            _token: '<?php echo csrf_token() ?>',
            view_token: view_token,
            width: width,
            height: height
        },
       success:function(data)
       {
          $("#display1").html(data.result);
 
          view_token = data.view_token;
         
          //notification sound
          if (data.status)
          {  
            var url  = "{{ URL::to('') }}"; 
            var lang = "{{ in_array(session()->get('locale'), $setting->languages)?session()->get('locale'):'en' }}";
            var player = new Notification;
            
            
            //show notification
            $('#mv_modal_now_serving').modal('show'); 
            $("#token_no").html(view_token.token);
            $("#counter_no").html(view_token.counter);

            setInterval(() => {
              // hide notification
              $('#mv_modal_now_serving').modal('hide'); 
            }, 10000);

            player.call([data.new_token], lang, url);


            } 

          setTimeout(display, data.interval);
       }
    });
  };

  setTimeout(display, interval);

});
</script>
@include('pages.common.display._clock-js')
@endsection
</x-auth-layout>

