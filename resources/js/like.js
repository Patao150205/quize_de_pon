function test() {
    console.log('test');
}

// test();

// const handleLike = (control, group_id, user_id) => {
//     const csrf_token = document.getElementsByName('csrf-token')[0].content;
//     let target;
//     if (control === 0) {
//         target = 'good';
//     } else if (control === 1) {
//         target = 'favorite';
//     } else {
//         throw Error('エラー');
//     }
//     fetch(`/${target}/${group_id}/${user_id}`, {
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': csrf_token,
//         },
//     })
//         .then(async (res) => {
//             const content = await res.text();
//             return content;
//         })
//         .catch((err) => {
//             alert('通信に失敗しました。');
//         });
// };

// handleLike(control, group_id, user_id);
