@extends('layouts.admin.template')

@section('content')
    <main class="h-full overflow-y-auto">
        @role('admin')
            <div class="container px-6 mx-auto grid">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Selamat Datang di Dashboard Admin
                </h2>
                <!-- Cards -->
                {{-- <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4"> --}}
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
                {{-- </div> --}}

                <!-- New Table -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">Tugas</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($piket as $data)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            {{$no++}}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{$data->keterangan}}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{$data->created_at}}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            6/10/2020
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endrole

        {{-- @role('user')
        <div class="bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800 mt-4">
        <!-- Wrapper untuk membuat tabel scrollable -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <!-- Header tabel -->
                <thead>
                    <tr>
                        <th colspan="2"
                            class="px-6 py-4 text-lg font-semibold text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            Detail Karyawan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Nama</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Email</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">NIK</td>
                        <td class="px-6 py-4">{{ $user->karyawan->nik }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Sampul</td>
                        <td class="px-6 py-4">
                            @if ($user->karyawan->cover)
                                <img src="{{ asset('images/karyawan/' . $user->karyawan->cover) }}" alt="Sampul"
                                    class="w-24 h-30">
                            @else
                                <span class="text-gray-500">No image available</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Tempat Lahir</td>
                        <td class="px-6 py-4">{{ $user->karyawan->tempat_lahir }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Tanggal Lahir</td>
                        <td class="px-6 py-4">{{ $user->karyawan->tgl_lahir }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Agama</td>
                        <td class="px-6 py-4">{{ $user->karyawan->agama }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Alamat</td>
                        <td class="px-6 py-4">{{ $user->karyawan->alamat }}</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">Jenis Kelamin</td>
                        <td class="px-6 py-4">{{ $user->karyawan->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-400">No Telepon</td>
                        <td class="px-6 py-4">{{ $user->karyawan->no_telp }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ route('karyawan.index') }}"
            class="inline-block px-6 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">
            Kembali
        </a>
    </div>
    @endrole --}}

    </main>
@endsection
