<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <form action="/admin/pembayaran/{{ $item->id() }}/edit/" class="badge bg warning">
        @method('edit')
        @csrf
        <button data-modal-target="edit-pembayaran{{ $item->id() }}" id="button-edit"
            data-modal-toggle="edit-pembayaran{{ $item->id() }}" class="px-2 py-2" type="button">
            <box-icon type='solid' color="green" name='edit'></box-icon>
        </button>
    </form>


</div>

<!-- Main Modal -->
<div id="edit-pembayaran{{ $item->id() }}" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900 ">
                    Edit Pembayaran
                </h3>
                <button type="button" onclick="reset()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                    data-modal-hide="edit-pembayaran{{ $item->id() }}">
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
                <form action="/admin/pembayaran/{{ $item->id() }}" id="edit" method="POST">
                    @method('put')
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-4">
                        <div>
                            <label for="nisBlc" class="block mb-2 text-sm font-medium text-gray-900">NIS BLC</label>
                            <input type="text" name="nisBlc" id="nisBlc" value="{{ $item->data()['nisBlc'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama..." readonly>
                        </div>
                        <div>
                            <label for="payerName" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="payerName" id="payerName"
                                value="{{ $item->data()['payerName'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama..." readonly>
                        </div>
                        <div>
                            <label for="blcClass" class="block mb-2 text-sm font-medium text-gray-900">Kelas BLC</label>
                            <input type="text" name="blcClass" id="blcClass" value="{{ $item->data()['blcClass'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Masukan Nama Kelas..." readonly>
                        </div>
                        <div>
                            <label for="paymentType" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis
                                Pembayaran</label>
                            <select id="paymentType" name="paymentType"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                <option value="" selected>Pilih Jenis Pembayaran</option>
                                @foreach (['Reguler', 'Privat'] as $paymentType)
                                    <option value="{{ $paymentType }}"
                                        {{ $paymentType == $item->data()['paymentType'] ? 'selected' : '' }}>
                                        {{ ucfirst($paymentType) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($item['paymentType'] === 'Reguler')
                            <div id="selectPeriode">
                                <label for="periode"
                                    class="block mb-2 text-sm font-medium text-gray-900">Periode</label>
                                <select id="periode" name="periode"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option value="" selected>Pilih Periode...</option>
                                    @foreach (['Juni-Juli', 'Juli-Agustus', 'Agustus-September', 'September-Oktober', 'Oktober-November', 'November-Desember', 'Desember-Januari', 'Januari-Februari', 'Februari-Maret', 'Maret-April', 'April-Mei', 'Mei-Juni'] as $periode)
                                        <option value="{{ $periode }}"
                                            {{ $periode == $item->data()['periode'] ? 'selected' : '' }}>
                                            {{ ucfirst($periode) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div>
                            <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 ">Nominal Yang
                                Harus Dibayar</label>
                            <input type="text" name="nominal" id="nominal" value="{{ $item->data()['nominal'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Nominal..." readonly>
                        </div>
                        <div>
                            <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 ">Discount</label>
                            <input type="text" name="discount" id="discount"
                                value="{{ $item->data()['discount'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nominal Discount...">
                        </div>
                        <div>
                            <label for="payAmount" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah
                                Bayar</label>
                            <input type="text" name="payAmount" id="payAmount"
                                value="{{ $item->data()['payAmount'] }}"
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
<script>
    function reset() {
        document.getElementById('edit').reset()
    }

    // Get the initial values from the input fields
    var initialNominalValue = document.getElementById('nominal').value;
    var initialDiscountValue = document.getElementById('discount').value;
    var initialPayAmountValue = document.getElementById('payAmount').value;

    // Format and set the initial values back to the input fields
    document.getElementById('nominal').value = formatRupiah(initialNominalValue);
    document.getElementById('discount').value = formatRupiah(initialDiscountValue);
    document.getElementById('payAmount').value = formatRupiah(initialPayAmountValue);


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk memperbarui tampilan berdasarkan nilai dropdown
        function updateSelectPeriodeVisibility() {
            const selectedValue = $("#paymentType").val();

            if (selectedValue === "Reguler") {
                $("#selectPeriode").removeClass("hidden");
            } else {
                $("#selectPeriode").addClass("hidden");
            }
        }
        console.log("PaymentType:", $("#paymentType").val());
        // Panggil fungsi untuk pertama kali saat halaman dimuat
        updateSelectPeriodeVisibility();

        // Menambahkan event listener untuk perubahan pada dropdown menggunakan jQuery
        $("#paymentType").on("change", function() {
            // Panggil fungsi untuk memperbarui tampilan berdasarkan nilai dropdown
            updateSelectPeriodeVisibility();
        });
    });
</script>
