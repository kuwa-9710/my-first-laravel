<div class="flex justify-center">
    <div class="max-w-screen-sm w-4/5">
        @auth
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <div class="flex justify-end p-4">
                <button
                    class="mt-2 text-sm text-gray-500 hover:text-gray-800"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >Logout</button>
            </div>
        </form>
        @endauth
        {{ $slot }}
    </div>
</div>