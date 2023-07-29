<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="tambah-jadwal" data-modal-toggle="tambah-jadwal" type="submit"
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
<div id="tambah-jadwal" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900">
                    Tambah jadwal
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="tambah-jadwal">
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
                <form action="/admin/jadwal" method="POST">
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="blcClass" class="block mb-2 text-sm font-medium text-gray-900 ">Kelas</label>
                            <input type="text" name="blcClass" id="blcClass"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Kelas..." required="">
                        </div>
                        <div>
                            <label for="companyBranch"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Cabang</label>
                            <input type="text" name="companyBranch" id="companyBranch"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Cabang..." required="">
                        </div>
                        <div>
                            <label for="course" class="block mb-2 text-sm font-medium text-gray-900 ">Mata
                                Pelajaran</label>
                            <input type="text" name="course" id="course"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Mata Pelajaran..." required="">
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 ">Waktu</label>
                            <input type="text" name="date" id="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Tempat, Tanggal..." required="">
                        </div>
                        <div>
                            <label for="place" class="block mb-2 text-sm font-medium text-gray-900 ">Tempat</label>
                            <input type="text" name="place" id="place"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Tempat..." required="">
                        </div>
                        <div>
                            <label for="teachers" class="block mb-2 text-sm font-medium text-gray-900">Guru</label>
                            <select id="teachers" name="teachers"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                required>
                                <option value="" selected>Pilih seorang guru</option>
                            </select>
                        </div>
                        <div>
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900 ">Jam</label>
                            <input type="text" name="time" id="time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Jam..." required="">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-end justify-end pt-5 space-x-2 border-t border-gray-200 rounded-b ">
                        <button type="submit"
                            class="block w-full md:w-auto font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white"
                            style="background-color: #539165">Tambah
                            Data</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Script untuk mengisi data guru ke dalam elemen select -->
<script>
    // Mendapatkan referensi koleksi 'teachers' dari Firestore
    var teachersRef = firestore.collection('teachers');

    // Mendapatkan data guru dari Firestore
    teachersRef.get().then((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            var teacherName = doc.data()
                .name; // Pastikan 'name' sesuai dengan field yang berisi nama guru
            var optionElement = document.createElement("option");
            optionElement.text = teacherName;
            optionElement.value = teacherName;
            document.getElementById("guru").appendChild(optionElement);
        });
    }).catch((error) => {
        console.log("Error getting teachers: ", error);
    });
</script>
