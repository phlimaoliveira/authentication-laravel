!function(e){var t={};function r(o){if(t[o])return t[o].exports;var n=t[o]={i:o,l:!1,exports:{}};return e[o].call(n.exports,n,n.exports,r),n.l=!0,n.exports}r.m=e,r.c=t,r.d=function(e,t,o){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)r.d(o,n,function(t){return e[t]}.bind(null,n));return o},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=180)}({180:function(e,t,r){e.exports=r(181)},181:function(e,t){Chart.defaults.global.defaultFontFamily="Nunito",Chart.defaults.global.defaultFontColor="#858796";var r=document.getElementById("myPieChart");new Chart(r,{type:"doughnut",data:{labels:["Direct","Referral","Social"],datasets:[{data:[55,30,15],backgroundColor:["#4e73df","#1cc88a","#36b9cc"],hoverBackgroundColor:["#2e59d9","#17a673","#2c9faf"],hoverBorderColor:"rgba(234, 236, 244, 1)"}]},options:{maintainAspectRatio:!1,tooltips:{backgroundColor:"rgb(255,255,255)",bodyFontColor:"#858796",borderColor:"#dddfeb",borderWidth:1,xPadding:15,yPadding:15,displayColors:!1,caretPadding:10},legend:{display:!1},cutoutPercentage:80}})}});