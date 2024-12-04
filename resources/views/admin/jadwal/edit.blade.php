@extends('layouts.admin.template')

@section('content')
    <h4 class="mb-4 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Edit Jadwal
    </h4>
    <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}">
        @csrf
        @method('PUT')

        <select name="id_user">
            @foreach ($user as $data)
                <option value="{{ $data->id }}" @if ($data->id == $jadwal->id_user) selected @endif>
                    {{ $data->name }}
                </option>
            @endforeach
        </select>

        <select name="hari">
            <option value="senin" @if ($jadwal->hari == 'senin') selected @endif>Senin</option>
            <option value="selasa" @if ($jadwal->hari == 'selasa') selected @endif>Selasa</option>
            <option value="rabu" @if ($jadwal->hari == 'rabu') selected @endif>Rabu</option>
            <option value="kamis" @if ($jadwal->hari == 'kamis') selected @endif>Kamis</option>
            <option value="jumat" @if ($jadwal->hari == 'jumat') selected @endif>Jumat</option>
            <option value="sabtu" @if ($jadwal->hari == 'sabtu') selected @endif>Sabtu</option>
            <option value="minggu" @if ($jadwal->hari == 'minggu') selected @endif>Minggu</option>
        </select>

        <button type="submit">Update Jadwal</button>
    </form>
@endsection
