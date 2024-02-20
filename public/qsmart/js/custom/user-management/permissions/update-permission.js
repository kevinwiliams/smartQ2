(()=>{"use strict";var t,e,n,o=(t=document.getElementById("mv_modal_update_permission"),e=t.querySelector("#mv_modal_update_permission_form"),n=new bootstrap.Modal(t),{init:function(){!function(){var o=FormValidation.formValidation(e,{fields:{permission_name:{validators:{notEmpty:{message:"Permission name is required"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})}});t.querySelector('[data-mv-permissions-modal-action="close"]').addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to close?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, close it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value&&n.hide()}))})),t.querySelector('[data-mv-permissions-modal-action="cancel"]').addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(e.reset(),n.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}));var i=t.querySelector('[data-mv-permissions-modal-action="submit"]');i.addEventListener("click",(function(t){t.preventDefault(),o&&o.validate().then((function(t){console.log("validated!"),"Valid"==t?(i.setAttribute("data-mv-indicator","on"),i.disabled=!0,setTimeout((function(){i.removeAttribute("data-mv-indicator"),i.disabled=!1,Swal.fire({text:"Form has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(t){t.isConfirmed&&n.hide()}))}),2e3)):Swal.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}()}});MVUtil.onDOMContentLoaded((function(){o.init()}))})();