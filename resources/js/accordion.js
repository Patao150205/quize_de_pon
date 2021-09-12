'use strict';

let accordionCount = 1;
const list = document.getElementById('list');
console.log(list, 'リスト');

const html = `
<li id="question${accordionCount}" class="w-full mx-auto">
<div class="shadow-md">
<div class="tab w-full overflow-hidden border-t">
<input class="absolute opacity-0" id="tab-single-one" type="radio" name="tabs2" />
<label class="block p-5 leading-normal cursor-pointer" for="tab-single-one">第${accordionCount}問</label>
<div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal">
<div class="p-5">
<div class="my-2">
<label class="block" for="description">問題</label>
<textarea name="question${accordionCount}" placeholder="問題文"
class="w-full focus:outline-none border focus:border-yellow-300" id="question${accordionCount}"
name="question${accordionCount}" type="text"></textarea>
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice1">選択肢1</label>
<input required name="correct_choice1" value="${accordionCount}_choice1" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢1" id="${accordionCount}_choice1" name="${accordionCount}_choice1" type="text">
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice1">選択肢2</label>
<input required name="correct_choice1" value="${accordionCount}_choice2" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢2" id="${accordionCount}_choice1" name="${accordionCount}_choice2" type="text">
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice1">選択肢3</label>
<input required name="correct_choice1" value="${accordionCount}_choice3" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢3" id="${accordionCount}_choice1" name="${accordionCount}_choice3" type="text">
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice1">選択肢4</label>
<input required name="correct_choice1" value="${accordionCount}_choice4" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢4" id="${accordionCount}_choice4" name="${accordionCount}_choice4" type="text">
</div>
</div>
</div>
</div>
</div>
</li>
`;

addAccordion = () => {
    accordionCount += 1;
    console.log(accordionCount, html);
    list.insertAdjacentHTML('beforeend', html);
};

removeAccordion = () => {};
