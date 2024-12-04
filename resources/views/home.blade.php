@extends('layouts.admin.template')

@section('content')
    <main class="h-full overflow-y-auto">
        @role('admin')
            <div class="container  mx-auto grid">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Selamat Datang di Dashboard Admin
                </h2>

                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 mb-8">
                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-lg font-medium text-gray-600 dark:text-gray-400">
                            Total Karyawan
                        </p>
                        <p class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ $totalUsers }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-4">
                <div class="flex justify-end">
                    <form action="{{ route('home') }}" method="GET" class="flex items-center space-x-2">
                        <label for="tanggal" class="text-sm font-semibold">Filter Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ request()->get('tanggal') }}"
                            class="px-4 py-2 border rounded">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Cari</button>
                    </form>
                </div>

                @if ($piket->isEmpty())
                    <div class="flex flex-col items-center mt-8">
                        <img src="{{ asset('images/1.png') }}" alt="Bingung" class="w-64 h-64 object-cover mb-4">
                        <p class="text-lg font-semibold text-gray-600 text-center">
                            Data tidak ditemukan untuk tanggal
                            {{ \Carbon\Carbon::parse(request()->get('tanggal'))->format('d-m-Y') ?? 'terpilih' }}.
                        </p>
                    </div>
                @else
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">No</th>
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Jam Mulai</th>
                                        <th class="px-4 py-3">Jam Berakhir</th>
                                        <th class="px-4 py-3">Keterangan</th>
                                        <th class="px-4 py-3">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @php $no = ($piket->currentPage() - 1) * $piket->perPage() + 1; @endphp
                                    @foreach ($piket as $data)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">{{ $no++ }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $data->user->name }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $data->jam_mulai }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $data->jam_berakhir }}</td>
                                            <td class="truncate max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap">
                                                {{ $data->keterangan }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $data->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                {{ $piket->links() }}
            </div>
        @endrole

        @role('user')
            <div class="container mx-auto mt-8">
                <div class="card mt-3 max-w-7xl mx-auto">
                    <div class="card-header flex justify-between bg-gray-200 p-2 rounded-t-lg">
                        <p class="text-lg font-semibold">Profile Anda</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-wrap lg:flex-nowrap">
                        <div class="w-full lg:w-1/3 flex flex-col items-center mb-6 lg:mb-0">
                            <img class="w-48 h-48 rounded-full mb-4"
                                src="{{ asset('images/karyawan/' . $user->karyawan->cover) }}" alt="#">
                            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            <p class="text-sm text-gray-600">{{ $user->karyawan->no_telp }}</p>
                        </div>
                        <div class="hidden lg:block border-l border-gray-200 mx-6"></div>

                        <div class="w-full lg:w-2/3">
                            <div class="space-y-6">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">NIK</span>
                                    <span class="text-gray-600">{{ $user->karyawan->nik }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">Jenis Kelamin</span>
                                    <span class="text-gray-600">{{ $user->karyawan->jenis_kelamin }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">Alamat</span>
                                    <span class="text-gray-600">{{ $user->karyawan->alamat }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">Tempat Lahir</span>
                                    <span class="text-gray-600">{{ $user->karyawan->tempat_lahir }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">Tanggal Lahir</span>
                                    <span class="text-gray-600">
                                        {{ \Carbon\Carbon::parse($user->karyawan->tgl_lahir)->format('d-m-Y') }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">Agama</span>
                                    <span class="text-gray-600">{{ $user->karyawan->agama }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HISTORY --}}
            <div class="flex justify-end mt-10">
                <form action="{{ route('home') }}" method="GET" class="flex items-center space-x-2">
                    <label for="tanggal" class="text-sm font-semibold">Filter Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ request()->get('tanggal') }}"
                        class="px-4 py-2 border rounded">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Cari</button>
                </form>
            </div>

            @if ($piket->isEmpty())
                <div class="flex flex-col items-center mt-8">
                    <img src="{{ asset('images/1.png') }}" alt="Bingung" class="w-64 h-64 object-cover mb-4">
                    <p class="text-lg font-semibold text-gray-600 text-center">
                        Data tidak ditemukan untuk tanggal
                        {{ \Carbon\Carbon::parse(request()->get('tanggal'))->format('d-m-Y') ?? 'terpilih' }}.
                    </p>
                </div>
            @else
                <table class="w-full whitespace-no-wrap mt-8">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Jam Mulai</th>
                            <th class="px-4 py-3">Jam Berakhir</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($piket as $data)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $data->user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $data->jam_mulai }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $data->jam_berakhir }}
                                </td>
                                <td class="truncate max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $data->keterangan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $data->created_at->format('d-m-Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $piket->links() }}
                </div>
            @endif
        @endrole

    </main>
@endsection
