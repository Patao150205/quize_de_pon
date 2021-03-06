<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">クイズ集編集リスト</h1>
                    <table class="mx-auto max-w-5xl w-full">
                        <thead class="border border-gray-800 text-white bg-sky-700">
                            <tr>
                                <th class="p-2">タイトル</th>
                                <th>カテゴリ</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quize_groups as $quize_group)
                                <tr id="quize_group_id_{{ $quize_group->quize_group_id }}" class="py-2">
                                    <td class="p-2 border">
                                        <a href="{{ route('quize_group.edit', ['quize_group' => $quize_group->quize_group_id]) }}"
                                            class="underline hover:text-sky-500">{{ $quize_group->title }}</a>
                                    </td>
                                    <td class="border">
                                        <p class="">
                                            {{ $quize_group->name_jp }}
                                        </p>
                                    </td>
                                    <td class="
                                            border">
                                            <button type="button"
                                                onclick="deleteQuestionList('{{ $quize_group->quize_group_id }}', '{{ $quize_group->title }}')"
                                                class="text-red-500 hover:underline">
                                                削除
                                            </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $quize_groups->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const csrf_token = document.getElementsByName('csrf-token')[0].content;

        function deleteQuestionList(id, name) {
            const answer = confirm(`本当に、${name}を削除してもよろしいですか？\n`);
            if (answer) {
                fetch(`/quize_group/destroy/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf_token,
                    },
                }).then((res) => {
                    if (res.ok) {
                        const targetRow = document.getElementById(`quize_group_id_${id}`);
                        targetRow.remove();
                    } else {
                        throw Error('通信エラーが発生しました。');
                    }
                }).catch((err) => {
                    alert('通信エラーが発生しました。');
                })
            }
        }
    </script>
</x-app-layout>
