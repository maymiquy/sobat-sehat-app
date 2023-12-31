<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center py-6">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl text-gray-800 text-center font-bold mb-6">Edit Berita</h1>
            <form enctype="multipart/form-data" method="POST" action="{{ route('news.update', $news->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul :</label>
                    <input type="text" id="title" name="title"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Ubah judul: {{ $news->title }}">
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Konten :</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full border-2 border-gray-400 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                        placeholder="Ubah konten: {{ $news->description }}"></textarea>
                </div>
                <!-- File Attachment Section -->
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image :</label>
                    <div
                        class="relative border-2 border-gray-400 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                        <input type="file" id="image" name="image"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-500">Max size: 3MB</span>
                    </div>
                </div>
                <!-- Submit Button and Character Limit Section -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                        Save
                        <svg xmlns="http://www.w3.org/2000/svg" height="17" width="17" id="save"
                            fill="#fff" viewBox="0 0 448 512">
                            <path
                                d="M433.9 129.9l-83.9-83.9A48 48 0 0 0 316.1 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V163.9a48 48 0 0 0 -14.1-33.9zM224 416c-35.3 0-64-28.7-64-64 0-35.3 28.7-64 64-64s64 28.7 64 64c0 35.3-28.7 64-64 64zm96-304.5V212c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12V108c0-6.6 5.4-12 12-12h228.5c3.2 0 6.2 1.3 8.5 3.5l3.5 3.5A12 12 0 0 1 320 111.5z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
