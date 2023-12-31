<?php
use App\Models\News;

$itemsPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $itemsPage;
$news = News::skip($start)
    ->take($itemsPage)
    ->get();
$total = News::count();
$totalPages = ceil($total / $itemsPage);
?>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita') }}
        </h2>
    </x-slot>

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
            <div class="flex flex-row justify-between">
                <div class="my-2 flex sm:flex-row flex-col">
                    <div class="block relative">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 300 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <input placeholder="Search"
                            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
                </div>
                <div class="flex p-2">
                    <a class="select-none max-w-fit rounded-lg bg-green-600 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        href="{{ route('news.create') }}">
                        Tambah
                    </a>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Gambar
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Post
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Update Post
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $newsItem)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $newsItem->title }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-16 h-16">
                                                <img class="w-full h-full rounded"
                                                    src="assets/images/{{ $newsItem->image }}"
                                                    alt="{{ $newsItem->title }}" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white w-60 overflow-hidden">
                                        <p class="text-gray-900 text-xs whitespace-no-wrap">
                                            {{ $newsItem->description }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $newsItem->created_at }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $newsItem->updated_at }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-4">
                                        <a href="{{ route('news.edit', $newsItem->id) }}">
                                            <button
                                                class="inline-block text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                                                Edit
                                            </button>
                                        </a>
                                        <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="text-sm bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded"
                                                type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing {{ $page }} of {{ $totalPages }} pages
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            @if ($page > 1)
                                <a href="{{ url()->current() }}?page={{ $page - 1 }}"
                                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                    Prev
                                </a>
                            @else
                                <button
                                    class="text-sm bg-gray-200 text-gray-400 font-semibold py-2 px-4 rounded-l cursor-not-allowed"
                                    disabled>
                                    Prev
                                </button>
                            @endif
                            @if ($page < $totalPages)
                                <a href="{{ url()->current() }}?page={{ $page + 1 }}"
                                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                    Next
                                </a>
                            @else
                                <button
                                    class="text-sm bg-gray-200 text-gray-400 font-semibold py-2 px-4 rounded-r cursor-not-allowed"
                                    disabled>
                                    Next
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
