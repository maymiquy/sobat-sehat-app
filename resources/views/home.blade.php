<x-guest-layout>
    <div class="py-12">
        @auth
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Selamat datang kembali, {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        @endauth
    </div>
</x-guest-layout>
