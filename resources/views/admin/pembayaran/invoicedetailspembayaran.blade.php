<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Print Invoice</title>
</head>

<body>


    <div class="p-6 space-y-6">
        @foreach ($snapshot as $item)
            <form id="edit">
                <div class="flex justify-center items-center border-b-2 dark:border-gray-600 mb-10">
                    <div class="items-center justify-center">
                        <img src="/images/blc.png" class="w-48">
                    </div>
                    <div class="w-10/12">
                        <div class="header text-center my-3">
                            <h4 class="mb-0 font-bold text-lg">Bimbingan Belajar</h4>
                            <h4 class="mb-0 font-bold text-lg">BRILLIANT LEARNING CENTER</h4>
                            <h4 class="mb-0 font-bold text-lg">SEKOLAH MENEGAH KEJURUSAN NEGERI 1 KATAPANG</h4>
                            <p class="mb-0 text-sm text-gray-700 font-medium">Jln. Cicukang RT 02/28 Desa Mekarrahayu
                                Kec. Margaasih Kab. Bandung 40218
                            </p>
                            <p class="mb-0 text-sm text-gray-700 font-medium">
                                <box-icon type='solid' class="w-4 pt-2.5 -mt-4" name='phone'></box-icon>085721064363
                                <box-icon type='solid' class="w-4 pt-2.5"
                                    name='message-square-detail'></box-icon>D010ABB6
                            </p>
                            <p class="mb-0 text-xs text-gray-700 font-medium">
                                @brilliant_blc
                                <box-icon type='solid' class="w-4 pt-3"
                                    name='envelope'></box-icon>brilliantblc2013@gmail.com
                            </p>
                            <h6 class="mb-0 text-xs">BNI : 0257636907 BRI : 399801009816537</h6>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between rounded-t ">
                    <p class="mb-2 text-lg font-semibold text-gray-900 ">Invoice</p>
                    <div class="flex justify-between">
                        <p class="flex flex-row text-gray-500">Tanggal Pembayaran :</p>
                        <p class="space-x-10 ml-2">{{ $item->data()['paymentDate'] }}</p>
                    </div>
                </div>
                <div class="flex items-center pt-7 rounded-t border-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-0.5">No Pembayaran</p>
                        <p class="flex ml-28 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['noPayment'] }}</p>
                </div>

                <div class="flex items-center pt-2  rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-1.5">Nama</p>
                        <p class="flex ml-44 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['payerName'] }}</p>
                </div>

                <div class="flex items-center pt-2 rounded-t">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-1">Kelas Blc</p>
                        <p class="flex ml-40 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">
                        @if (is_array($item->data()['blcClass']))
                            {{ rtrim(implode(', ', $item->data()['blcClass']), ', ') }}
                        @else
                            {{ $item->data()['blcClass'] ?? 'No Education' }}
                        @endif
                    </p>
                </div>

                <div class="flex items-center pt-2 rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-3.5">NIS Blc</p>
                        <p class="flex ml-40 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['nisBlc'] }}</p>
                </div>

                <div class="flex items-center mt-2 pb-7 rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-4">Staff</p>
                        <p class="flex ml-44 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['operatorName'] }}</p>
                </div>

                <div class="flex items-center pt-2 rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-0.5">Jenis Pembayaran</p>
                        <p class="flex ml-24 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['paymentType'] }}</p>
                </div>
                @if (isset($item['periode']) && $item['paymentType'] === 'Reguler')
                    <div class="flex items-center pt-2 rounded-t">
                        <div class="flex flex-row">
                            <p class="flex text-gray-500 mr-2">Periode</p>
                            <p class="flex ml-40 text-gray-500">:</p>
                        </div>
                        <p class="space-x-10 ml-2">{{ $item->data()['periode'] }}</p>
                    </div>
                @else
                    @if ($item['paymentType'] !== 'Privat')
                    @endif
                @endif
                <div class="flex items-center py-2 rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-2.5">Status Pembayaran</p>
                        <p class="flex ml-20 text-gray-500">:</p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['paymentStatus'] }}</p>
                </div>

                <div class="flex items-center pt-7 border-t rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 mr-4">Nominal</p>
                        <p class="flex ml-36 text-gray-500">: Rp </p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['nominal'] }}</p>
                </div>
                <div class="flex items-center py-2 rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex text-gray-500 -mr-1">Discount</p>
                        <p class="flex ml-40 text-gray-500">: Rp </p>
                    </div>
                    <p class="space-x-10 ml-2">{{ $item->data()['discount'] }}</p>
                </div>

                <div class="flex items-end pt-7 border-t rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex font-bold text-gray-500 ml-72">Jumlah Bayar</p>
                        <p class="flex font-bold ml-12 text-gray-500">: Rp</p>
                    </div>
                    <p class=" font-bold space-x-10 ml-2">{{ $item->data()['payAmount'] }}</p>
                </div>
                <div class="flex items-end pb-7 rounded-t ">
                    <div class="flex flex-row">
                        <p class="flex font-bold text-gray-500 ml-72">Sisa Pembayaran</p>
                        <p class="flex font-bold ml-5 text-gray-500">: Rp</p>
                    </div>
                    <p class=" font-bold space-x-10 ml-2">{{ $item->data()['remainingPayment'] }}</p>
                </div>

            </form>
        @endforeach
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
