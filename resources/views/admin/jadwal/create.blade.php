@extends('layouts.admin.template')

@section('content')
    <h4 class="mb-4 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Tambah Jadwal Piket
    </h4>

    <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama User</span>
                <select
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="id_user">
                    <option value="" disabled>Pilih User</option>
                    @foreach ($user as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Hari</span>
                <select
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="hari" required>
                    <option value="" disabled selected class="text-gray-400">Pilih Hari Piket</option>
                    <option value="senin" class="text-black">Senin</option>
                    <option value="selasa" class="text-black">Selasa</option>
                    <option value="rabu" class="text-black">Rabu</option>
                    <option value="kamis" class="text-black">Kamis</option>
                    <option value="jumat" class="text-black">Jumat</option>
                    <option value="sabtu" class="text-black">Sabtu</option>
                    <option value="minggu" class="text-black">Minggu</option>
                </select>
            </label>

            <label class="px-6 my-6">
                <button type="submit"
                    class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Simpan
                </button>
            </label>
        </div>
    </form>
@endsection
