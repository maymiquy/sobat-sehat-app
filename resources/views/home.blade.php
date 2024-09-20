<x-guest-layout>
    <div x-data="slider()" x-init="startAutoPlay()" class="relative mb-6 overflow-hidden">
        <div class="px-14 sm:px-48 py-6">
            <div class="relative h-56 md:h-[365px]" x-ref="slider">
                @foreach ($slideItems->take(3) as $index => $item)
                    <div x-show="activeSlide === {{ $index }}"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 transform translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full"
                        class="absolute top-0 left-0 w-full h-full">
                        <img src="{{ asset('assets/images/' . $item->image) }}" alt="Slide {{ $index + 1 }}"
                            class="object-cover object-top w-full h-full drop-shadow-xl rounded-md" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="absolute top-0 w-full h-full flex justify-between items-center px-4 sm:px-14">
            <button @click="prevSlide()"
                class="flex items-center justify-center p-0 cursor-pointer group focus:outline-none">
                <span
                    class="inline-flex items-center justify-center rounded-full p-4 bg-transparent group-hover:bg-white group-focus:outline-none hover:drop-shadow-lg text-gray-400 hover:text-gray-600 focus:text-gray-800">
                    <svg class="w-5 h-5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button @click="nextSlide()"
                class="flex items-center justify-center p-0 cursor-pointer group focus:outline-none">
                <span
                    class="inline-flex items-center justify-center rounded-full p-4 bg-transparent group-hover:bg-white group-focus:outline-none hover:drop-shadow-lg text-gray-400 hover:text-gray-600 focus:text-gray-800">
                    <svg class="w-5 h-5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </div>

    <div class="container mx-auto py-8 space-y-4 px-6">
        <div class="flex mx-auto items-center w-fit bg-white p-3 rounded-md drop-shadow-md">
            <h1 class="text-3xl">Informasi & Berita Kesehatan</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full px-4 md:px-12 gap-4">
            @foreach ($news as $newsItem)
                <x-card :image="asset('assets/images/' . $newsItem->image)" :title="$newsItem->title" :description="$newsItem->description" :created_at="$newsItem->created_at" :button_variant="__('Lihat')"
                    :url="route('home')" />
            @endforeach
        </div>

        <div class="px-4 md:px-24 pt-10">
            <div class="py-5 border-t border-gray-300 flex flex-col xs:flex-row items-center xs:justify-between">
                <div class="inline-flex items-center space-x-4 mt-2 xs:mt-0">
                    @if ($page > 1)
                        <a href="{{ url()->current() }}?page={{ $page - 1 }}"
                            class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:cursor-not-allowed disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                </svg>
                            </span>
                        </a>
                    @else
                        <button disabled
                            class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:cursor-not-allowed disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
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
                            class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:cursor-not-allowed disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                                </svg>
                            </span>
                        </a>
                    @else
                        <button disabled
                            class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:cursor-not-allowed disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
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
</x-guest-layout>


<script>
    function slider() {
        return {
            activeSlide: 0,
            totalSlides: {{ $slideItems->take(3)->count() }},
            autoPlayInterval: null,

            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                this.resetAutoPlay();
            },

            prevSlide() {
                this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
                this.resetAutoPlay();
            },

            startAutoPlay() {
                this.autoPlayInterval = setInterval(() => {
                    this.nextSlide();
                }, 5000);
            },

            resetAutoPlay() {
                clearInterval(this.autoPlayInterval);
                this.startAutoPlay();
            }
        }
    }
</script>
