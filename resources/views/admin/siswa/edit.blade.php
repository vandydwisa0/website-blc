<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <form action="/admin/siswa/{{ $item->id() }}/edit/" class="badge bg warning">
        @method('edit')
        @csrf
        <button data-modal-target="edit-siswa{{ $item->id() }}" id="button-edit"
            data-modal-toggle="edit-siswa{{ $item->id() }}" class="px-2 py-2" type="button">
            <box-icon type='solid' color="green" name='edit'></box-icon>
        </button>
    </form>


</div>

<!-- Main Modal -->
<div id="edit-siswa{{ $item->id() }}" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-6xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900 ">
                    Edit siswa
                </h3>
                <button type="button" onclick="reset()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                    data-modal-hide="edit-siswa{{ $item->id() }}">
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
                <form action="/admin/siswa/{{ $item->id() }}" id="edit" method="POST">
                    @method('put')
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Siswa</label>
                            <input type="text" name="name" id="name" value="{{ $item->data()['name'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Siswa..." required="">
                        </div>
                        <div>
                            <label for="placeAndDateOfBirth"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Tempat, Tanggal
                                Lahir</label>
                            <input type="text" name="placeAndDateOfBirth" id="placeAndDateOfBirth"
                                value="{{ $item->data()['placeAndDateOfBirth'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Tempat, Tanggal Lahir..." required="">
                        </div>
                        <div>
                            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>
                            <select id="gender" name="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                @foreach (['laki-laki', 'perempuan'] as $gender)
                                    <option value="{{ $gender }}"
                                        {{ $gender == $item->data()['gender'] ? 'selected' : '' }}>
                                        {{ ucfirst($gender) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 ">Agama</label>
                            <select id="religion" name="religion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                @foreach (['islam', 'kristen', 'budha', 'hindu'] as $religionOption)
                                    <option value="{{ $religionOption }}"
                                        {{ $religionOption == $item->data()['religion'] ? 'selected' : '' }}>
                                        {{ ucfirst($religionOption) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="childNumber" class="block mb-2 text-sm font-medium text-gray-900">Dari</label>
                            <input type="text" name="childNumber" id="childNumber"
                                value="{{ isset($item->data()['child']['childNumber']) ? $item->data()['child']['childNumber'] : '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Berapa Bersaudara..." required="">
                        </div>
                        <div>
                            <label for="numberOfSiblings"
                                class="block mb-2 text-sm font-medium text-gray-900">Dari</label>
                            <input type="text" name="numberOfSiblings" id="numberOfSiblings"
                                value="{{ isset($item->data()['child']['numberOfSiblings']) ? $item->data()['child']['numberOfSiblings'] : '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Berapa Bersaudara..." required="">
                        </div>


                        <div>
                            <label for="class" class="block mb-2 text-sm font-medium text-gray-900 ">Kelas</label>
                            <input type="text" name="class" id="class" value="{{ $item->data()['class'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Kelas..." required="">
                        </div>
                        <div>
                            <label for="school" class="block mb-2 text-sm font-medium text-gray-900 ">Sekolah</label>
                            <input type="text" name="school" id="school"
                                value="{{ $item->data()['school'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Sekolah Asal..." required="">
                        </div>
                        <div>
                            <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">No.
                                Handphone</label>
                            <input type="text" name="phoneNumber" id="phoneNumber"
                                value="{{ $item->data()['phoneNumber'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan No Telephone..." required="">
                        </div>
                        <div>
                            <label for="parentName" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Ayah/Ibu</label>
                            <input type="text" name="parentName" id="parentName"
                                value="{{ $item->data()['name'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Orang tua..." required="">
                        </div>
                        <div>
                            <label for="parentPhoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">No.
                                Handphone
                                Ayah/Ibu</label>
                            <input type="text" name="parentPhoneNumber" id="parentPhoneNumber"
                                value="{{ $item->data()['parentPhoneNumber'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan No Orang tua..." required="">
                        </div>
                        <div>
                            <label for="parentJob" class="block mb-2 text-sm font-medium text-gray-900 ">Pekerjaan
                                Ayah/Ibu</label>
                            <input type="text" name="parentJob" id="parentJob"
                                value="{{ $item->data()['parentJob'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Pekerjaan Orang tua..." required="">
                        </div>

                        <div>
                            <label for="homeAddress" class="block mb-2 text-sm font-medium text-gray-900 ">Alamat
                                Rumah</label>
                            <input type="text" name="homeAddress" id="homeAddress"
                                value="{{ $item->data()['homeAddress'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Alamat..." required="">
                        </div>
                        <div>
                            <label for="homePhoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">No.
                                Telepon
                                Rumah</label>
                            <input type="text" name="homePhoneNumber" id="homePhoneNumber"
                                value="{{ $item->data()['homePhoneNumber'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Telephone Rumah..." required="">
                        </div>
                        <div>
                            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900">Mendapat
                                Informasi BLC Dari</label>
                            <select id="reference" name="reference"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                required data-live-search="true">
                                @foreach (['teman', 'guru', 'orangtua', 'brosur', 'pamflet', 'gedung'] as $referenceOption)
                                    <option value="{{ $referenceOption }}"
                                        {{ $referenceOption == $item->data()['reference'] ? 'selected' : '' }}>
                                        {{ ucfirst($referenceOption) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="companyBranch"
                                class="block mb-2 text-sm font-medium text-gray-900">Cabang</label>
                            <select id="companyBranchs" name="companyBranch"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Cabang</option>
                                @isset($cabang)
                                    @foreach ($cabang as $items)
                                        <option value="{{ $items->data()['name'] }}"
                                            {{ $items->data()['name'] == $item->data()['companyBranch'] ? 'selected' : '' }}>
                                            {{ ucfirst($items->data()['name']) }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div>
                            <label for="blcClass" class="block mb-2 text-sm font-medium text-gray-900">Kelas
                                BLC</label>
                            <select id="blcClasses" name="blcClass"
                                class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

                                <option value="{{ $item->data()['blcClass'][0] }}" selected>Select Kelas Blc
                                </option>
                                @isset($kelas)
                                    @foreach ($kelas as $items)
                                        <option value="{{ $items->data()['className'] }}"
                                            {{ $items->data()['className'] == $item->data()['blcClass'][0] ? 'selected' : '' }}>
                                            {{ ucfirst($items->data()['className']) }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            <select id="blcClasses" name="blcClass2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option
                                    value="{{ isset($item->data()['blcClass'][1]) ? $item->data()['blcClass'][1] : '' }}"
                                    selected>Select Kelas Blc
                                </option>
                                @isset($kelas)
                                    @foreach ($kelas as $items)
                                        <option value="{{ $items->data()['className'] }}"
                                            {{ ($items->data()['className'] == isset($item->data()['blcClass'][1]) ? $item->data()['blcClass'][1] : '') ? 'selected' : '' }}>
                                            {{ ucfirst($items->data()['className']) }}
                                        </option>
                                    @endforeach
                                @endisset
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
    function reset() {
        document.getElementById('edit').reset()
    }
    // Fungsi AJAX untuk mengisi opsi-opsi di blcClasses berdasarkan companyBranch yang dipilih
    function populateBlcClasses(companyBranch) {
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
    }

    // Panggil fungsi AJAX saat halaman dimuat kembali
    $(document).ready(function() {
        const companyBranch = $('#companyBranchs').val();
        populateBlcClasses(companyBranch);
    });

    // Panggil fungsi AJAX saat select companyBranch berubah
    $('#companyBranchs').on('change', function() {
        const companyBranch = $(this).val();
        populateBlcClasses(companyBranch);
    });
</script>
