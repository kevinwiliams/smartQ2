(()=>{"use strict";var t={init:function(){var t,e,n;t=document.getElementById("mv_password_meter_example_show_score"),e=document.querySelector("#mv_password_meter_example"),n=MVPasswordMeter.getInstance(e),t.addEventListener("click",(function(t){var e=n.getScore();Swal.fire({text:"Current Password Score: "+e,icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}};MVUtil.onDOMContentLoaded((function(){t.init()}))})();