<x-auth-layout>

@section('content')
@include('pages.common.display._header', array('title' => trans('app.display_7')))

        <div class="row">  
           <div class="row" id="display7"></div>
        </div>
 
        <div class="panel-footer row" style="margin-top:10px">
          {{-- @include('backend.common.info') --}}
          <span class="col-xs-10 text-left">@yield('info.powered-by')</span>
          <span class="col-xs-2 text-right">@yield('info.version')</span>
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
          dataType:'json',
          url:'{{ URL::to("common/display7") }}',
          data:
          {
              _token: '<?php echo csrf_token() ?>',
              view_token: view_token,
              width: width,
              height: height
          },
          success:function(data){
            $("#display7").html(data.result);  

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
