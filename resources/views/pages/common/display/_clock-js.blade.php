<script>
  function goFullscreen(id) 
  {
    var element = document.getElementById(id);
    if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullScreen) {
      element.webkitRequestFullScreen();
    }  
  } 
// dispaly clock
  $(document).ready(function()
  { 
    var time_format = '{{ (!empty($setting->time_format)?$setting->time_format:"H:i:s") }}';
    var date_format = '{{ (!empty($setting->date_format)?$setting->date_format:"d M, Y") }}';

    setInterval(function()
    { 
      var d = new Date();

      //-----------CLOCK-----------------
      //12 hour time
      if (time_format == 'h:i:s A')
      { 
        var time = d.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second:'numeric', hour12: true, timeZone:"{{ $setting->timezone }}"}); 
      }
      else
      { 
        var time = d.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second:'numeric', hour12: false, timeZone:"{{ $setting->timezone }}"}); 
      }

      // ---------DATE--------------
      const monthFullNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];  
      const monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
      ];  
    
      if (date_format == 'd M, Y')
      {   
        var date = d.getDate()+ " " +(monthShortNames[d.getMonth()])+ ", "+d.getFullYear();
      } 
      else if (date_format == 'F j, Y')
      {
        var date = (monthFullNames[d.getMonth()])+" "+d.getDate()+ ", "+d.getFullYear();
      } 
      else if(date_format == 'm.d.y')
      {
        var date = ((d.getMonth()+1)<10?"0"+(d.getMonth()+1):(d.getMonth()+1))+ "."+(d.getDate()<10?"0"+d.getDate():d.getDate())+"."+(d.getFullYear().toString().substr(-2));
      } 
      else if(date_format == 'd/m/Y')
      {
        var date = (d.getDate()<10?"0"+d.getDate():d.getDate())+"/"+((d.getMonth()+1)<10?"0"+(d.getMonth()+1):(d.getMonth()+1))+ "/"+(d.getFullYear().toString());
      } 

      $("body #clock").html(date+" "+time);
    },1000);
  });
</script>