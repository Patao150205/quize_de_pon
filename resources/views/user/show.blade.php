<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 max-w-5xl mx-auto bg-white border-b border-gray-200">
                    <h1 class="text-4xl text-center mb-8 font-bold">{{ $user->name }}さん</h1>
                    @if (Auth::id() === $user->id)
                        <a class="transition block text-center underline hover:text-sky-300"
                            href="{{ route('user.edit') }}">プロフィール編集</a>
                    @endif
                    <div class="p-8">
                        <div class="shadow-xl mx-auto rounded-lg max-w-xl  p-4 bg-sky-200">
                            <div class="flex">
                                <img class="w-14 h-14 rounded-full mr-4 shadow-lg"
                                    src="{{ $user->profile_img ? asset('storage/profile_img/' . $user->profile_img) : asset('images/no-user.png') }}"
                                    alt="{{ $user->name }}さんのプロフィール画像">
                                <div>
                                    <p class="text-gray-500">ID: {{ $user->id }}</p>
                                    <h1 class="text-2xl font-bold text-gray-700">{{ $user->name }}</h1>
                                </div>
                            </div>
                            <p class="mt-6 text-gray-700">
                                {{ $user->profile }}
                            </p>
                        </div>
                        <h1 class="text-4xl text-center mt-12 mb-8 font-bold">{{ $user->name }}さんのクイズ</h1>
                        <table class="mx-auto max-w-5xl w-full">
                            <thead class="border border-gray-800 text-white bg-sky-700">
                                <tr>
                                    <th class="p-2">タイトル</th>
                                    <th>カテゴリ</th>
                                    <th>いいね</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quize_groups as $group)
                                    <tr class="py-2 text-center">
                                        <td class="p-2 border">
                                            <a href="{{ route('quize_group.show', ['group' => $group->id]) }}"
                                                class="underline hover:text-sky-500">{{ $group->title }}</a>
                                        </td>
                                        <td class="border hover:text-sky-500">
                                            <a href="{{ route('category.show', ['category' => $group->name]) }}">
                                                {{ $group->name_jp }}
                                            </a>
                                        </td>
                                        <td class="border">{{ $group->goodCount ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $quize_groups->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
