<?php
use App\Models\Member;

$itemsPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $itemsPage;
$news = Member::skip($start)
    ->take($itemsPage)
    ->get();
$total = Member::count();
$totalPages = ceil($total / $itemsPage);
?>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peserta') }}
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
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nomer Telepon
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Acara yang Di Ikuti
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->name }}</p>
                                    </td>
                                    <td
                                        class="px-2 py-5 border-b min-w-[200px] w-auto border-gray-200 bg-white overflow-hidden">
                                        <p class="text-gray-900 text-xs whitespace-no-wrap">
                                            {{ $member->email }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $member->phone_number }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ App\Models\Event::find($member->event_id)->event_name }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-4">
                                        <div class="flex flex-row space-x-4">
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST"
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
        </div>
    </div>
</x-admin-layout>
