import axios from 'axios';

const handleLike = async (control, group_id, user_id) => {
    const csrf_token = document.getElementsByName('csrf-token')[0].content;
    let target;

    if (control == 0) {
        target = 'good';
    } else if (control == 1) {
        target = 'favorite';
    } else {
        throw Error('エラー');
    }

    try {
        const res = await axios.post(
            `/${target}/${group_id}/${user_id}`,
            {},
            {
                headers: {
                    'X-CSRF-TOKEN': csrf_token,
                },
            }
        );
        const status = res.data;
        return status;
    } catch (error) {
        throw Error('通信エラーが発生しました。');
    }
};

window.toggleLike = async (e) => {
    const control = e.dataset.control;
    //  外部とのやり取り
    status = await handleLike(control, group_id, user_id);
    const goodCount = document.getElementById('good-count');
    const favoriteBtn = document.getElementById('favorite-btn');
    const heart = document.getElementById('heart');

    if (status === 'inc' && control == 0) {
        goodCount.innerText = Number(goodCount.innerText) + 1;
        heart.classList.add('text-red-500');
    } else if (status === 'dec' && control == 0) {
        goodCount.innerText = Number(goodCount.innerText) - 1;
        heart.classList.remove('text-red-500');
    } else if (status === 'inc' && control == 1) {
        favoriteBtn.innerText = 'お気に入りを解除する';
        favoriteBtn.classList.add('bg-gray-200');
    } else if (status === 'dec' && control == 1) {
        favoriteBtn.innerText = 'お気に入りを追加する';
        favoriteBtn.classList.remove('bg-gray-200');
    }
};
