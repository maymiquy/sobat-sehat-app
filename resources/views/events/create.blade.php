<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post kegiatan baru') }}
        </h2>
    </x-slot>


    <div class="flex justify-center items-center py-6">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl text-gray-800 text-center font-bold mb-6">Post Kegiatan</h1>
            <form enctype="multipart/form-data" method="POST" action="{{ route('events.store') }}">
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
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span id="file-name" class="ml-2 text-sm text-gray-400">Choose or drop images file</span>
                        </div>
                        <span class="text-sm text-gray-500">Max size: 3MB</span>
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
                        placeholder="Durasi kegiatan...">
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
    </div>
</x-admin-layout>
