<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="tambah-guru" data-modal-toggle="tambah-guru" type="submit"
        class="flex items-center justify-center focus:ring-4 font-medium rounded-lg text-sm px-4 py-2 text-white"
        style="background-color: #539165">
        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
        </svg>
        Tambah Data
    </button>
</div>

<!-- Main Modal -->
<div id="tambah-guru" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-7xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900">
                    Tambah Guru
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="tambah-guru">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="/admin/guru" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-4 gap-4">
                        <div>
                            <label for="initials" class="block text-sm font-medium text-gray-700">Initials</label>
                            <input type="text" name="initials" id="initials"
                                class="mt-1 p-2 border rounded-md w-full" required>
                        </div>


                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Guru</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="specialization"
                                class="block text-sm font-medium text-gray-700">Spesialisasi</label>
                            <input type="text" name="specialization" id="specialization"
                                class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo Guru</label>
                            <input type="file" name="photo" id="photo"
                                class="mt-1 p-2 border rounded-md w-full">
                        </div>

                        <div>
                            <label for="education" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                            <input type="text" name="education[]" class="mt-1 p-2 border rounded-md w-full">
                            <input type="text" name="education[]" class="mt-1 p-2 border rounded-md w-full">
                            <input type="text" name="education[]" class="mt-1 p-2 border rounded-md w-full">
                            <input type="text" name="education[]" class="mt-1 p-2 border rounded-md w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kemampuan Mengajar SD</label>
                            <!-- Checkbox untuk kemampuan mengajar SD -->
                            <div class="grid grid-cols-1 gap-4 mb-2">
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="Semua Pelajaran">
                                    Semua</label>
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="Matematika">
                                    Matematika</label>
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="IPA">
                                    IPA</label>
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="Sejarah">
                                    Sejarah</label>
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="Fisika">
                                    Fisika</label>
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="Bahasa Indonesia">
                                    Bahasa Indonesia</label>
                                <label><input type="checkbox" name="teachingAbility[SD][]" value="Bahasa Inggris">
                                    Bahasa Inggris</label>
                                <!-- Tambahkan checkbox untuk kemampuan mengajar lainnya di SD sesuai kebutuhan -->
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kemampuan Mengajar SMP</label>
                            <!-- Checkbox untuk kemampuan mengajar SMP -->
                            <div class="grid grid-cols-1 gap-4">
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Semua Pelajaran">
                                    Semua</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Matematika">
                                    Matematika</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="IPA">
                                    IPA</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Ekonomi">
                                    Ekonomi</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Akuntansi">
                                    Akuntansi</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Sejarah">
                                    Sejarah</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Fisika">
                                    Fisika</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Bahasa Indonesia">
                                    Bahasa Indonesia</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Sosiologi">
                                    Sosiologi</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Bahasa Inggris">
                                    Bahasa Inggris</label>
                                <label><input type="checkbox" name="teachingAbility[SMP][]" value="Biologi">
                                    Biologi</label>
                                <!-- Tambahkan checkbox untuk kemampuan mengajar lainnya di SMP sesuai kebutuhan -->
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kemampuan Mengajar SMA</label>
                            <!-- Checkbox untuk kemampuan mengajar SMA -->
                            <div class="grid grid-cols-1 gap-4 mb-8">
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Semua Pelajaran">
                                    Semua</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Matematika">
                                    Matematika</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="IPA">
                                    IPA</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Ekonomi">
                                    Ekonomi</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Akuntansi">
                                    Akuntansi</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Sejarah">
                                    Sejarah</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Fisika">
                                    Fisika</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Bahasa Indonesia">
                                    Bahasa Indonesia</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Sosiologi">
                                    Sosiologi</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Bahasa Inggris">
                                    Bahasa Inggris</label>
                                <label><input type="checkbox" name="teachingAbility[SMA][]" value="Biologi">
                                    Biologi</label>
                                <!-- Tambahkan checkbox untuk kemampuan mengajar lainnya di SMA sesuai kebutuhan -->
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-end justify-end pt-5 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit"
                            class="block w-full md:w-auto font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white"
                            style="background-color: #539165">Tambah
                            Data</button>
                    </div>
            </div>
        </div>
    </div>

    </form>
</div>

</div>
</div>
</div>
