(()=>{"use strict";var e,t,n,o,i,a,r,s,l,d,c,m,u,v,f,p=(f=function(){n.classList.remove("d-none"),i.classList.add("d-none"),d.classList.add("d-none")},{init:function(){(e=document.querySelector("#mv_modal_two_factor_authentication"))&&(t=new bootstrap.Modal(e),n=e.querySelector('[data-mv-element="options"]'),o=e.querySelector('[data-mv-element="options-select"]'),i=e.querySelector('[data-mv-element="sms"]'),a=e.querySelector('[data-mv-element="sms-form"]'),r=e.querySelector('[data-mv-element="sms-submit"]'),s=e.querySelector('[data-mv-element="sms-cancel"]'),d=e.querySelector('[data-mv-element="apps"]'),c=e.querySelector('[data-mv-element="apps-form"]'),m=e.querySelector('[data-mv-element="apps-submit"]'),u=e.querySelector('[data-mv-element="apps-cancel"]'),o.addEventListener("click",(function(e){e.preventDefault();var t=n.querySelector('[name="auth_option"]:checked');n.classList.add("d-none"),"sms"==t.value?i.classList.remove("d-none"):d.classList.remove("d-none")})),l=FormValidation.formValidation(a,{fields:{mobile:{validators:{notEmpty:{message:"Mobile no is required"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})}}),r.addEventListener("click",(function(e){e.preventDefault(),l&&l.validate().then((function(e){console.log("validated!"),"Valid"==e?(r.setAttribute("data-mv-indicator","on"),r.disabled=!0,setTimeout((function(){r.removeAttribute("data-mv-indicator"),r.disabled=!1,Swal.fire({text:"Mobile number has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(t.hide(),f())}))}),2e3)):Swal.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),s.addEventListener("click",(function(e){e.preventDefault(),n.querySelector('[name="auth_option"]:checked'),n.classList.remove("d-none"),i.classList.add("d-none")})),v=FormValidation.formValidation(c,{fields:{code:{validators:{notEmpty:{message:"Code is required"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})}}),m.addEventListener("click",(function(e){e.preventDefault(),v&&v.validate().then((function(e){console.log("validated!"),"Valid"==e?(m.setAttribute("data-mv-indicator","on"),m.disabled=!0,setTimeout((function(){m.removeAttribute("data-mv-indicator"),m.disabled=!1,Swal.fire({text:"Code has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(t.hide(),f())}))}),2e3)):Swal.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),u.addEventListener("click",(function(e){e.preventDefault(),n.querySelector('[name="auth_option"]:checked'),n.classList.remove("d-none"),d.classList.add("d-none")})))}});MVUtil.onDOMContentLoaded((function(){p.init()}))})();