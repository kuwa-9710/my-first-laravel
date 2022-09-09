@props([
    'breadcrumbs' => [
        [
            'href' => '/',
            'label' => 'TOP',
        ],
    ],
])
<div class="text-black mx-4 my-3" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        @foreach ($breadcrumbs as $breadcrumb)
         {{-- ループが最後の値の場合は、以下を実行するような記述です --}}
            @if ($loop->last)
                <li>
                    <a href="{{ $breadcrumb['href'] }}" class="text-gray-500"
                        aria-current="page">{{ $breadcrumb['label'] }}</a>
                </li>
         {{-- それ以外は矢印を含んだものを表示します --}}
            @else
                <li class="flex items-center">
                    <a href="{{ $breadcrumb['href'] }}" class="hover:underline">{{ $breadcrumb['label'] }}</a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</div>
