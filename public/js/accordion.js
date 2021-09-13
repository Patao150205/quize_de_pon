/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/accordion.js ***!
  \***********************************/


function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var accordionCount = 0;
var list = document.getElementById('list');

var html = function html() {
  return "\n<li id=\"tab".concat(accordionCount, "\" class=\"w-full mx-auto\">\n<form id=\"form").concat(accordionCount, "\">\n<div class=\"tab w-full overflow-hidden border-t\">\n<input class=\"absolute opacity-0\" id=\"tab-single-").concat(accordionCount, "\" type=\"radio\" name=\"tabs\" />\n<label class=\"block p-5 leading-normal cursor-pointer\" for=\"tab-single-").concat(accordionCount, "\">\u7B2C").concat(accordionCount, "\u554F</label>\n<div class=\"tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal\">\n<div class=\"p-5\">\n<div class=\"my-2\">\n<label class=\"block\" for=\"description\">\u554F\u984C</label>\n<textarea required name=\"question").concat(accordionCount, "\" placeholder=\"\u554F\u984C\u6587\"\nclass=\"w-full focus:outline-none border focus:border-yellow-300\" id=\"question").concat(accordionCount, "\"\nname=\"question").concat(accordionCount, "\" type=\"text\"></textarea>\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice1\">\u9078\u629E\u80A21</label>\n<input required name=\"correct_choice").concat(accordionCount, "\" value=\"").concat(accordionCount, "_choice1\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A21\" id=\"").concat(accordionCount, "_choice1\" name=\"").concat(accordionCount, "_choice1\" type=\"text\">\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice2\">\u9078\u629E\u80A22</label>\n<input required name=\"correct_choice").concat(accordionCount, "\" value=\"").concat(accordionCount, "_choice2\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A22\" id=\"").concat(accordionCount, "_choice2\" name=\"").concat(accordionCount, "_choice2\" type=\"text\">\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice3\">\u9078\u629E\u80A23</label>\n<input required name=\"correct_choice").concat(accordionCount, "\" value=\"").concat(accordionCount, "_choice3\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A23\" id=\"").concat(accordionCount, "_choice3\" name=\"").concat(accordionCount, "_choice3\" type=\"text\">\n</div>\n<div class=\"my-2\">\n<label class=\"block\" for=\"").concat(accordionCount, "_choice4\">\u9078\u629E\u80A24</label>\n<input required name=\"correct_choice").concat(accordionCount, "\" value=\"").concat(accordionCount, "_choice4\" type=\"radio\">\n<input required class=\"w-11/12 focus:outline-none border focus:border-yellow-300\"\nplaceholder=\"\u9078\u629E\u80A24\" id=\"").concat(accordionCount, "_choice4\" name=\"").concat(accordionCount, "_choice4\" type=\"text\">\n</div>\n</div>\n</div>\n</div>\n</form>\n</li>\n");
};

addAccordion = function addAccordion() {
  accordionCount += 1;
  list.insertAdjacentHTML('beforeend', html());
};

addAccordion();

removeAccordion = function removeAccordion() {
  var target = document.getElementById("tab".concat(accordionCount));
  list.removeChild(target);
  accordionCount -= 1;
};

var data = [];

handleSubmit = function handleSubmit() {
  // 問題1問
  var data = [];

  for (var i = 1; i <= accordionCount; i++) {
    var _data$push;

    var form = document.getElementById('form' + i); // フォームの項目

    data.push((_data$push = {}, _defineProperty(_data$push, 'question', form.elements['question' + i].value), _defineProperty(_data$push, 'choice1', form.elements[i + '_choice1'].value), _defineProperty(_data$push, 'choice2', form.elements[i + '_choice2'].value), _defineProperty(_data$push, 'choice3', form.elements[i + '_choice3'].value), _defineProperty(_data$push, 'choice4', form.elements[i + '_choice4'].value), _defineProperty(_data$push, 'correct_choice', form.elements['correct_choice' + i].value), _data$push));
  }

  console.log(data); // const body = [];
  // console.log(forms);
  // for (let i = 0; i < forms.length; i++) {
  //     console.log(forms[0].elements[0].value);
  // }
};
/******/ })()
;