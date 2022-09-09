@auth
    <div class="p-4 max-w-2xl">
        <form action="{{ route('tweet.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-1">
                <textarea name="tweet" rows="3"
                    class="focus:ring-blue-400 focus:border-blue-400 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                    placeholder="つぶやきを入力">
                </textarea>
            </div>
            <p class="mt-2 text-sm text-gray-500">
                140文字まで
            </p>
            <x-tweet.form.images></x-tweet.form.images>

            @error('tweet')
                <x-alert.error>{{ $message }}</x-alert.error>
            @enderror

            <div class="flex flex-wrap justify-end">
                <x-element.button>
                    Tweet
                </x-element.button>
            </div>
        </form>
    </div>
@endauth
@guest
    <div class="flex flex-wrap justify-center">
        <div class="w-1/2 p-4 flex flex-wrap justify-evenly">
            <x-element.button-a :href="route('login')">Login</x-element.button-a>
            <x-element.button-a :href="route('register')" theme="secondary">Register</x-element.button-a>
        </div>
    </div>
@endguest
