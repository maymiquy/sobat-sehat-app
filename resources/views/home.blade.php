<?php
use App\Models\News;
$slideItems = News::whereIn('id', [1, 2, 4])->get();
$itemsPage = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $itemsPage;
$news = News::skip($start)
    ->take($itemsPage)
    ->get();
$total = News::count();
$totalPages = ceil($total / $itemsPage);
?>

<x-guest-layout>
    <div x-data="{ activeSlide: 0, autoPlay: true }" x-init="startSlideAutoPlay()" class="relative mb-6">
        <div class="overflow-hidden px-14 sm:px-48 py-6">
            <div class="carousel flex h-56 md:h-[365px]">
                @foreach ($slideItems->take(3) as $index => $item)
                    <div x-show="activeSlide === {{ $index }}" class="w-full"
                        x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-700"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <img src="{{ asset('assets/images/' . $item->image) }}" alt="Slide {{ $index + 1 }}"
                            class="object-cover object-top w-full h-full drop-shadow-xl rounded-md" />
                    </div>
                @endforeach
            </div>
        </div>
        <button @click="activeSlide = (activeSlide === 0) ? {{ $slideItems->take(3)->count() - 1 }} : activeSlide - 1"
            class="absolute top-0 start-40 z-10 py-6 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span
                class="inline-flex items-center justify-center w-10 h-full rounded-l-xl bg-neutral-100 group-hover:bg-white group-focus:outline-none hover:drop-shadow-lg text-gray-400 hover:text-gray-600 focus:text-gray-800">
                <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button @click="activeSlide = (activeSlide === {{ $slideItems->take(3)->count() - 1 }}) ? 0 : activeSlide + 1"
            class="absolute top-0 end-40 z-10 py-6 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span
                class="inline-flex items-center justify-center w-10 h-full rounded-r-xl bg-neutral-100 group-hover:bg-white group-focus:outline-none hover:drop-shadow-lg text-gray-400 hover:text-gray-600 focus:text-gray-800">
                <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <div class="container mx-auto py-8 space-y-4">
        <div class="flex mx-auto items-center w-fit bg-white p-3 rounded-md drop-shadow-md">
            <h1 class="text-3xl">Informasi & Berita Kesehatan</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full p-4 gap-4">
            @foreach ($news as $newsItem)
                <x-card :image="asset('assets/images/' . $newsItem->image)" :title="$newsItem->title" :description="$newsItem->description" :created_at="$newsItem->created_at" :button_variant="__('Lihat')"
                    :url="route('home')" />
            @endforeach
        </div>

        <div
            class="px-5 py-5 bg-white shadow-md border-t flex flex-col xs:flex-row rounded-md items-center xs:justify-between">
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
                        class="text-sm bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-l cursor-not-allowed"
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
                        class="text-sm bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-r cursor-not-allowed"
                        disabled>
                        Next
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
