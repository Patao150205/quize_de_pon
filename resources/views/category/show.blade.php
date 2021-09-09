<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-center p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-8 font-bold text-xl">{{ $category->name_jp ?? 'すべて' }}</h1>
                    <table class="mx-auto max-w-5xl w-full">
                        <thead class="border border-gray-800 text-white bg-sky-700">
                            <tr>
                                <th>ユーザー</th>
                                <th class="p-2">タイトル</th>
                                <th>いいね</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quize_groups as $group)

                                <tr class="py-2">
                                    <td class="border hover:text-sky-500">
                                        <a href="#">
                                            {{ $group->name }}
                                        </a>
                                    </td>
                                    <td class="p-2 border">
                                        <a href="{{ route('quize_group.show', ['group' => $group->id]) }}"
                                            class="underline hover:text-sky-500">{{ $group->title }}</a>
                                    </td>
                                    <td class="border">{{ $group->good_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
