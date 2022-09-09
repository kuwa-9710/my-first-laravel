{{-- 変数の初期値を設定している。hrefには何もなし、themeはprimary。つまり何も入れなければprimaryになる --}}
@props([
    'href' => '',
    'theme' => 'primary',
])
@php
    // 以下はgetThemeClassForButtonAという関数が定義 されていなかった場合 に
    if(!function_exists('getThemeClassForButtonA')){
        function getThemeClassForButtonA($theme) {
            return match ($theme) {
                'primary' => 'text-white bg-blue-500 hover:bg-blue-600 focus:ring-blue-500',
                'secondary' => 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-500'
            };
        }
    }
@endphp
{{-- matchでprimaryかsecondaryの記述が追加される --}}
<a href="{{ $href }}" class="
inline-flex justify-center
py-2 px-4
border border-transparent
shadow-sm
text-sm
font-medium
rounded-md
focus:outline-none focus:ring-2 focus:ring-offset-2
{{ getThemeClassForButtonA($theme) }}">
{{ $slot }}
</a>