(()=>{"use strict";var t={init:function(){!function(){for(var t=Date.now(),e={stack:!0,maxHeight:640,horizontalScroll:!1,verticalScroll:!0,zoomKey:"ctrlKey",start:Date.now()-2592e5,end:Date.now()+18144e5,orientation:{axis:"both",item:"top"}},n=new vis.DataSet,o=new vis.DataSet,i=0;i<300;i++){var r=t+864e5*(i+Math.floor(7*Math.random())),a=r+864e5*(1+Math.floor(5*Math.random()));n.add({id:i,content:"Task "+i,order:i}),o.add({id:i,group:i,start:r,end:a,type:"range",content:"Item "+i})}var s=document.getElementById("mv_docs_vistimeline_group"),c=new vis.Timeline(s,o,n,e);c.setGroups(n),c.setItems(o),c.on("scroll",function(t){var e,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:100;return function(){for(var o=this,i=arguments.length,r=new Array(i),a=0;a<i;a++)r[a]=arguments[a];clearTimeout(e),e=setTimeout((function(){t.apply(o,r)}),n)}}((function(t){var e=c.getVisibleGroups().reduce((function(t,e){var n=c.itemSet.groups[e];return n.items&&(t=t.concat(Object.keys(n.items))),t}),[]);c.focus(e)}),200)),document.getElementById("mv_docs_vistimeline_group_button").addEventListener("click",(function(t){t.preventDefault();var e=c.getVisibleGroups();document.getElementById("visibleGroupsContainer").innerHTML="",document.getElementById("visibleGroupsContainer").innerHTML+=e}))}()}};MVUtil.onDOMContentLoaded((function(){t.init()}))})();