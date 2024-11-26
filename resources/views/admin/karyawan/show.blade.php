@extends('layouts.admin.template')

@section('content')
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
@endsection
