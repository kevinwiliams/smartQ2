(()=>{"use strict";var e={init:function(){var e,t;e=document.querySelector("#mv_stepper_example_basic"),(t=new MVStepper(e)).on("mv.stepper.next",(function(e){e.goNext()})),t.on("mv.stepper.previous",(function(e){e.goPrevious()})),function(){var e=document.querySelector("#mv_stepper_example_vertical"),t=new MVStepper(e);t.on("mv.stepper.next",(function(e){e.goNext()})),t.on("mv.stepper.previous",(function(e){e.goPrevious()}))}(),function(){var e=document.querySelector("#mv_stepper_example_clickable"),t=new MVStepper(e);t.on("mv.stepper.click",(function(e){e.goTo(e.getClickedStepIndex())})),t.on("mv.stepper.next",(function(e){e.goNext()})),t.on("mv.stepper.previous",(function(e){e.goPrevious()}))}()}};MVUtil.onDOMContentLoaded((function(){e.init()}))})();