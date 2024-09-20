<x-guest-layout>
    <div class="px-4 md:px-24 w-full">
        <div class="w-full flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 items-center mb-3 mt-1">
            <div class="block max-w-xs min-w-[50px] w-auto text-center md:text-start">
                <h3 class="text-lg md:text-xl font-semibold text-slate-800">Kegiatan & Acara</h3>
                <p class="text-sm md:text-md text-slate-500">Temukan kegiatan dan acara yang menarik.</p>
            </div>

            <div class="flex justify-center items-center my-3">
                @if (session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                        class="bg-green-600 rounded-md text-white text-center p-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="flex flex-row w-full md:max-w-sm space-x-2 min-w-[200px] relative">
                @auth
                    <div class="flex w-full">
                        <button
                            class="select-none w-full rounded-lg bg-green-600 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-activity')">
                            Tambah
                        </button>
                    </div>
                @endauth
                <form action="{{ route('kegiatan.search') }}" method="GET"
                    class="block relative w-full drop-shadow-sm">
                    <input type="text" name="search" placeholder="Cari acara kegiatan. . ."
                        value="{{ request()->input('search') }}"
                        class="appearance-none rounded-md border text-xs border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white md:text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
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

        <div
            class="relative flex flex-col w-full h-full overflow-x-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Acara / Kegiatan
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Poster
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Deskripsi
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Tanggal Kegiatan
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Waktu Mulai
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Lokasi
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Kontributor
                            </p>
                        </th>
                        <th class="text-center p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-bold leading-none text-slate-500">
                                Total Peserta
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr class="hover:bg-slate-50 border-b border-slate-200">
                            <td class="p-4 py-5 max-w-[200px]">
                                <p class="block font-semibold w-[200px] text-xs text-slate-800">
                                    {!! nl2br(e(Str::limit($event->event_name, 2 * 60))) !!}
                                </p>
                            </td>
                            <td class="p-4 py-5 border-gray-200">
                                <div class="flex justify-center items-center w-full px-2">
                                    <div class="flex-shrink-0 w-28 h-16">
                                        <img class="w-full h-full rounded" src="assets/images/{{ $event->poster }}"
                                            alt="{{ $event->event_name }}" />
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 py-5">
                                <p class="block font-light text-xs text-slate-800 w-[300px] overflow-hidden">
                                    {!! nl2br(e(Str::limit($event->description, 5 * 60))) !!}
                                </p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="block font-semibold text-center text-xs text-slate-800">
                                    {{ $event->event_date }}
                                </p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="block font-semibold text-center text-xs text-slate-800">
                                    {{ $event->event_time }}
                                </p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="block font-semibold text-xs w-[150px] text-slate-800">
                                    {{ $event->location }}
                                </p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="block font-semibold text-xs text-slate-800">
                                    {{ App\Models\User::find($event->author)->name }}
                                </p>
                            </td>
                            <td class="p-4 py-5">
                                <div class="flex flex-row justify-center items-center">
                                    @if ($event->members_count == 0)
                                        <div data-ripple-light="true" data-tooltip-target="tooltip-empty"
                                            class="flex justify-center items-center py-1 px-4 w-fit bg-gray-300 rounded">
                                            <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                {{ $event->members_count }}
                                            </p>
                                        </div>
                                        <div data-tooltip="tooltip-empty" data-tooltip-placement="bottom"
                                            class="absolute z-50 whitespace-normal break-words w-max rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-slate-800 focus:outline-none">
                                            Perserta masih kosong
                                        </div>
                                    @elseif ($event->members_count <= 20)
                                        <div data-ripple-light="true" data-tooltip-target="tooltip-available"
                                            class="flex justify-center items-center py-1 px-4 w-fit bg-green-500 rounded">
                                            <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                {{ $event->members_count }}
                                            </p>
                                        </div>
                                        <div data-tooltip="tooltip-available" data-tooltip-placement="bottom"
                                            class="absolute z-50 whitespace-normal break-words w-max rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-slate-800 focus:outline-none">
                                            Kapasitas masih tersedia
                                        </div>
                                    @else
                                        <div data-ripple-light="true" data-tooltip-target="tooltip-overload"
                                            class="flex justify-center items-center py-1 px-4 w-fit bg-red-500 rounded">
                                            <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                {{ $event->members_count }}
                                            </p>
                                        </div>
                                        <div data-tooltip="tooltip-oveerload" data-tooltip-placement="bottom"
                                            class="absolute z-50 whitespace-normal break-words w-max rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-slate-800 focus:outline-none">
                                            Kapasitas hampir penuh
                                        </div>
                                    @endif
                                </div>
                            </td>

                            @guest
                                <td class="px-5 py-5 text-xs">
                                    <button x-data data-id="{{ $event->id }}"
                                        x-on:click.prevent="$dispatch('open-modal', 'join-activity')"
                                        class="inline-block w-32 text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                                        data-ripple-light="true" data-tooltip-target="tooltip-join">
                                        Join
                                    </button>
                                </td>
                                <div data-tooltip="tooltip-join" data-tooltip-placement="bottom"
                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 w-max py-1.5 px-3 font-sans text-sm font-normal text-slate-800 focus:outline-none">
                                    Ikuti Acara/Kegiatan
                                </div>
                            @else
                                <td class="px-5 py-5 bg-white text-xs">
                                </td>
                            @endguest
                        </tr>
                    @empty
                        <tr class="hover:bg-slate-50 border-b border-slate-200">
                            <td colspan="9" class="p-4 py-12 md:py-24">
                                <p class="text-center">
                                    Tidak ada acara atau kegiatan ditemukan ...
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="flex justify-between items-center px-4 py-3">
                <div class="text-xs md:text-sm text-slate-500">
                    Showing page <b>{{ $page }}</b> of {{ $totalPages }}
                </div>
                <div class="flex space-x-1">
                    <button @disabled($page == 1)
                        onclick="window.location.href='{{ url()->current() }}?page={{ $page - 1 }}'"
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded  {{ $page == 1 ? 'opacity-40 cursor-not-allowed' : 'hover:text-slate-100 hover:bg-slate-700 hover:border-slate-900 transition duration-200 ease' }} ">
                        Prev
                    </button>
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <button @disabled($page == $i)
                            onclick="window.location.href='{{ url()->current() }}?page={{ $i }}'"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $page == $i ? 'text-white bg-slate-600 border border-slate-600 rounded hover:bg-slate-700 hover:border-slate-900' : 'text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-700 hover:border-slate-900 hover:text-slate-100' }} transition duration-200 ease">
                            {{ $i }}
                        </button>
                    @endfor

                    <button @disabled($page == $totalPages)
                        onclick="window.location.href='{{ url()->current() }}?page={{ $page + 1 }}'"
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded  {{ $page == $totalPages ? 'opacity-40 cursor-not-allowed' : 'hover:text-slate-100 hover:bg-slate-700 hover:border-slate-900 transition duration-200 ease' }} ">
                        Next
                    </button>

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
