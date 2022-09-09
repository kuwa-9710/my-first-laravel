@props([
    'tweet'
])
<div class="p-4">
    <form action="{{ route('tweet.update.put', ['tweetId' => $tweet->id]) }}" method="post">
        @method('PUT')
        @csrf
        @if (session('feedback.success'))
        <x-alert.success>{{ session('feedback.success') }}</x-alert.success>
        @endif
        <div class="mt-1">
            <textarea
            name="tweet" rows="3"
            class="focus:rint-blue-400 focus:border-blue-400 mt-1 block
            w-full sm:text-sm border border-gray-300 rounded-md p-2"
            placeholder="Tweetを入力">{{ $tweet->content }}</textarea>
        </div>
        <p class="mt-2 text-sm text-gray-500">
            140文字まで
        </p>

        @error('tweet')
        <x-alert.error>{{ $message }}</x-alert.error>
        @enderror

        <div class="flex flex-wrap justify-end">
            <x-element.button>
                編集
            </x-element.button>
        </div>
    </form>
</div>