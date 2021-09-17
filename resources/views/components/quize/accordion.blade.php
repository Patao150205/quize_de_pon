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

<script>
    const list = document.getElementById('list');
    const addButton = document.getElementById('add_btn');

    const myRadios = document.getElementsByName('tabs');
    let setCheck;
    let x = 0;

    function addToggleEvent() {
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
    }

    addToggleEvent();

    const observer = new MutationObserver(function() {
        addToggleEvent();
    });

    const config = {
        attributes: true,
        childList: true,
    }

    observer.observe(list, config);
</script>
