<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <button data-modal-target="notifiaction-users" data-modal-toggle="notifiaction-users" class="px-2 py-2" type="button">
        <box-icon type='solid' color="orange" name='bell'></box-icon>
    </button>
</div>



<!-- Main Modal -->
<div id="notifiaction-users" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-6xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900 ">
                    Acc Admin Baru
                </h3>
                <button type="button" onclick="reset()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                    data-modal-hide="notifiaction-users">
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
                <div class="relative px-4 py-4 overflow-x-auto">
                    <table id="myTable" class="min-w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Jabatan</th>
                                <th scope="col" class="px-4 py-3">Email Verifikasi</th>
                                <th scope="col" class="px-4 py-3">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($snapshot as $item)
                                @if ($item->data()['emailVerified'] == false)
                                    <tr class="border-b ">
                                        <td class="px-4 py-3">{{ $item->data()['name'] }}</td>
                                        <td class="px-4 py-3">{{ $item->data()['role'] }}</td>
                                        <td class="px-4 py-3">{{ $item->data()['emailVerified'] ? 'True' : 'False' }}
                                        </td>
                                        {{-- <td class="px-4 py-3">{{ $item->data()['emailVerified'] ? 'True' : 'False' }}</td> --}}
                                        {{-- @if (!$item->data()['emailVerified'])
                                        <a href="{{ route('approveEmail', $item->id()) }}">Setuju</a>
                                    @endif --}}
                                        <td class="px-4 py-3">
                                            <button type="submit"><box-icon name='check'></box-icon></button>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function reset() {
        document.getElementById('edit').reset()
    }
</script>
