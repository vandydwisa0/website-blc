<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="tambah-pembayaranpendaftaran" data-modal-toggle="tambah-pembayaranpendaftaran"
        type="submit"
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
<div id="tambah-pembayaranpendaftaran" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900">
                    Tambah pembayaranpendaftaran
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="tambah-pembayaranpendaftaran">
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
                <form action="/admin/pembayaranpendaftaran" method="POST">
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                pembayaranpendaftaran</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Nama Kelas..." required="">
                        </div>

                        <div>
                            <label for="paymentType" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis
                                Pembayaran</label>
                            <select id="paymentType" name="paymentType"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                <option value="" selected>Pilih Jenis Pembayaran</option>
                                @foreach (['perbulan', 'perhari'] as $paymentType)
                                    <option value="{{ $paymentType }}">
                                        {{ ucfirst($paymentType) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Biaya</label>
                            <input type="number" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Biaya..." required="">
                        </div>

                        <div>
                            <label for="meetingsPerWeek" class="block mb-2 text-sm font-medium text-gray-900 ">Jadwal
                                Pertemuan Perminggu</label>
                            <input type="number" name="meetingsPerWeek" id="meetingsPerWeek"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Jumlah Pertemuan Perminggu..." required="">
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
