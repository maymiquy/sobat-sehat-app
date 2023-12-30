@php
    $news = App\Models\News::all();
@endphp

<x-guest-layout>
    <div class="container mx-auto py-8 space-y-4">
        <div class="flex mx-auto items-center w-fit bg-white p-3 rounded-md shadow-sm">
            <h1 class="text-3xl">Informasi & Berita Kesehatan</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full p-4 gap-4">
            @foreach ($news as $newsItem)
                <x-card :image="asset('assets/images/' . $newsItem->image)" :title="$newsItem->title" :description="$newsItem->description" :created_at="$newsItem->created_at" :button_variant="__('Lihat')"
                    :url="route('news.show', $newsItem->id)" />
            @endforeach
        </div>
    </div>

</x-guest-layout>
