/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/accordion.js ***!
  \***********************************/


var accordionCount = 1;
var list = document.getElementById('list');
console.log(list, 'リスト');
var html = "\n<li id=\"question".concat(accordionCount, "\" class=\"w-full mx-auto\">\n<div class=\"shadow-md\">\n<div class=\"tab w-full overflow-hidden border-t\">\n<input class=\"absolute opacity-0\" id=\"tab-single-one\" type=\"radio\" name=\"tabs2\" />\n<label class=\"block p-5 leading-normal cursor-pointer\" for=\"tab-single-one\">\u7B2C").concat(accordionCount, "\u554F</label>\n<div class=\"tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal\">\n<div class=\"p-5\">\n<div class=\"my-2\">\n<label class=\"block\" for=\"description\">\u554F\u984C</label>\n<textarea name=\"question").concat(accordionCount, "\" placeholder=\"\u554F\u984C\u6587\"\nclass=\"w-full focus:outline-none border focus:border-yellow-300\" id=\"question").concat(accordionCount, "\"\nname=\"question").concat(accordionCount, "\" type=\"text\"></textarea>\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice1\">\u9078\u629E\u80A21</label>\n<input required name=\"correct_choice1\" value=\"").concat(accordionCount, "_choice1\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A21\" id=\"").concat(accordionCount, "_choice1\" name=\"").concat(accordionCount, "_choice1\" type=\"text\">\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice1\">\u9078\u629E\u80A22</label>\n<input required name=\"correct_choice1\" value=\"").concat(accordionCount, "_choice2\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A22\" id=\"").concat(accordionCount, "_choice1\" name=\"").concat(accordionCount, "_choice2\" type=\"text\">\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice1\">\u9078\u629E\u80A23</label>\n<input required name=\"correct_choice1\" value=\"").concat(accordionCount, "_choice3\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A23\" id=\"").concat(accordionCount, "_choice1\" name=\"").concat(accordionCount, "_choice3\" type=\"text\">\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice1\">\u9078\u629E\u80A24</label>\n<input required name=\"correct_choice1\" value=\"").concat(accordionCount, "_choice4\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A24\" id=\"").concat(accordionCount, "_choice4\" name=\"").concat(accordionCount, "_choice4\" type=\"text\">\n</div>\n</div>\n</div>\n</div>\n</div>\n</li>\n");

addAccordion = function addAccordion() {
  accordionCount += 1;
  console.log(accordionCount, html);
  list.insertAdjacentHTML('beforeend', html);
};

removeAccordion = function removeAccordion() {};
/******/ })()
;