@extends('layouts.admin.template')

@section('content')
    <h4 class="mb-4 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Edit Data Karyawan
    </h4>
    <form action="{{ route('karyawan.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="name" placeholder="Nama" value="{{ old('name', $user->name) }}" />
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="email" placeholder="Email" type="email" value="{{ old('email', $user->email) }}" />
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">NIK</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="nik" placeholder="Masukkan NIK" value="{{ old('nik', $user->karyawan->nik) }}" />
                @error('nik')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Sampul</span>
                @if ($user->karyawan->cover)
                    <img src="{{ asset('images/karyawan/' . $user->karyawan->cover) }}" alt="Sampul" width="100"
                        height="100">
                @endif
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="cover" type="file" />
                @error('cover')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Tempat Lahir</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="tempat_lahir" placeholder="Tempat Lahir"
                    value="{{ old('tempat_lahir', $user->karyawan->tempat_lahir) }}" />
                @error('tempat_lahir')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Tanggal Lahir</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="tgl_lahir" placeholder="Tanggal Lahir" type="date"
                    value="{{ old('tgl_lahir', $user->karyawan->tgl_lahir) }}" />
                @error('tgl_lahir')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Agama</span>
                <select
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="agama" id="agama">
                    <option value="" disabled class="text-gray-400">Pilih Agama Anda</option>
                    <option value="islam" {{ old('agama', $user->karyawan->agama) == 'islam' ? 'selected' : '' }}>Islam
                    </option>
                    <option value="kristen" {{ old('agama', $user->karyawan->agama) == 'kristen' ? 'selected' : '' }}>
                        Kristen</option>
                    <option value="katolik" {{ old('agama', $user->karyawan->agama) == 'katolik' ? 'selected' : '' }}>
                        Katolik</option>
                    <option value="hindu" {{ old('agama', $user->karyawan->agama) == 'hindu' ? 'selected' : '' }}>Hindu
                    </option>
                    <option value="budha" {{ old('agama', $user->karyawan->agama) == 'budha' ? 'selected' : '' }}>Budha
                    </option>
                </select>
                @error('agama')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                <textarea
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="3" name="alamat" placeholder="Masukkan Alamat">{{ old('alamat', $user->karyawan->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Jenis Kelamin</span>
                <select
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="jenis_kelamin" id="jenis_kelamin">
                    <option value="perempuan"
                        {{ old('jenis_kelamin', $user->karyawan->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                        Perempuan</option>
                    <option value="laki-laki"
                        {{ old('jenis_kelamin', $user->karyawan->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki</option>
                </select>
                @error('jenis_kelamin')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <div class="mt-6">
                <button type="submit"
                    class="w-full py-2 px-4 text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
@endsection
