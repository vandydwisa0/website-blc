@extends('admin.layouts.app')
@section('content')
    <div class="sm:ml-64">
        <div class="p-4 py-10 mt-14">
            <h1 class="mb-2 text-gray-700 font-bold text-4xl">Data Pembayaran</h1>

            <section class="bg-gray-50 ">
                <div class="flex-auto mx-auto max-w-full">
                    <!-- Start coding here -->
                    <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-row">
                                        <input type="text" id="myInput" onkeyup="myFunction()" name="cari"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 mt-1"
                                            placeholder="Search" name="search">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <div id="filtered_results">
                                    <div class="container mx-auto bg-white mt-5">
                                        <form action="/admin/pembayaran?start_date={{ request('s') }}&end_date=end_date"
                                            method="GET">
                                            <div class="flex mb-4 block space-y-4 md:flex md:space-y-0 md:space-x-4">
                                                <input type="datetime-local" id="start_date" name="start_date"
                                                    class="px-2 py-1 rounded border">
                                                <input type="datetime-local" id="end_date" name="end_date"
                                                    class="px-2 py-1 rounded border">
                                                <button type="submit"
                                                    class=" ml-4 block w-full md:w-auto font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white"
                                                    style="background-color: #539165">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- Tombol Print --}}
                                <div class="flex items-end justify-end space-x-2 border-gray-200">
                                    <button type="button"
                                        class="block w-full md:w-auto font-medium rounded-lg text-sm mt-1 px-5 py-1.5 text-center text-white"
                                        style="background-color: #539165">
                                        <a class="items-center"
                                            href="/admin/printpembayaran?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"><box-icon
                                                type='solid' color='white' name='printer'></box-icon></a>
                                    </button>
                                </div>
                                @include('admin.pembayaran.create')
                            </div>
                        </div>
                        <div class="px-4 py-4 overflow-x-auto">
                            <table id="myTable" class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">No</th>
                                        <th scope="col" class="px-4 py-3">NIS</th>
                                        <th scope="col" class="px-4 py-3">Nama</th>
                                        <th scope="col" class="px-4 py-3">Kelas</th>
                                        <th scope="col" class="px-4 py-3">No Pembayaran</th>
                                        <th scope="col" class="px-4 py-3">Tipe Pembayaran</th>
                                        <th scope="col" class="px-4 py-3">Periode</th>
                                        <th scope="col" class="px-4 py-3">Nominal</th>
                                        <th scope="col" class="px-4 py-3">Jumlah Bayar</th>
                                        <th scope="col" class="px-4 py-3">Tanggal Bayar</th>
                                        <th scope="col" class="px-4 py-3">Status</th>
                                        <th scope="col" class="px-4 py-3">Sisa Pembayaran</th>
                                        <th scope="col" class="px-4 py-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($snapshot as $item)
                                        @if ($item->data()['paymentType'] != 'Pendaftaran')
                                            <tr class="border-b ">
                                                <th scope="row" class="px-4 py-3">{{ $loop->iteration }}</th>
                                                <td class="px-4 py-3">{{ $item->data()['nisBlc'] }}</td>
                                                <td class="px-4 py-3">{{ $item->data()['payerName'] }}</td>
                                                <td class="px-4 py-3">{{ $item->data()['blcClass'] }}</td>
                                                <td class="px-4 py-3">{{ $item->data()['noPayment'] }}</td>
                                                <td class="px-4 py-3">{{ $item->data()['paymentType'] }}</td>
                                                <td class="px-4 py-3">
                                                    @if ($item['paymentType'] == 'Reguler')
                                                        {{ $item->data()['periode'] }}
                                                    @else
                                                        @if ($item['paymentType'] == 'Privat')
                                                            <p class="text-center">-</p>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3">{{ $item->data()['nominal'] }}</td>
                                                <td class="px-4 py-3">{{ $item->data()['payAmount'] }}</td>
                                                <td class="px-4 py-3">
                                                    @php
                                                        $date = Carbon\Carbon::parse($item->data()['paymentDate']);
                                                        $date->settings(['formatFunction' => 'translatedFormat']);
                                                        $paymentDate = $date->format('l, j F Y');
                                                    @endphp
                                                    {{ $paymentDate }}
                                                </td>
                                                <td class="px-4 py-3">{{ $item->data()['paymentStatus'] }}</td>
                                                <td class="px-4 py-3">{{ $item->data()['remainingPayment'] }}</td>
                                                <td class="flex px-2 py-4 items-center justify-center">
                                                    @include('admin.pembayaran.edit')
                                                    @include('admin.pembayaran.show')
                                                    @include('admin.pembayaran.delete')
                                                    {{-- @if ($item->spp->nominal_perbulan - $item->jumlah_bayar) --}}
                                                    {{-- @else
                                @include('admin.pembayaran.invoice')
                                @include('admin.pembayaran.delete')
                                @endif --}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- PAGINATION --}}
                        {{-- {{ $pembayaran->links() }} --}}
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        // JavaScript Code
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {

                tdNISBLC = tr[i].getElementsByTagName("td")[0];
                tdPayerName = tr[i].getElementsByTagName("td")[1];
                tdBlcClass = tr[i].getElementsByTagName("td")[2];
                tdNoPayment = tr[i].getElementsByTagName("td")[3];

                if (tdNISBLC || tdPayerName || tdBlcClass || tdNoPayment) {
                    txtValueNISBLC = tdNISBLC.textContent || tdNISBLC.innerText;
                    txtValuePayerName = tdPayerName.textContent || tdPayerName.innerText;
                    txtValueBlcClass = tdBlcClass.textContent || tdBlcClass.innerText;
                    txtValueNoPayment = tdNoPayment.textContent || tdNoPayment.innerText;

                    // Gunakan operator "atau" (||) untuk mencocokkan dengan salah satu kriteria
                    if (
                        txtValueNISBLC.toUpperCase().indexOf(filter) > -1 ||
                        txtValuePayerName.toUpperCase().indexOf(filter) > -1 ||
                        txtValueBlcClass.toUpperCase().indexOf(filter) > -1 ||
                        txtValueNoPayment.toUpperCase().indexOf(filter) > -1
                    ) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
