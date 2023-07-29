<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <form action="/admin/pembayaranpendaftaran/{{ $item->id() }}/edit/" class="badge bg warning">
        @method('edit')
        @csrf
        <button data-modal-target="edit-pembayaranpendaftaran{{ $item->id() }}" id="button-edit"
            data-modal-toggle="edit-pembayaranpendaftaran{{ $item->id() }}" class="px-2 py-2" type="button">
            <box-icon type='solid' color="green" name='edit'></box-icon>
        </button>
    </form>


</div>

<!-- Main Modal -->
<div id="edit-pembayaranpendaftaran{{ $item->id() }}" tabindex="-1" data-modal-backdrop="static"
    data-te-keyboard="false" data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900 ">
                    Edit Pembayaran Pendaftaran
                </h3>
                <button type="button" onclick="reset()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                    data-modal-hide="edit-pembayaranpendaftaran{{ $item->id() }}">
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
                <form action="/admin/pembayaranpendaftaran/{{ $item->id() }}" id="edit" method="POST">
                    @method('put')
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="payerName" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Pembayar</label>
                            <input type="text" name="payerName" id="payerName"
                                value="{{ $item->data()['payerName'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Pembayar..." readonly>
                        </div>
                        <div>
                            <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 ">Nominal Yang
                                Harus Dibayar</label>
                            <input type="number" name="nominal" id="nominal" value="{{ $item->data()['nominal'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Nominal..." readonly>
                        </div>
                        <div>
                            <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 ">Discount</label>
                            <input type="number" name="discount" id="discount" value="{{ $item->data()['discount'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nominal Discount...">
                        </div>
                        <div>
                            <label for="payAmount" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah
                                Bayar</label>
                            <input type="number" name="payAmount" id="payAmount"
                                value="{{ $item->data()['payAmount'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Jumlah Bayar..." required="">
                        </div>
                        <div>
                            <label for="paymentType" class="block mb-2 text-sm font-medium text-gray-900 ">Status
                                Pembayaran</label>
                            <select id="paymentType" name="paymentType"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                @foreach (['Lunas', 'Belum Lunas'] as $paymentType)
                                    <option value="{{ $paymentType }}"
                                        {{ $item->data()['paymentType'] === $paymentType ? 'selected' : '' }}>
                                        {{ ucfirst($paymentType) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-end justify-end pt-5 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit"
                            class="block w-full md:w-auto font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white "
                            style="background-color: #539165">Simpan
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
</script>
