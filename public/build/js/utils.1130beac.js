!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/build/",n(n.s="qB6E")}({qB6E:function(t,e,n){"use strict";function r(t,e){var n=t+(e+1-t)*Math.random();return Math.floor(n)}function o(t){window.clipboardData.setData("Text",t)}n.r(e),n.d(e,"randomInt",function(){return r}),n.d(e,"copy",function(){return o}),Array.prototype.shuffle=function(t){if(t||(t=this.length),t>1){var e=r(0,t-1),n=this[e];this[e]=this[t-1],this[t-1]=n,this.shuffle(t-1)}}}});