<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="tambah-pembayaran" data-modal-toggle="tambah-pembayaran" type="submit"
        class="flex items-center justify-center focus:ring-4 font-medium rounded-lg text-sm px-4 py-2.5 mt-1 text-white"
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
<div id="tambah-pembayaran" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900">
                    Tambah pembayaran
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="tambah-pembayaran">
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
                <form action="/admin/pembayaran" method="POST">
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-4">
                        <div class="hidden">
                            <label for="payerId" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="payerId" id="payerId"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama..." readonly>
                        </div>
                        <div>
                            <label for="nisBlc" class="block mb-2 text-sm font-medium text-gray-900">NIS BLC</label>
                            <select name="nisBlc" id="nisBlc"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                                <option value="">Pilih NIS BLC...</option>
                            </select>
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama..." readonly>
                        </div>
                        {{-- <div>
                            <label for="blcClass" class="block mb-2 text-sm font-medium text-gray-900">Kelas BLC</label>
                            <input type="text" name="blcClass" id="blcClass"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama Kelas..." readonly>
                            <input type="text" name="blcClass2" id="blcClass2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama Kelas..." readonly>
                        </div> --}}

                        <div>
                            <label for="blcClass" class="block mb-2 text-sm font-medium text-gray-900">Kelas
                                BLC</label>
                            <select id="blcClass" name="blcClass"
                                class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Kelas Blc</option>
                            </select>
                        </div>
                        {{-- <div>
                            <label for="program" class="block mb-2 text-sm font-medium text-gray-900 ">Program</label>
                            <select id="program" name="program"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                required data-live-search="true">
                                <option value="" selected>Pilih Jenis Pembayaran</option>
                                @foreach (['Reguler', 'Privat'] as $programType)
                                    <option value="{{ $programType }}">
                                        {{ ucfirst($programType) }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div>
                            <label for="paymentType" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis
                                Pembayaran</label>
                            <select id="paymentType" name="paymentType"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                <option value="" selected>Pilih Jenis Pembayaran</option>
                                @foreach (['Reguler', 'Privat'] as $paymentType)
                                    <option value="{{ $paymentType }}">
                                        {{ ucfirst($paymentType) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="selectPeriode" class="hidden">
                            <label for="periode" class="block mb-2 text-sm font-medium text-gray-900 ">Periode</label>
                            <select id="periode" name="periode"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                <option value="" selected>Pilih Periode...</option>
                                @foreach (['Juni-Juli', 'Juli-Agustus', 'Agustus-September', 'September-Oktober', 'Oktober-November', 'November-Desember', 'Desember-Januari', 'Januari-Febuari', 'Febuari-Maret', 'Maret-April', 'April-Mei', 'Mei-Juni'] as $periode)
                                    <option value="{{ $periode }}">
                                        {{ ucfirst($periode) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 ">Nominal</label>
                            <input type="text" name="nominal" id="nominal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nominal nominal..." required>
                        </div>
                        <div>
                            <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 ">Discount</label>
                            <input type="text" name="discount" id="discount"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nominal Discount...">
                        </div>
                        <div>
                            <label for="payAmount" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah
                                Bayar</label>
                            <input type="text" name="payAmount" id="payAmount" {{-- value="{{ $item->data()['payAmount'] }}" --}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Jumlah Bayar..." required="">
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
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    var nominal = document.getElementById('nominal');
    nominal.addEventListener('keyup', function(e) {
        nominal.value = formatRupiah(this.value, '');
    });
    var discount = document.getElementById('discount');
    discount.addEventListener('keyup', function(e) {
        discount.value = formatRupiah(this.value, '');
    });
    var payAmount = document.getElementById('payAmount');
    payAmount.addEventListener('keyup', function(e) {
        payAmount.value = formatRupiah(this.value, '');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>

<script>
    $(document).ready(function() {
        // Menambahkan event listener untuk perubahan pada dropdown menggunakan jQuery
        $("#paymentType").on("change", function() {
            // Mendapatkan nilai pilihan saat ini
            const selectedValue = $(this).val();

            // Jika pilihannya "timeline", tampilkan input baru
            if (selectedValue === "Reguler") {
                $("#selectPeriode").show();
            } else {
                // Jika pilihannya "notimeline", sembunyikan input baru
                $("#selectPeriode").hide();
            }
        });

        // Buat fungsi untuk mengisi opsi-opsi nisBlc dari koleksi "users"
        function fillNisBlcOptions() {
            $.ajax({
                url: '/admin/get_nis_blc_options',
                method: 'get',
                success: function(data) {
                    console.log(data);
                    const selectElement = $('#nisBlc');

                    // Clear existing options
                    selectElement.empty();

                    // Add the first option as a placeholder
                    selectElement.append($('<option>', {
                        value: '',
                        text: 'Pilih NIS BLC...'
                    }));

                    // Add the options from the AJAX response
                    data.forEach((value) => {
                        selectElement.append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                },
                error: function() {
                    // Handle error if needed
                    console.error('Error fetching nisBlc options.');
                }
            });
        }

        // Call the function to populate options when the page loads
        $(document).ready(function() {
            fillNisBlcOptions();
        });

        // Panggil fungsi untuk mengisi opsi-opsi nisBlc saat halaman dimuat
        fillNisBlcOptions();

        // Tambahkan event 'change' pada select nisBlc
        $('#nisBlc').on('change', function() {
            const selectedNisBlc = $(this).val();
            if (selectedNisBlc) {
                // console.log(selectedNisBlc);
                // Lakukan permintaan AJAX untuk mendapatkan data siswa berdasarkan nisBlc yang dipilih
                $.ajax({
                    url: '/admin/get_student_by_nis_blc/' + selectedNisBlc,
                    method: 'get',
                    success: function(data) {
                        console.log(data);
                        // Isi kolom "name" dan "blcClass" dengan data siswa yang diperoleh
                        $('#payerId').val(data[0]);
                        $('#name').val(data[1]);
                        const selectElement = $('#blcClass');

                        // Clear existing options
                        selectElement.empty();

                        // Add the first option as a placeholder
                        selectElement.append($('<option>', {
                            value: '',
                            text: 'Pilih Kelas BLC...'
                        }));

                        // Add the options from the AJAX response
                        data[2].forEach((value) => {
                            selectElement.append($('<option>', {
                                value: value,
                                text: value
                            }));
                        });
                        // cek apakah kelas pertama tidak null

                        // if (data[1][0] != null) {
                        //     $('#blcClass').val(data[1][0]);
                        // }
                        // // cek apakah kelas kedua tidak null
                        // if (data[1][1] != null) {
                        //     $('#blcClass2').val(data[1][1]);
                        // }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error and display the error message if needed
                        console.error('Error fetching student data:', error);
                        // console.log(xhr.responseText); // Print the server's error response
                    }
                });

            } else {
                // Jika nisBlc tidak dipilih, kosongkan kolom "name" dan "blcClass"
                $('#name').val('');
                $('#blcClass').val('');
                $('#blcClass2').val('');
            }
        });
    });
</script>
