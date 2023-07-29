<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <button data-modal-target="show-users{{ $item->id() }}" data-modal-toggle="show-users{{ $item->id() }}"
        class="px-2 py-2" type="button">
        <box-icon type='solid' color='blue' name='detail'></box-icon>
    </button>

</div>

<!-- Main modal -->
<div id="show-users{{ $item->id() }}" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                <div class="text-lg text-gray-900 md:text-xl ">
                    <p class="font-bold">
                        Detail Staff
                    </p>
                </div>
                <div>
                    <button type="button" onclick="reset()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                        data-modal-hide="show-users{{ $item->id() }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="space-y-6 border-t">
                <form id="show">
                    <div class="flex items-center pt-2  rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-2.5">NIK</p>
                            <p class="flex ml-44 text-gray-500 ">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>

                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-1.5">NIP</p>
                            <p class="flex ml-44 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>
                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-1.5">Inisials</p>
                            <p class="flex ml-44 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>

                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-3">Nama</p>
                            <p class="flex ml-40 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>

                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-4">Jabatan</p>
                            <p class="flex ml-40 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>

                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-3.5">No Telephone</p>
                            <p class="flex ml-32 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>
                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-3.5">Alamat</p>
                            <p class="flex ml-32 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>
                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-3.5">Tempat, Tanggal Lahir</p>
                            <p class="flex ml-32 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>
                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-3.5">Jenis Kelamin</p>
                            <p class="flex ml-32 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>
                    <div class="flex items-center pt-2 rounded-t ">
                        <div class="flex flex-row">
                            <p class="flex text-gray-900 mr-3.5">Agama</p>
                            <p class="flex ml-32 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">#</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function reset() {
            document.getElementById('show').reset()
        }
    </script>
