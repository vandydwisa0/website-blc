<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <form action="/admin/guru/{{ $item->id() }}/edit/" class="badge bg warning">
        @method('edit')
        @csrf
        <button data-modal-target="edit-guru{{ $item->id() }}" id="button-edit"
            data-modal-toggle="edit-guru{{ $item->id() }}" class="px-2 py-2" type="button">
            <box-icon type='solid' color="green" name='edit'></box-icon>
        </button>
    </form>


</div>

<!-- Main Modal -->
<div id="edit-guru{{ $item->id() }}" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900 ">
                    Edit guru
                </h3>
                <button type="button" onclick="reset()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                    data-modal-hide="edit-guru{{ $item->id() }}">
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
            {{-- <div class="p-6 space-y-6">
                <form action="/admin/guru/{{ $item->id() }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 mt-2 sm:grid-cols-2">
                        <div>
                            <label for="initials" class="block mb-2 text-sm font-medium text-gray-900">Inisial</label>
                            <input type="text" name="initials" id="initials" value="{{ $item->data()['initials'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div>
                            <label for="lastEducation" class="block mb-2 text-sm font-medium text-gray-900">Pendidikan
                                Terakhir</label>
                            <input type="text" name="lastEducation" id="lastEducation"
                                value="{{ $item->data()['lastEducation'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama guru</label>
                            <input type="text" name="name" id="name" value="{{ $item->data()['name'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div>
                            <label for="specialization"
                                class="block mb-2 text-sm font-medium text-gray-900">Spesialisasi</label>
                            <input type="text" name="specialization" id="specialization"
                                value="{{ $item->data()['specialization'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="grid gap-1 mb-2 mt-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900" for="photo">Upload
                                    Foto</label>
                                <input
                                    class="block w-full text-base text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50"
                                    id="photo" name="photo" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 mt-2 sm:grid-cols-2">
                        <div>
                            <label for="teachingAbility" class="block mb-2 text-sm font-medium text-gray-900">Kemampuan
                                Mengajar</label>
                            <div class="flex">
                                <div class="flex mr-4">
                                    <input id="kimia" name="teachingAbility[]" type="checkbox" value="Kimia"
                                        {{ in_array('Kimia', explode(',', $item['teachingAbility'])) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="kimia"
                                        class="mx-4 text-sm font-medium text-gray-900 dark:text-gray-300">Kimia</label>
                                </div>
                                <div class="flex mr-4">
                                    <input id="fisika" name="teachingAbility[]" type="checkbox" value="Fisika"
                                        {{ in_array('Fisika', explode(',', $item['teachingAbility'])) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="fisika"
                                        class="mx-4 text-sm font-medium text-gray-900 dark:text-gray-300">Fisika</label>
                                </div>
                                <div class="flex mr-4">
                                    <input id="matematika" name="teachingAbility[]" type="checkbox"
                                        value="Matematika"
                                        {{ in_array('Matematika', explode(',', $item['teachingAbility'])) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="matematika"
                                        class="mx-4 text-sm font-medium text-gray-900 dark:text-gray-300">Matematika</label>
                                </div>
                                <div class="flex mr-4">
                                    <input id="indonesia" name="teachingAbility[]" type="checkbox" value="Indonesia"
                                        {{ in_array('Indonesia', explode(',', $item['teachingAbility'])) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="indonesia"
                                        class="mx-4 text-sm font-medium text-gray-900 dark:text-gray-300">Indonesia</label>
                                </div>
                                <div class="flex mr-4">
                                    <input id="inggris" name="teachingAbility[]" type="checkbox" value="Inggris"
                                        {{ in_array('Inggris', explode(',', $item['teachingAbility'])) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="inggris"
                                        class="mx-4 text-sm font-medium text-gray-900 dark:text-gray-300">Inggris</label>
                                </div>
                            </div>
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
            </div> --}}

        </div>
    </div>
</div>
<script>
    function reset() {
        document.getElementById('edit').reset()
    }
</script>
