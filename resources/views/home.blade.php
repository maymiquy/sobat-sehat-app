<?php
use App\Models\News;

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
    <div class="container mx-auto py-8 space-y-4">
        <div class="flex mx-auto items-center w-fit bg-white p-3 rounded-md shadow-sm">
            <h1 class="text-3xl">Informasi & Berita Kesehatan</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full p-4 gap-4">
            @foreach ($news as $newsItem)
                <x-card :image="asset('assets/images/' . $newsItem->image)" :title="$newsItem->title" :description="$newsItem->description" :created_at="$newsItem->created_at" :button_variant="__('Lihat')"
                    :url="route('home')" />
            @endforeach
        </div>

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
