<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="tambah-siswa" data-modal-toggle="tambah-siswa" type="submit"
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
<div id="tambah-siswa" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-6xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900">
                    Tambah Siswa
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="tambah-siswa">
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
                <form action="/admin/siswa" method="POST">
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-4">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email
                                Siswa</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Siswa..." required="">
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Siswa</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Siswa..." required="">
                        </div>
                        <div>
                            <label for="placeAndDateOfBirth"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Tempat, Tanggal
                                Lahir</label>
                            <input type="text" name="placeAndDateOfBirth" id="placeAndDateOfBirth"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Tempat, Tanggal Lahir..." required="">
                        </div>
                        <div>
                            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis
                                Kelamin</label>
                            <select id="gender" name="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                <option value="" selected>Select Gender</option>
                                @foreach (['laki-laki', 'perempuan'] as $gender)
                                    <option value="{{ $gender }}">
                                        {{ ucfirst($gender) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 ">Agama </label>
                            <select id="religion" name="religion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                <option value="" selected>Select Religion</option>
                                @foreach (['islam', 'kristen', 'budha', 'hindu'] as $religionOption)
                                    <option value="{{ $religionOption }}">
                                        {{ ucfirst($religionOption) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="childNumber" class="block mb-2 text-sm font-medium text-gray-900 ">Anak
                                Ke</label>
                            <input type="text" name="childNumber" id="childNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Anak Ke Berapa..." required="">
                        </div>
                        <div>
                            <label for="numberOfSiblings"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Dari</label>
                            <input type="text" name="numberOfSiblings" id="numberOfSiblings"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Berapa Bersudara..." required="">
                        </div>
                        <div>
                            <label for="class" class="block mb-2 text-sm font-medium text-gray-900 ">Kelas</label>
                            <input type="text" name="class" id="class"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Kelas..." required="">
                        </div>
                        <div>
                            <label for="school"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Sekolah</label>
                            <input type="text" name="school" id="school"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Sekolah Asal..." required="">
                        </div>
                        <div>
                            <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">No.
                                Handphone</label>
                            <input type="text" name="phoneNumber" id="phoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan No Telephone..." required="">
                        </div>
                        <div>
                            <label for="parentName" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Ayah/Ibu</label>
                            <input type="text" name="parentName" id="parentName"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Orang tua..." required="">
                        </div>
                        <div>
                            <label for="parentPhoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">No.
                                Handphone
                                Ayah/Ibu</label>
                            <input type="text" name="parentPhoneNumber" id="parentPhoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan No Orang tua..." required="">
                        </div>
                        <div>
                            <label for="parentJob" class="block mb-2 text-sm font-medium text-gray-900 ">Pekerjaan
                                Ayah/Ibu</label>
                            <input type="text" name="parentJob" id="parentJob"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Pekerjaan Orang tua..." required="">
                        </div>
                        <div>
                            <label for="homeAddress" class="block mb-2 text-sm font-medium text-gray-900 ">Alamat
                                Rumah</label>
                            <input type="text" name="homeAddress" id="homeAddress"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Alamat..." required="">
                        </div>
                        <div>
                            <label for="homePhoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">No.
                                Telepon
                                Rumah</label>
                            <input type="text" name="homePhoneNumber" id="homePhoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Telephone Rumah..." required="">
                        </div>
                        <div>
                            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 ">Mendapat info
                                BLC dari </label>
                            <select id="reference" name="reference"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                required data-live-search="true">
                                <option value="">Select Reference</option>
                                @foreach (['teman', 'guru', 'orangtua', 'brosur', 'pamflet', 'gedung'] as $referenceOption)
                                    <option value="{{ $referenceOption }}">
                                        {{ ucfirst($referenceOption) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="companyBranch"
                                class="block mb-2 text-sm font-medium text-gray-900">Cabang</label>
                            <select id="companyBranch" name="companyBranch"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Cabang</option>
                                @isset($cabang)
                                    @foreach ($cabang as $item)
                                        <option value="{{ $item->data()['name'] }}">{{ ucfirst($item->data()['name']) }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div>
                            <label for="blcClass" class="block mb-2 text-sm font-medium text-gray-900">Kelas
                                BLC</label>
                            <select id="blcClass" name="blcClass"
                                class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Kelas Blc</option>
                            </select>
                            <select id="blcClass2" name="blcClass2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Kelas Blc</option>
                            </select>
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

<script>
    $('#companyBranch').on('change', function() {
        const companyBranch = $(this).val();
        // console.log(companyBranch);
        // die;
        if (companyBranch) {
            $.ajax({
                url: '/admin/get_class/' + companyBranch,
                method: 'get',
                success: function(data) {
                    const selectElement = document.getElementById('blcClass');
                    const selectElement2 = document.getElementById('blcClass2');

                    // Simpan nilai placeholder yang dipilih sebelumnya
                    const selectedValue1 = selectElement.value;
                    const selectedValue2 = selectElement2.value;

                    // Bersihkan semua opsi dalam elemen select, kecuali elemen placeholder pertama
                    while (selectElement.options.length > 1) {
                        selectElement.remove(1);
                    }

                    while (selectElement2.options.length > 1) {
                        selectElement2.remove(1);
                    }

                    data.forEach((value) => {
                        console.log(value);
                        const option1 = document.createElement('option');
                        option1.value = value;
                        option1.textContent = value;
                        selectElement.appendChild(option1);

                        const option2 = document.createElement('option');
                        option2.value = value;
                        option2.textContent = value;
                        selectElement2.appendChild(option2);
                    });

                    // Set selected option untuk elemen blcClass
                    if (selectedValue1) {
                        const selectedOption1 = Array.from(selectElement.options).find((option) =>
                            option.value === selectedValue1);
                        if (selectedOption1) {
                            selectedOption1.setAttribute('selected', 'selected');
                        }
                    }

                    // Set selected option untuk elemen blcClass2
                    if (selectedValue2) {
                        const selectedOption2 = Array.from(selectElement2.options).find((option) =>
                            option.value === selectedValue2);
                        if (selectedOption2) {
                            selectedOption2.setAttribute('selected', 'selected');
                        }
                    }
                }
            });
        } else {
            $('#blcClass').val('');
            $('#blcClass2').val('');
        }
    });
</script>
