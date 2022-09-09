@props([
    'images' => []
])

@if(count($images) > 0)
<div x-data="{}" class="px-2">
    <div class="flex justify-center -mx-2">
        @foreach($images as $image)
        <div class="w-1/6 px-2 mt-5">
            <div class="bg-gray-400">
                {{-- @clickはAlpine.jsのディレクティブで、糖衣構文。クリックイベントに関数を登録できる --}}
                {{-- 今回はdispatch関数を利用してimg-modalを起動させるためのイベントを実行する --}}
                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ asset('storage/images/' . $image->name)  }}' })" class="cursor-pointer">
                    <img alt="{{ $image->name }}" class="object-fit w-full" src="{{ asset('storage/images/' . $image->name) }}">
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
{{-- onceはLaravelのディレクティブで、一度だけテンプレートに挿入させている --}}
@once
    <div x-data="{ imgModal : false, imgModalSrc : '' }">
        <div
            @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc;"
            x-cloak
            x-show="imgModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform"
            x-transition:enter-end="opacity-100 transform"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform"
            x-transition:leave-end="opacity-0 transform"
            x-on:click.away="imgModalSrc = ''"
            class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
            <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
                <div class="z-50">
                    <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                        <svg class="fill-current text-white h-5 w-5" xmlns="<http://www.w3.org/2000/svg>" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="p-2">
                    <img
                        class="object-contain h-1/2-screen"
                        :alt="imgModalSrc"
                        :src="imgModalSrc">
                </div>
            </div>
        </div>
    </div>
    @push('css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @endpush
@endonce
