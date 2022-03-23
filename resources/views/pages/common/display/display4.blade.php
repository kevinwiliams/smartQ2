<x-auth-layout>

@section('content')
@include('pages.common.display._header', array('title' => trans('app.display_4')))


        <div class="row">  
           <div id="display4"></div>
        </div>
 
        <div class="panel-footer row" style="margin-top:10px">
          {{-- @include('backend.common.info') --}}
          <span class="col-xs-10 text-left">@yield('info.powered-by')</span>
          <span class="col-xs-2 text-right">@yield('info.version')</span>
        </div>
    </div> 
     
</div>  
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
          url:'{{ URL::to("common/display4") }}',
          data:
          {
              _token: '<?php echo csrf_token() ?>',
              view_token: view_token,
              width: width,
              height: height
          },
          success:function(data){
            $("#display4").html(data.result); 

            view_token = (data.all_token).map(function(item){
                return {counter: item.counter, token  : item.token} 
            }); 

            //notification sound
            if (data.status)
            {  
                var url  = "{{ URL::to('') }}"; 
                var lang = "{{ in_array(session()->get('locale'), $setting->languages)?session()->get('locale'):'en' }}";
                var player = new Notification;
                player.call(data.new_token, lang, url);
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
