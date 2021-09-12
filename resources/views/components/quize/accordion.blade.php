<style>
    .tab-content {
        max-height: 0;
        transition: max-height 0.35s;
    }

    .tab input:checked~.tab-content {
        max-height: 100vh;
    }

    .tab input:checked+label {
        @apply text-xl p-5 border-l-2 border-yellow-500 bg-gray-100 text-indigo font-size: 1.25rem;
        padding: 1.25rem;
        border-left-width: 2px;
        border-color:
            #F59E0B;
        color:
            #F59E0B;
    }

    .tab label::after {
        float: right;
        right: 0;
        top: 0;
        display: block;
        width: 1.5em;
        height: 1.5em;
        line-height: 1.5;
        font-size: 1.25rem;
        text-align: center;
        transition: all 0.35s;
    }

    .tab input[type='radio']+label::after {
        content: '\25BE';
        font-weight: bold;
        border-width: 1px;
        border-radius: 9999px;
        border-color: #b8c2cc;
    }

    input[type='radio']:checked {
        background: #F59E0B;
        color: #F59E0B;
    }

    input[type='radio']:focus {
        background: #F59E0B;
        color: #F59E0B;
    }

    .tab input[type='radio']:checked+label::after {
        transform: rotateX(180deg);
        background-color:
            #F59E0B;
        color: #f8fafc;
    }

</style>

<li id="question1" class="w-full mx-auto">
    <div class="shadow-md">
        <div class="tab w-full overflow-hidden border-t">
            <input class="absolute opacity-0" id="tab-single-one" type="radio" name="tabs2" />
            <label class="block p-5 leading-normal cursor-pointer" for="tab-single-one">第1問</label>
            <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal">
                <div class="p-5">
                    <div class="my-2">
                        <label class="block" for="description">問題</label>
                        <textarea name="question1" placeholder="問題文"
                            class="w-full focus:outline-none border focus:border-yellow-300" id="question1"
                            name="question1" type="text"></textarea>
                    </div>
                    <div class="my-2">
                        <label class="block" for="1_choice1">選択肢1</label>
                        <input required name="correct_choice1" value="1_choice1" type="radio">
                        <input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
                            placeholder="選択肢1" id="1_choice1" name="1_choice1" type="text">
                    </div>
                    <div class="my-2">
                        <label class="block" for="1_choice1">選択肢2</label>
                        <input required name="correct_choice1" value="1_choice2" type="radio">
                        <input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
                            placeholder="選択肢2" id="1_choice2" name="1_choice1" type="text">
                    </div>
                    <div class="my-2">
                        <label class="block" for="1_choice1">選択肢3</label>
                        <input required name="correct_choice1" value="1_choice2" type="radio">
                        <input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
                            placeholder="選択肢3" id="1_choice3" name="1_choice1" type="text">
                    </div>
                    <div class="my-2">
                        <label class="block" for="1_choice1">選択肢4</label>
                        <input required name="correct_choice1" value="1_choice2" type="radio">
                        <input required class="w-11/12 focus:outline-none border focus:border-yellow-300"
                            placeholder="選択肢4" id="1_choice4" name="1_choice1" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>

<script>
    /* Optional Javascript to close the radio button version by clicking it again */
    var myRadios = document.getElementsByName('tabs2');
    var setCheck;
    var x = 0;
    for (x = 0; x < myRadios.length; x++) {
        myRadios[x].onclick = function() {
            if (setCheck != this) {
                setCheck = this;
            } else {
                this.checked = false;
                setCheck = null;
            }
        };
    }
</script>
