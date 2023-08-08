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
     <style>

     </style>
 </head>

 <body>
     <div class="px-4 py-4 overflow-x-auto">
         <table id="table-to-print" class="w-full text-xs text-left text-gray-500 ">
             <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                 <tr>
                     <th scope="col" class="px-2 py-2 text-center">No</th>
                     <th scope="col" class="px-2 py-2 text-center">NIS BLC</th>
                     <th scope="col" class="px-2 py-2 text-center">Nama</th>
                     <th scope="col" class="px-2 py-2 text-center">Kelas</th>
                     <th scope="col" class="px-2 py-2 text-center">No Resi</th>
                     <th scope="col" class="px-2 py-2 text-center">Tipe</th>
                     <th scope="col" class="px-2 py-2 text-center">Periode</th>
                     <th scope="col" class="px-2 py-2 text-center">Nominal</th>
                     <th scope="col" class="px-2 py-2 text-center">Discount</th>
                     <th scope="col" class="px-2 py-2 text-center">Jumlah</th>
                     <th scope="col" class="px-2 py-2 text-center">Operator</th>
                     <th scope="col" class="px-2 py-2 text-center">Tanggal</th>
                     <th scope="col" class="px-2 py-2 text-center">Status</th>
                     <th scope="col" class="px-2 py-2 text-center">Sisa</th>
                 </tr>
             </thead>
             <tbody>

                 @php
                     $startingNumber = 1;
                 @endphp
                 @foreach ($snapshot as $item)
                     @if ($item->data()['paymentType'] != 'Pendaftaran')
                         <tr class="border-b ">
                             <th scope="row" class="text-center">{{ $startingNumber++ }}</th>
                             <td class="text-center">{{ $item->data()['nisBlc'] }}</td>
                             <td class="text-center">{{ $item->data()['payerName'] }}</td>
                             <td class="text-center">{{ $item->data()['blcClass'] }}</td>
                             <td class="text-center">{{ $item->data()['noPayment'] }}</td>
                             <td class="text-center">{{ $item->data()['paymentType'] }}</td>
                             <td class="text-center">{{ $item->data()['periode'] }}</td>
                             <td class="text-center">{{ $item->data()['nominal'] }}</td>
                             <td class="text-center">{{ $item->data()['discount'] }}</td>
                             <td class="text-center">{{ $item->data()['payAmount'] }}</td>
                             <td class="text-center">{{ $item->data()['operatorName'] }}</td>
                             <td class="text-center">
                                 @php
                                     $date = Carbon\Carbon::parse($item->data()['paymentDate']);
                                     $date->settings(['formatFunction' => 'translatedFormat']);
                                     $paymentDate = $date->format('j F Y');
                                 @endphp
                                 {{ $paymentDate }}
                             </td>
                             <td class="text-center">{{ $item->data()['paymentStatus'] }}</td>
                             <td class="text-center">{{ $item->data()['remainingPayment'] }}</td>
                         </tr>
                     @endif
                 @endforeach
             </tbody>
         </table>
     </div>

     <script type="text/javascript">
         window.print();
     </script>
     {{-- <script>
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $(document).ready(function() {
             $("#end_date").on('change', function() {
                 let start_date = $("#start_date").val();
                 let end_date = $("#end_date").val();
                 // console.log('test');
                 $.ajax({
                     type: 'get',
                     url: '/admin/post_start_end_date/',
                     data: {
                         start_date: start_date,
                         end_date: end_date,
                     },
                     success: (function(data) {
                         // $('#start_date').val(start_date);
                         // $('#end_date').val(end_date);
                         let tableBody = $('#table tbody');
                         let i = 1;
                         tableBody.empty();
                         data.forEach(function(item) {
                             tableBody.append(
                                 `<table>
                                <tr>
                                    <td class="px-4 py-3">${i++}</td>
                                    <td class="px-4 py-3">${item.nisBlc}</td>
                                    <td class="px-4 py-3">${item.nisBlc}</td>
                                    <td class="px-4 py-3">${item.payerName}</td>
                                    <td class="px-4 py-3">${item.paymentType}</td>
                                    <td class="px-4 py-3">${item.payAmount}</td>
                                    <td class="px-4 py-3">${item.paymentStatus}</td>
                                    <td class="px-4 py-3">${item.paymentDate}</td>
                                </tr>
                                `
                             );
                         })
                         console.log(data)

                     })
                 })
             })
         });
     </script> --}}
 </body>

 </html>
