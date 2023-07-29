<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <button data-modal-target="detail-pembayaran{{$item->id}}" data-modal-toggle="detail-pembayaran{{$item->id}}" class="px-2 py-2" type="button">
        <box-icon type='solid' color='blue' name='detail'></box-icon>
    </button>

</div>

<!-- Main Modal -->
<div id="detail-pembayaran{{$item->id}}" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false" data-modal-backdrop="static" data-te-keyboard="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Detail Pembayaran
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-pembayaran{{$item->id}}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="edit">
            <div class="flex items-center justify-between rounded-t dark:border-gray-600">
                <p class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Invoice</p>
                <div class="flex justify-between">
                <p class="flex flex-row text-gray-500">Tanggal Pembuatan :</p>
                <p class="space-x-10 ml-2">{{$item->tgl_bayar}}</p>
                </div>
            </div>

            <div class="flex items-center pt-7 border-t rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500">Nama</p>
                <p class="flex ml-44 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->siswa->nama}}</p>
            </div>

            <div class="flex items-center pt-2 rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500 mr-1">NISN</p>
                <p class="flex ml-44 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->siswa->nisn}}</p>
            </div>

            <div class="flex items-center pt-2 rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500 mr-3.5">NIS</p>
                <p class="flex ml-44 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->siswa->nis}}</p>
            </div>

            <div class="flex items-center pt-2 rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500 mr-1">Kelas</p>
                <p class="flex ml-44 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2"> {{$item->siswa->kelas->nama_kelas}} - {{$item->siswa->kelas->kompetensi_keahlian}}</p>
            </div>

            <div class="flex items-center pt-7 rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500 mr-1">Petugas</p>
                <p class="flex ml-40 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->users->nama_petugas}}</p>
            </div>

            <div class="flex items-center py-2 rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500">Status</p>
                <p class="flex ml-44 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->status}}</p>
            </div>

            <div class="flex items-center py-7 rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500">Pembayaran Bulan</p>
                <p class="flex ml-24 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->bulan}}</p>
            </div>
            <div class="flex items-center py-7 border-t rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex text-gray-500">Nominal</p>
                <p class="flex ml-40 text-gray-500">:</p>
                </div>
                    <p class="space-x-10 ml-2">{{$item->spp->nominal_perbulan}}</p>
            </div>

            <div class="flex items-end py-7 border-t rounded-t dark:border-gray-600">
                <div class="flex flex-row">
                <p class="flex font-bold text-gray-500 ml-72">Jumlah Bayar</p>
                <p class="flex font-bold ml-32 text-gray-500">:</p>
                </div>
                    <p class=" font-bold space-x-10 ml-2">{{$item->jumlah_bayar}}</p>
            </div>

            {{-- Tombol Print --}}
{{-- <div class="flex items-end justify-end pt-5 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
    <button type="button"
        class="block w-full md:w-auto font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white bg-dwisa-400 hover:bg-dwisa-300 focus:ring-dwisa-300 dark:bg-dwisa-400 dark:hover:bg-dwisa-200 dark:focus:ring-dwisa-300"> --}}
{{-- <box-icon type='solid' color='white' name='printer'></box-icon> --}}
{{-- <a class="items-center" href="{{ 'invoicedetails/' . $item['id'] }}">Print</a>
    </button>
</div>
</form>
</div>
</div>
</div>
</div>
