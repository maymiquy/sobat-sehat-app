<?php
use App\Models\Event;

$itemsPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $itemsPage;
$events = Event::skip($start)
    ->take($itemsPage)
    ->get();
$total = Event::count();
$totalPages = ceil($total / $itemsPage);
?>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kegiatan') }}
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

                </div>
                <div class="flex p-2">
                    <a class="select-none max-w-fit rounded-lg bg-green-600 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        href="{{ route('events.create') }}">
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
                                    Nama Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Gambar
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Deskripsi Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jadwal Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Waktu Mulai Kegiatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Lokasi
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Author Event
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td
                                        class="px-2 py-5 border-b min-w-[200px] w-auto border-gray-200 bg-white overflow-hidden">
                                        <p class="text-gray-700 text-sm font-semibold whitespace-no-wrap">
                                            {{ $event->event_name }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-28 h-16">
                                                <img class="w-full h-full rounded"
                                                    src="assets/images/{{ $event->poster }}"
                                                    alt="{{ $event->event_name }}" />
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-2 py-5 border-b min-w-[200px] w-auto border-gray-200 bg-white overflow-hidden">
                                        <p class="text-gray-900 text-xs whitespace-no-wrap">
                                            {{ $event->description }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $event->event_date }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $event->event_time }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $event->location }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ App\Models\User::find($event->author)->name }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-4">
                                        <div class="flex flex-row space-x-4">
                                            <a href="{{ route('events.edit', $event->id) }}">
                                                <button
                                                    class="inline-block text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                                                    Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="text-sm bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded"
                                                    type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
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
