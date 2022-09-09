<x-layout title="Edit | Tweet App">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold my-8">
            Tweet Apprication.
        </h2>
        @php
            $breadcrumbs = [
                ['href' => route('tweet.index'), 'label' => 'TOP'],
                ['href' => '#', 'label' => 'Edit']
            ];
        @endphp
        <x-element.breadcrumbs :breadcrumbs="$breadcrumbs"></x-element.breadcrumbs>
        <x-tweet.form.put :tweet="$tweet"></x-tweet.form.put>
    </x-layout.single>
</x-layout>