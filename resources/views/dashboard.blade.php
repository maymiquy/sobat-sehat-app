<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 w-full flex justify-center items-center">
        <div class="max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-28 mx-auto">
            <x-card :title="__('Berita')" image="" description="" created_at="" :button_variant="__('manage')" :url="route('news.index')" />
            <x-card :title="__('Kegiatan')" image="" description="" created_at="" :button_variant="__('manage')" :url="route('events.index')" />
            <x-card :title="__('Peserta')" image="" description="" created_at="" :button_variant="__('manage')"
                :url="route('members.index')" />
        </div>
    </div>
</x-admin-layout>
