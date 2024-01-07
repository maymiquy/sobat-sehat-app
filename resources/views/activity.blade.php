<x-guest-layout>
    <div class="container mx-auto py-8 space-y-4">
        <div class="flex mx-auto items-center w-fit bg-white p-3 rounded-md drop-shadow-md">
            <h1 class="text-3xl">Kegiatan</h1>
        </div>
    </div>


    <div class="flex justify-center items-center my-3">
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="bg-green-600 rounded-md text-white text-center p-2">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="grid grid-cols-2">
                @guest
                    <div class="p-2 flex">
                        <a
                            class="hidden select-none max-w-fit rounded-lg bg-green-600 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Tambah
                        </a>
                    </div>
                @else
                    <div class="flex p-2">
                        <button
                            class="select-none max-w-fit rounded-lg bg-green-600 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-activity')">
                            Tambah
                        </button>
                    </div>
                @endguest
                <div class="my-2 flex sm:flex-row flex-col">
                    <form action="{{ route('kegiatan.search') }}" method="GET"
                        class="block relative w-full drop-shadow-md">
                        <input type="text" name="search" placeholder="Search acara kegiatan. . ."
                            value="{{ request()->input('search') }}"
                            class="appearance-none rounded-md border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        <button type="submit" class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"
                                class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
            <div class="-mx-4 sm:-mx-8 px-2 sm:px-6 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama Acara/Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Poster
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Deskripsi Acara/Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Jadwal Tanggal Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Waktu Mulai Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Lokasi
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Kontributor Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                    Total Peserta
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-center text-[12px] font-semibold text-gray-600 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $event->event_name }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-28 h-16">
                                                <img class="w-full h-full rounded"
                                                    src="assets/images/{{ $event->poster }}"
                                                    alt="{{ $event->event_name }}" />
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-2 py-5 border-b min-w-[200px] w-auto border-gray-200 bg-white overflow-hidden">
                                        <p class="text-gray-900 text-xs whitespace-no-wrap">
                                            {!! nl2br(e(Str::limit($event->description, 5 * 60))) !!}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-xs">
                                        <p class="text-gray-900 whitespace-nowrap">
                                            {{ $event->event_date }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-xs">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $event->event_time }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $event->location }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-xs">
                                        <span class="text-gray-900 whitespace-nowrap">
                                            {{ App\Models\User::find($event->author)->name }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        @if ($event->members_count == 0)
                                            <div data-ripple-light="true" data-tooltip-target="tooltip-empty"
                                                class="flex justify-center items-center py-2 bg-gray-300 rounded">
                                                <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                    {{ $event->members_count }}
                                                </p>
                                            </div>
                                            <div data-tooltip="tooltip-empty" data-tooltip-placement="bottom"
                                                class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                                Perserta masih kosong
                                            </div>
                                        @elseif ($event->members_count <= 20)
                                            <div data-ripple-light="true" data-tooltip-target="tooltip-available"
                                                class="flex justify-center items-center py-2 bg-green-500 rounded">
                                                <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                    {{ $event->members_count }}
                                                </p>
                                            </div>
                                            <div data-tooltip="tooltip-available" data-tooltip-placement="bottom"
                                                class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                                Kapasitas masih tersedia
                                            </div>
                                        @else
                                            <div data-ripple-light="true" data-tooltip-target="tooltip-overload"
                                                class="flex justify-center items-center py-2 bg-red-500 rounded">
                                                <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                    {{ $event->members_count }}
                                                </p>
                                            </div>
                                            <div data-tooltip="tooltip-oveerload" data-tooltip-placement="bottom"
                                                class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                                Kapasitas hampir penuh
                                            </div>
                                        @endif
                                    </td>
                                    @guest
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                                            <button x-data data-id="{{ $event->id }}"
                                                x-on:click.prevent="$dispatch('open-modal', 'join-activity')"
                                                class="inline-block w-32 text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                                                data-ripple-light="true" data-tooltip-target="tooltip-join">
                                                Join
                                            </button>
                                        </td>
                                        <div data-tooltip="tooltip-join" data-tooltip-placement="bottom"
                                            class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                            Ikuti Acara/Kegiatan
                                        </div>
                                    @else
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                                        </td>
                                    @endguest
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-5 bg-white text-sm text-gray-500 text-center">
                                        Acara kegiatan tidak di temukan...
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <div class="inline-flex items-center space-x-4 mt-2 xs:mt-0">
                            @if ($page > 1)
                                <a href="{{ url()->current() }}?page={{ $page - 1 }}"
                                    class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <span
                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                            class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                        </svg>
                                    </span>
                                </a>
                            @else
                                <button disabled
                                    class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:cursor-not-allowed disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <span
                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                            class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                        </svg>
                                    </span>
                                </button>
                            @endif
                            <span class="text-xs xs:text-sm font-semibold font-sans text-gray-700">
                                Show page {{ $page }} of {{ $totalPages }}
                            </span>
                            @if ($page < $totalPages)
                                <a href="{{ url()->current() }}?page={{ $page + 1 }}"
                                    class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <span
                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                            class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                                        </svg>
                                    </span>
                                </a>
                            @else
                                <button disabled
                                    class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:cursor-not-allowed disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <span
                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                            class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                                        </svg>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="add-activity" focusable>
        <div class="flex flex-col justify-center items-center py-6 px-4">
            <h1 class="text-2xl text-gray-800 text-center font-bold mb-6">Post Kegiatan</h1>
            <form enctype="multipart/form-data" method="POST" action="{{ route('kegiatan.store') }}">
                @csrf
                <div class="mb-6">
                    <label for="event_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kegiatan :</label>
                    <input type="text" id="event_name" name="event_name"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Nama kegiatan...">
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Kegiatan
                        :</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Deskripsi Kegiatan..."></textarea>
                </div>
                <div class="mb-6">
                    <label for="poster" class="block text-gray-700 text-sm font-bold mb-2">Poster :</label>
                    <div
                        class="relative border-2 border-gray-400 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                        <input type="file" id="poster" name="poster"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            onchange="showSelectedFileName(event)">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span id="file-name" class="ml-2 text-sm text-gray-500">Choose or drop image</span>
                        </div>
                        <span class="ml-6 text-sm text-gray-500"> Max size: 3MB</span>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="event_date" class="block text-gray-700 text-sm font-bold mb-2">Jadwal Kegiatan
                        :</label>
                    <input type="date" id="event_date" name="event_date"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Jadwal kegiatan...">
                </div>
                <div class="mb-6">
                    <label for="event_time" class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai Kegiatan
                        :</label>
                    <input type="time" id="event_time" name="event_time"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Waktu kegiatan ...">
                </div>
                <div class="mb-6">
                    <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Kegiatan :</label>
                    <textarea id="location" name="location" rows="2"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Lokasi Kegiatan..."></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                        Post Kegiatan <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                            viewBox="0 0 24 24" id="send" fill="#fff">
                            <path fill="none" d="M0 0h24v24H0V0z"></path>
                            <path
                                d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="join-activity" focusable>
        <div class="flex flex-col justify-center items-center relative py-6 px-6">
            <h1 class="text-2xl text-gray-800 text-center font-bold mb-6">Ikut Kegiatan</h1>
            <form class="w-full" enctype="multipart/form-data" method="POST"
                action="{{ route('peserta.store') }}">
                @csrf
                <div class="mb-6 w-full">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama : </label>
                    <input type="text" id="name" name="name"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Masukan nama anda...">
                </div>
                <div class="mb-6 w-full">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email :</label>
                    <input type="text" id="email" name="email"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Masukan Email...">
                </div>
                <div class="mb-6 w-full">
                    <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">No Telepon :</label>
                    <input type="text" id="phone_number" name="phone_number"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Masukan no telepon...">
                </div>
                <input type="hidden" id="event_id" name="event_id"
                    class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                        Ikut Kegiatan <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                            viewBox="0 0 24 24" id="send" fill="#fff">
                            <path fill="none" d="M0 0h24v24H0V0z"></path>
                            <path
                                d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</x-guest-layout>


<script>
    document.addEventListener('click', function(event) {
        if (event.target.matches('[data-id]')) {
            var eventId = event.target.dataset.id;
            document.getElementById('event_id').value = eventId;
        }
    });
</script>
