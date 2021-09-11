<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 max-w-5xl mx-auto bg-white border-b border-gray-200">
                    <h1 class="text-4xl text-center mb-8 font-bold">{{ $user->name }}さんのクイズ</h1>
                    @if (Auth::id() === $user->id)
                        <a class="transition block text-center underline hover:text-sky-300"
                            href="{{ route('user.edit') }}">プロフィール編集</a>
                    @endif
                    <div class="p-8">
                        <div class="shadow-xl rounded-lg">
                            <div class="flex bg-sky-50 rounded-b-lg px-8 py-8">
                                <img class="w-16 h-16 rounded-full mr-4 shadow-lg"
                                    src="{{ $user->profile_img ? asset('storage/profile_img/' . $user->profile_img) : asset('images/no-user.png') }}"
                                    alt="">
                                <div>
                                    <p class="text-gray-500">ID: {{ $user->id }}</p>
                                    <h1 class="text-2xl font-bold text-gray-700">{{ $user->name }}</h1>
                                    <p class="mt-6 text-gray-700">
                                        {{ $user->profile }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
