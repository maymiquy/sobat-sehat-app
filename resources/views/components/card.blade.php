@props(['title', 'image', 'description', 'created_at', 'button_variant', 'url'])

<div class="relative flex flex-col max-w-md rounded-md bg-white bg-clip-border text-gray-700 shadow-md pb-4">
    @empty($image)
        <div class="relative h-10 w-56 overflow-hidden rounded-t-md bg-blue-gray-500 bg-clip-border text-white">
            <img src="{{ $image }}" alt="img" layout="fill" class="hidden" />
        </div>
    @else
        <div class="relative h-56 overflow-hidden rounded-t-md bg-blue-gray-500 bg-clip-border">
            <img src="{{ $image }}" alt="img" class="object-cover w-full h-full" />
        </div>
    @endempty
    <div class="p-4">
        @if (Route::currentRouteName() === 'dashboard')
            <h5
                class="mb-2 block font-sans text-center text-4xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                {{ $title }}
            </h5>
        @else
            <h5
                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased overflow-hidden text-ellipsis text-justify whitespace-nowrap">
                {{ $title }}
            </h5>
        @endif
        @empty($description)
            <p class="hidden font-sans text-base font-light leading-relaxed text-inherit antialiased">
                {{ $description }}
            </p>
        @else
            <div class="block font-sans text-xs font-light leading-relaxed text-inherit antialiased">
                <p class="line-clamp-3 text-justify">
                    {{ $description }}
                </p>
            </div>
        @endempty
    </div>
    @empty($created_at)
        <div class="w-full flex p-2">
            <a class="select-none w-full rounded-lg bg-blue-500 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                href="{{ $url }}">
                {{ $button_variant }}
            </a>
        </div>
    @else
        <div class="flex flex-row-reverse justify-between items-center p-4 gap-6">
            <div class="flex justify-end overflow-hidden space-x-6">
                <span
                    class="inline-block bg-gray-200 w-fit overflow-hidden rounded-full mx-4 px-2 py-1 text-xs font-semibold text-gray-700">
                    {{ $created_at }}
                </span>
            </div>
            <div class="">
                <a class="select-none rounded-lg bg-blue-500 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    href="{{ $url }}">
                    {{ $button_variant }}
                </a>
            </div>
        </div>
    @endempty
</div>
