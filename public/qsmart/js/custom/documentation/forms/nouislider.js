(()=>{"use strict";var e={init:function(e){var t,n,r,i,o,c;t=document.querySelector("#mv_slider_basic"),n=document.querySelector("#mv_slider_basic_min"),r=document.querySelector("#mv_slider_basic_max"),noUiSlider.create(t,{start:[20,80],connect:!0,range:{min:0,max:100}}),t.noUiSlider.on("update",(function(e,t){t?r.innerHTML=e[t]:n.innerHTML=e[t]})),i=document.querySelector("#mv_slider_sizes_sm"),o=document.querySelector("#mv_slider_sizes_default"),c=document.querySelector("#mv_slider_sizes_lg"),noUiSlider.create(i,{start:[20,80],connect:!0,range:{min:0,max:100}}),noUiSlider.create(o,{start:[20,80],connect:!0,range:{min:0,max:100}}),noUiSlider.create(c,{start:[20,80],connect:!0,range:{min:0,max:100}}),function(){var e=document.querySelector("#mv_slider_vertical");noUiSlider.create(e,{start:[60,160],connect:!0,orientation:"vertical",range:{min:0,max:200}})}(),function(){var e=document.querySelector("#mv_slider_tooltip");noUiSlider.create(e,{start:[20,80,120],tooltips:[!1,wNumb({decimals:1}),!0],range:{min:0,max:200}})}(),function(){var e=document.querySelector("#mv_slider_soft_limits");noUiSlider.create(e,{start:50,range:{min:0,max:100},pips:{mode:"values",values:[20,80],density:4}})}()}};MVUtil.onDOMContentLoaded((function(){e.init()}))})();