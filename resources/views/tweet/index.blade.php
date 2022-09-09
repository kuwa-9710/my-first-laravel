<x-layout title="TOP | Tweet">
    <x-layout.single>
        @csrf
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            Tweet Application.
        </h2>
        <x-tweet.form.post></x-tweet.form.post>
        <x-tweet.list :tweets="$tweets"></x-tweet.list>
    </x-layout.single>
</x-layout>