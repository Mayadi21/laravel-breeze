<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Halo, ") }} {{ Auth::user()->name }}

                    
                    <div class="mt-6 overflow-x-auto">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Tabel Mahasiswa</h3>

                        {{-- button toggle modal --}}
                        <button onclick="toggleModal()" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" data-modal-toggle="defaultModal">
                            Tambah Mahasiswa
                        </button>

                    {{-- modal addMahasiswaModal --}}
                    <div id="addMahasiswaModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Tambah Mahasiswa</h2>
                            <form action="{{ route('mahasiswa.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                    <input type="text" name="nama" id="nama" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nama mahasiswa">
                                </div>
                                <div class="mb-4">
                                    <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                                    <input type="text" pattern='\d{9}' name="nim" id="nim" required  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan NIM mahasiswa (9 angka)">
                                </div>
                                <div class="flex items-center justify-end">
                                    <button type="button" onclick="toggleModal()" class="mr-2 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- end modal addMahasiswaModal --}}

                    {{-- script toggle modal --}}

                    <script>
                        function toggleModal() {
                            const modal = document.getElementById('addMahasiswaModal');
                            modal.classList.toggle('hidden');
                        }
                    </script>
                        {{-- table --}}
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($mahasiswa as $mhs)
                                    
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{$loop -> iteration}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{$mhs -> nama}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{$mhs -> nim}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 space-x-2">
                                        {{-- button edit --}}
                                        <button type="button" onclick="toggleEditModal()" class="text-blue-500 hover:text-blue-700 flex items-center space-x-1 text-sm inline-flex">
                                            <i class="bi bi-pencil-square text-lg"></i>
                                            <span>Edit</span>
                                        </button>

                                        {{-- modals edit --}}
                                        <div id="editMahasiswaModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Mahasiswa</h2>
                                                <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                                        <input type="text" name="nama" id="nama" value="{{$mhs->nama}}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nama mahasiswa">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                                                        <input type="text" pattern='\d{9}' name="nim" id="nim" value="{{$mhs->nim}}" required  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan NIM mahasiswa (9 angka)">
                                                    </div>
                                                    <div class="flex items-center justify-end">
                                                        <button type="button" onclick="toggleModal()" class="mr-2 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- end modals edit --}}
                                        {{-- script toggle modal edit --}}
                                        <script>
                                            function toggleEditModal() {
                                                const modal = document.getElementById('editMahasiswaModal');
                                                modal.classList.toggle('hidden');
                                            }
                                        </script>


                                        {{-- button delete --}}
                                        <button type="button" onclick="toggleDeleteModal({{ $mhs->id }})" class="text-red-500 hover:text-red-700 flex items-center space-x-1 text-sm inline-flex">
                                            <i class="bi bi-trash text-lg"></i>
                                            <span>Hapus</span>
                                        </button>
                                        {{-- modals delete confirmation --}}
                                        <div id="deleteConfirmationModal-{{ $mhs->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Konfirmasi Hapus</h2>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                                                <div class="flex items-center justify-end mt-4">
                                                    <button type="button" onclick="toggleDeleteModal({{ $mhs->id }})" class="mr-2 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end modals delete confirmation --}}
                                        <script>
                                            function toggleDeleteModal(id) {
                                                const modal = document.getElementById('deleteConfirmationModal-' + id);
                                                modal.classList.toggle('hidden');
                                            }
                                        </script>
                                    </td>

                                    
                                    

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    


                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':
    
                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
    
                    break;
                case 'warning':
    
                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
    
                    break;
                case 'error':
    
                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
    
                    break;
            }
        @endif
    </script>


</x-app-layout>
