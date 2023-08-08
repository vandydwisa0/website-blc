<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranpendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start_date = request('start_date');
        $end_date = request('end_date');

        $pembayaran = app('firebase.firestore')->database()->collection('payment');

        if ($start_date && $end_date) {

            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);

            $query = $pembayaran->where('paymentDate', '>=', new \Google\Cloud\Core\Timestamp($start_date))
                ->where('paymentDate', '<=', new \Google\Cloud\Core\Timestamp($end_date));

            $snapshot = $query->documents();
        } else {
            $pembayaran = app('firebase.firestore')->database()->collection('payment');

            $query = $pembayaran->where('paymentType', '=', 'Pendaftaran');

            $snapshot = $query->documents();
        }

        $siswa = app('firebase.firestore')->database()->collection('users')->documents();

        return view('admin.pembayaranpendaftaran.index', compact('snapshot', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Generate noPayment
        $siswas = app('firebase.firestore')->database()->collection('payment')->documents()->size() + 1;
        $group = ((int)(($siswas - 1) / 500)) + 1;
        $char = (($group - 1) % 26) + ord('E'); // Ubah 'A' menjadi 'E'
        $abjad = '';
        if ($char > ord('Z')) {
            $abjad = chr($char - ord('Z') - 1 + ord('A'));
        } else {
            $abjad = chr($char);
        }
        $formatNopaymentNumber = str_pad((($siswas - 1) % 500) + 1, 5, '0', STR_PAD_LEFT); // Ubah '3' menjadi '5'
        $formatNopayment = $abjad . $formatNopaymentNumber; // Hilangkan '0' pada awal string

        // Hasil akhir noPayment
        $noPayment = $formatNopayment;

        // Tambahkan kolom paymentDate dengan tanggal saat ini tanpa waktu dan timezone
        $paymentDate = Carbon::now('Asia/Jakarta'); // Tanggal saat ini dalam format yang diinginkan

        // Ambil tahun dari tanggal pembayaran (paymentDate)
        $yearPaid = Carbon::now()->isoFormat('Y');

        // Update data pembayaran pendaftaran
        $nominal = 250000; // Atur nominal menjadi Rp 250.000
        $nominal = str_replace(".", "", $nominal);
        $discount = str_replace(".", "", $request['discount']);
        $payAmount = str_replace(".", "", $request['payAmount']);
        $remainingPayment = str_replace(".", "", $request['remainingPayment']);
        // Hitung nilai nominal berdasarkan adanya atau ketiadaan discount
        // $discount = $request->discount ?? 0; // Gunakan nilai discount jika ada, atau 0 jika tidak ada
        $nominals = $nominal;
        $nominals -= $discount; // Hitung nilai nominal setelah dikurangi discount

        // Hitung sisa pembayaran (remainingPayment)
        // $payAmount = $request->payAmount;
        $remainingPayment = max(0, $nominals - $payAmount); // Sisa pembayaran tidak boleh negatif, minimal 0

        // Tentukan nilai paymentStatus berdasarkan nilai payAmount
        if ($payAmount == $nominal) {
            $paymentStatus = 'Lunas';
        } elseif ($remainingPayment > 0) {
            $paymentStatus = 'Belum Lunas';
        } else {
            $paymentStatus = 'Lunas';
        }

        $paymentRef = app('firebase.firestore')->database()->collection('payment')->newDocument();
        $paymentRef->set([
            'payerId' => $request->payerId,
            'blcClass' => $request->blcClass,
            'discount' => intval($discount),
            'nisBlc' => $request->nisBlc,
            'noPayment' => $noPayment,
            'nominal' => intval($nominal),
            'operatorName' => Session::get('name'),
            'payAmount' => intval($payAmount),
            'payerName' => $request->name,
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
            'paymentType' => 'Pendaftaran',
            'remainingPayment' => intval($remainingPayment),
            'yearPaid' => strval($yearPaid),
        ]);


        Alert::success('Success', 'Success Menambah Data');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Ambil data pembayaran berdasarkan ID
        $paymentRef = app('firebase.firestore')->database()->collection('payment')->document($id);
        $paymentData = $paymentRef->snapshot()->data();

        // Tambahkan kolom paymentDate dengan tanggal saat ini tanpa waktu dan timezone
        $paymentDate = Carbon::now('Asia/Jakarta'); // Tanggal saat ini dalam format yang diinginkan

        // Ambil tahun dari tanggal pembayaran (paymentDate)
        $yearPaid = Carbon::parse($paymentDate)->year;

        // Update data pembayaran pendaftaran
        $nominal = 250000; // Atur nominal menjadi Rp 250.000
        $nominal = str_replace(".", "", $nominal);
        $discount = str_replace(".", "", $request['discount']);
        $payAmount = str_replace(".", "", $request['payAmount']);
        $remainingPayment = str_replace(".", "", $request['remainingPayment']);
        // Hitung nilai nominal berdasarkan adanya atau ketiadaan discount
        // $discount = $request->discount ?? 0; // Gunakan nilai discount jika ada, atau 0 jika tidak ada
        $nominals = $nominal;
        $nominals -= $discount; // Hitung nilai nominal setelah dikurangi discount

        // Hitung sisa pembayaran (remainingPayment)
        // $payAmount = $request->payAmount;
        $remainingPayment = max(0, $nominals - $payAmount); // Sisa pembayaran tidak boleh negatif, minimal 0

        // Tentukan nilai paymentStatus berdasarkan nilai payAmount
        if ($payAmount == $nominal) {
            $paymentStatus = 'Lunas';
        } elseif ($remainingPayment > 0) {
            $paymentStatus = 'Belum Lunas';
        } else {
            $paymentStatus = 'Lunas';
        }

        // Update data pada Firestore
        $paymentRef->set([
            'payerId' => $request->payerId,
            'blcClass' => $request->blcClass,
            'nominal' => intval($nominal),
            'discount' => intval($discount),
            'operatorName' => $request->operatorName,
            'payAmount' => intval($payAmount),
            'payerName' => $request->payerName,
            'operatorName' => Session::get('name'),
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
            'remainingPayment' => intval($remainingPayment),
            'yearPaid' => strval($yearPaid),
        ], ['merge' => true]);

        // $paymentRef->update([
        //     ['path' => 'blcClass', 'value' => $request->blcClass],
        //     ['path' => 'nominal', 'value' => intval($nominal)],
        //     ['path' => 'discount', 'value' => intval($discount)],
        //     ['path' => 'operatorName', 'value' => $request->operatorName],
        //     ['path' => 'payAmount', 'value' => intval($payAmount)],
        //     ['path' => 'payerName', 'value' => $request->payerName],
        //     ['path' => 'operatorName', 'value' => Session::get('name')],
        //     ['path' => 'paymentDate', 'value' => $paymentDate],
        //     ['path' => 'paymentStatus', 'value' => $paymentStatus],
        //     ['path' => 'remainingPayment', 'value' => intval($remainingPayment)],
        //     ['path' => 'yearPaid', 'value' => strval($yearPaid)],
        // ], ['merge' => true]);
        Alert::success('Success', 'Data Pembayaran berhasil diperbarui');
        return redirect()->back();
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('payment')->document($id)->delete();
        Alert::success('Success', 'Success Menghapus Data');
        return redirect()->back();
    }

    public function invoicedetails($id)
    {
        $pembayaranpembayaran = app('firebase.firestore')->database()->collection('payment');
        $query = $pembayaranpembayaran->where('noPayment', '=', $id);
        $snapshot = $query->documents();
        return view(
            'admin.pembayaranpendaftaran.invoicedetails',
            compact('snapshot')
        );
    }
    public function print()
    {
        $start_date = request('start_date');
        $end_date = request('end_date');
        if ($start_date && $end_date) {
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);
            $pembayaran = app('firebase.firestore')->database()->collection('payment');
            $query = $pembayaran->where('paymentDate', '>=', new \Google\Cloud\Core\Timestamp($start_date))
                ->where('paymentDate', '<=', new \Google\Cloud\Core\Timestamp($end_date));

            $snapshot = $query->documents();
        } else {
            $pembayaran = app('firebase.firestore')->database()->collection('payment');

            $query = $pembayaran->where('paymentType', '=', 'Pendaftaran');

            $snapshot = $query->documents();
        }
        return view(
            'admin.pembayaranpendaftaran.events',
            compact('snapshot')
        );
    }
}
