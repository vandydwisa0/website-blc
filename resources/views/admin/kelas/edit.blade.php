<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <form action="/admin/kelas/{{ $item->id() }}/edit/" class="badge bg warning">
        @method('edit')
        @csrf
        <button data-modal-target="edit-kelas{{ $item->id() }}" id="button-edit"
            data-modal-toggle="edit-kelas{{ $item->id() }}" class="px-2 py-2" type="button">
            <box-icon type='solid' color="green" name='edit'></box-icon>
        </button>
    </form>


</div>

<!-- Main Modal -->
<div id="edit-kelas{{ $item->id() }}" tabindex="-1" data-modal-backdrop="static" data-te-keyboard="false"
    data-modal-backdrop="static" data-te-keyboard="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t ">
                <h3 class="text-xl font-medium text-gray-900 ">
                    Edit Kelas
                </h3>
                <button type="button" onclick="reset()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                    data-modal-hide="edit-kelas{{ $item->id() }}">
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
                <form action="/admin/kelas/{{ $item->id() }}" id="edit" method="POST">
                    @method('put')
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="className" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Kelas</label>
                            <input type="text" name="className" id="className"
                                value="{{ $item->data()['className'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Kelas BLC..." required="">
                        </div>
                        <div>
                            <label for="schoolLevel"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Tingkat</label>
                            <input type="text" name="schoolLevel" id="schoolLevel"
                                value="{{ $item->data()['schoolLevel'] }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Masukan Tingkatannya..." required="">
                        </div>
                        <div>
                            <label for="program" class="block mb-2 text-sm font-medium text-gray-900">Program</label>
                            <select id="prog" name="program"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Program</option>
                                @isset($program)
                                    @foreach ($program as $items)
                                        <option value="{{ $items->id() }}"
                                            {{ $items->data()['name'] == $item->data()['program'] ? 'selected' : '' }}>
                                            {{ ucfirst($items->data()['name']) }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div>
                            <label for="meetingPerWeek" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah
                                Pertemuan Perminggu</label>
                            <input type="number" name="meetingPerWeek" id="meetingPerWeek"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                readonly value="{{ $item->data()['meetingsPerWeek'] }}">
                        </div>
                        <div>
                            <label for="companyBranch"
                                class="block mb-2 text-sm font-medium text-gray-900">Cabang</label>
                            <select id="companyBranch" name="companyBranch"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select Cabang</option>
                                @isset($cabang)
                                    @foreach ($cabang as $items)
                                        <option value="{{ $items->id() }}"
                                            {{ $items->data()['name'] == $item->data()['companyBranch'] ? 'selected' : '' }}>
                                            {{ ucfirst($items->data()['name']) }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        {{-- <div>
                            <label for="companyBranch"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Cabang</label>
                            <select id="companyBranch" name="companyBranch"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
                                required data-live-search="true">
                                @foreach (['BLC Pusat', 'BLC Cabang 1'] as $companyBranch)
                                    <option value="{{ $companyBranch }}"
                                        {{ $companyBranch == $item->data()['companyBranch'] ? 'selected' : '' }}>
                                        {{ ucfirst($companyBranch) }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

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
    $('#prog').on('change', function() {

        const program_id = $(this).val();
        if (program_id) {
            $.ajax({
                url: '/admin/get_meeting_per_weeks/' + program_id,
                method: 'get',
                success: function(data) {
                    $('#meetingPerWeek').val(data);
                }
            });
        } else {
            $('#meetingPerWeek').val('');
        }
    });
</script>
