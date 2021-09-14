import axios from 'axios';

// 編集の場合は、accordionにはすでに初期値が代入されている。

const validation = document.getElementById('validation');
const list = document.getElementById('list');
const submitBtn = document.getElementById('submit_btn');

let canSend = true;
let validationHTML = '';

const html = () => `
<li id="tab${accordionCount}" class="w-full mx-auto overflow-scroll">
<form  id="form${accordionCount}">
<div class="tab w-full overflow-hidden border-t">
<input class="absolute opacity-0" id="tab-single-${accordionCount}" type="radio" name="tabs" />
<label class="block p-5 leading-normal cursor-pointer" for="tab-single-${accordionCount}">第${accordionCount}問</label>
<div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal">
<div class="p-5">
<div class="my-2">
<label class="block" for="question${accordionCount}">問題<span class="text-red-500 ml-1">*</span></label>
<textarea required name="question${accordionCount}" placeholder="問題文"
class="w-full focus:outline-none border focus:border-yellow-300" id="question${accordionCount}"
name="question${accordionCount}" type="text"></textarea>
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice1">選択肢1<span class="text-red-500 ml-1">*</span></label>
<input required name="correct_choice${accordionCount}" value="choice1" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢1" id="${accordionCount}_choice1" name="${accordionCount}_choice1" type="text">
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice2">選択肢2<span class="text-red-500 ml-1">*</span></label>
<input required name="correct_choice${accordionCount}" value="choice2" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢2" id="${accordionCount}_choice2" name="${accordionCount}_choice2" type="text">
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice3">選択肢3<span class="text-red-500 ml-1">*</span></label>
<input required name="correct_choice${accordionCount}" value="choice3" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢3" id="${accordionCount}_choice3" name="${accordionCount}_choice3" type="text">
</div>
<div class="my-2">
<label class="block" for="${accordionCount}_choice4">選択肢4<span class="text-red-500 ml-1">*</span></label>
<input required name="correct_choice${accordionCount}" value="choice4" type="radio">
<input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
placeholder="選択肢4" id="${accordionCount}_choice4" name="${accordionCount}_choice4" type="text">
</div>
<div class="my-2">
<label class="block" for="explanation${accordionCount}">答えの説明</label>
<textarea required name="explanation${accordionCount}" placeholder="答えの説明"
class="w-full focus:outline-none border focus:border-yellow-300" id="explanation${accordionCount}"
name="explanation${accordionCount}" type="text"></textarea>
</div>
</div>
</div>
</div>
</form>
</li>
`;

function addValidation(question_mum, item) {
    const html = `<p class="m-2 text-red-500">第${question_mum}問の必須項目、${item}が未入力です。</p>`;
    validationHTML += html;
    canSend = false;
    return null;
}

addAccordion = () => {
    accordionCount += 1;
    list.insertAdjacentHTML('beforeend', html());
};

addAccordion();

removeAccordion = () => {
    const target = document.getElementById(`tab${accordionCount}`);
    list.removeChild(target);
    accordionCount -= 1;
};

handleSubmit = () => {
    // 問題1問
    const data = [];

    for (let i = 1; i <= accordionCount; i++) {
        const form = document.getElementById('form' + i);
        // フォームの項目
        data.push({
            ['question']: form.elements['question' + i].value
                ? form.elements['question' + i].value
                : addValidation(i, '問題'),
            ['choice1']: form.elements[i + '_choice1'].value
                ? form.elements[i + '_choice1'].value
                : addValidation(i, '選択肢1'),
            ['choice2']: form.elements[i + '_choice2'].value
                ? form.elements[i + '_choice2'].value
                : addValidation(i, '選択肢2'),
            ['choice3']: form.elements[i + '_choice3'].value
                ? form.elements[i + '_choice3'].value
                : addValidation(i, '選択肢3'),
            ['choice4']: form.elements[i + '_choice4'].value
                ? form.elements[i + '_choice4'].value
                : addValidation(i, '選択肢4'),
            ['explanation']: form.elements['explanation' + i].value
                ? form.elements['explanation' + i].value
                : null,
            ['correct_choice']: form.elements['correct_choice' + i].value
                ? form.elements['correct_choice' + i].value
                : addValidation(i, '正解の問題選択'),
            ['quize_group_id']: quize_group_id,
            ['user_id']: user_id,
            ['sort_num']: i,
        });
    }

    data.push([quize_group_id]);

    if (canSend) {
        const destination = isEdit ? '/quize/update' : '/quize/store';
        submitBtn.setAttribute('disabled', true);
        axios
            .post(destination, data)
            .then((res) => {
                alert('問題の送信に成功しました。');
                const group_id = res.data;
                location.href = `/quize_group/${group_id}`;
            })
            .catch((err) => {
                console.log(err.message);
                alert('通信エラーが発生しました。');
                submitBtn.removeAttribute('disabled');
            });
    } else {
        validation.innerHTML = validationHTML;
        validationHTML = '';
        canSend = true;
    }
};
