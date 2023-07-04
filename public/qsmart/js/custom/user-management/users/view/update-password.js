(()=>{"use strict";var t,e,n,o=(t=document.getElementById("mv_modal_update_password"),e=t.querySelector("#mv_modal_update_password_form"),n=new bootstrap.Modal(t),{init:function(){!function(){var o=FormValidation.formValidation(e,{fields:{current_password:{validators:{notEmpty:{message:"Current password is required"}}},new_password:{validators:{notEmpty:{message:"The password is required"},callback:{message:"Please enter valid password",callback:function(t){if(t.value.length>0)return validatePassword()}}}},confirm_password:{validators:{notEmpty:{message:"The password confirmation is required"},identical:{compare:function(){return e.querySelector('[name="new_password"]').value},message:"The password and its confirm are not the same"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})}});t.querySelector('[data-mv-users-modal-action="close"]').addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(e.reset(),n.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),t.querySelector('[data-mv-users-modal-action="cancel"]').addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(e.reset(),n.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}));var a=t.querySelector('[data-mv-users-modal-action="submit"]');a.addEventListener("click",(function(t){t.preventDefault(),o&&o.validate().then((function(t){console.log("validated!"),"Valid"==t&&(a.setAttribute("data-mv-indicator","on"),a.disabled=!0,setTimeout((function(){a.removeAttribute("data-mv-indicator"),a.disabled=!1,Swal.fire({text:"Form has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(t){t.isConfirmed&&n.hide()}))}),2e3))}))}))}()}});MVUtil.onDOMContentLoaded((function(){o.init()}))})();