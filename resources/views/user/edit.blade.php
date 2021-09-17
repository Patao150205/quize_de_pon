<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 max-w-5xl mx-auto bg-white border-b border-gray-200">
                    <h1 class="text-4xl text-center mb-8 font-bold">プロフィール編集</h1>

                    <form class="my-8 mx-auto max-w-md" enctype="multipart/form-data" method="POST"
                        action="{{ route('user.update') }}">
                        @csrf
                        <div class="my-8">
                            <label class="block" for="name">名前</label>
                            <input required class="w-full focus:outline-none border focus:border-sky-300"
                                value="{{ $user->name }}" placeholder="名前" id="name" name="name" type="text">
                        </div>

                        <input name="before_img_name" type="hidden" value="{{ $user->profile_img ?? '' }}">
                        <img id="profile_img"
                            src="{{ $user->profile_img ? asset('storage/profile_img/' . $user->profile_img) : asset('images/no-user.png') }}"
                            class="block mx-auto border-2 mb-4 w-14 h-14 border-sky-600 rounded-full object-cover"
                            alt="プロフィール画像">
                        <label for="img_file">
                            <div id="drag_field"
                                class="shadow-lg rounded-md border-4 border-black border-dashed  w-full p-2 text-center cursor-pointer">
                                <p>プロフィール画像</p>
                                <i class="fas fa-images text-sky-100 text-9xl"></i>
                                <p class="text-sm font-thin">ドラッグアンドドロップかファイルを選択してね！</p>
                            </div>
                        </label>
                        <input id="img_file" name="profile_img" class="hidden" type="file" accept="image/*" />

                        <div class="my-8">
                            <label class="block" for="profile">プロフィール</label>
                            <textarea rows="3" class="w-full focus:outline-none border focus:border-sky-300"
                                placeholder="プロフィール" id="profile" name="profile"
                                type="text">{{ $user->profile }}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="mt-4 py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">更新する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const img_file = document.getElementById('img_file');
        const profile_img = document.getElementById('profile_img');
        const drag_field = document.getElementById('drag_field');

        function displayImg(file) {
            const url = URL.createObjectURL(file);
            profile_img.src = url;
        }

        img_file.onchange = (e) => {
            const file = e.target.files[0];
            displayImg(file);
        }
        drag_field.ondragover = (e) => {
            e.preventDefault();
            e.target.classList.add('bg-red-200');
        }
        drag_field.ondragleave = (e) => {
            e.preventDefault();
            e.target.classList.remove('bg-red-200');
        }
        drag_field.ondrop = (e) => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            img_file.files = e.dataTransfer.files;
            e.target.classList.remove('bg-red-200');
            displayImg(file);
        }
    </script>
</x-app-layout>
