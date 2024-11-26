@extends('layouts.admin.template')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Kehadiran Piket 
        </h2>
            @role('admin')
                <button id="openModal" style="display: none;"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                        Absen Piket
                </button>
            @endrole
            @role('user')
                <button id="openModal"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                        Absen Piket
                </button>
            @endrole

            <!-- Modal -->
            <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="relative bg-white w-full max-w-4xl mx-auto p-6 rounded-lg shadow-lg overflow-auto max-h-screen">
                    <!-- Close Button -->
                    <button id="closeModal"
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                        &times;
                    </button>

                    <!-- Modal Header -->
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Absen Kehadiran Piket</h2>

                    <!-- Modal Content -->
                    <form method="POST" action="{{route('piket.store')}}" enctype="multipart/form-data">
                        @csrf

                        <!-- Data User -->
                        <div class="mb-4">
                            <p>
                            Hallo {{ Auth::user()->name }} absen sekarang!
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Jam Mulai</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    name="jam_mulai" placeholder="Jam Mulai" type="time"/>
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Jam Berakhir</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    name="jam_berakhir" placeholder="Jam Berakhir" type="time"/>
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Keterangan</span>
                                <textarea
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    name="keterangan" placeholder="Keterangan"></textarea>
                            </label>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-2">
                            <button type="button" id="cancelModal"
                                class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>

   <table class="w-full whitespace-no-wrap">
    <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Jam Mulai</th>
            <th class="px-4 py-3">Jam Berakhir</th>
            <th class="px-4 py-3">Keterangan</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach($piket as $data)
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">
                {{ $data->user->name }} <!-- Menampilkan nama user yang mengirimkan data piket -->
            </td>
            <td class="px-4 py-3 text-sm">
                {{$data->jam_mulai}}
            </td>
            <td class="px-4 py-3 text-sm">
                {{$data->jam_berakhir}}
            </td>
            <td class="px-4 py-3 text-sm">
                {{$data->keterangan}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    <!-- Script untuk Modal -->
    <script>
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const cancelModalButton = document.getElementById('cancelModal');

        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        cancelModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
@endsection
