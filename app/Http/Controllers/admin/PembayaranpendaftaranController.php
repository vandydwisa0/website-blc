<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $pembayaranpembayaran = app('firebase.firestore')->database()->collection('payment');
        $query = $pembayaranpembayaran->where('paymentType', '=', 'Pendaftaran');
        $snapshot = $query->documents();
        // $siswa = app('firebase.firestore')->database()->collection('users');
        // $querysiswa = $siswa->where('role', '=', 'siswa');
        // $snapshotsiswa = $query->documents();
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
        $paymentDate = Carbon::now()->toDayDateTimeString(); // Tanggal saat ini dalam format yang diinginkan

        // Ambil tahun dari tanggal pembayaran (paymentDate)
        $yearPaid = Carbon::parse($paymentDate)->year;

        // Tambahkan data pembayaran pendaftaran
        $nominal = 250000; // Atur nominal menjadi Rp 250.000
        // Hitung nilai nominal berdasarkan adanya atau ketiadaan discount
        $discount = $request->discount ?? 0; // Gunakan nilai discount jika ada, atau 0 jika tidak ada
        $nominal = $nominal['nominal'] - $discount; // Hitung nilai nominal setelah dikurangi discount


        // Tentukan nilai paymentStatus berdasarkan nilai payAmount
        if ($request->payAmount == 0) {
            $paymentStatus = 'Belum Lunas';
        } elseif ($request->payAmount >= $nominal['nominal']) {
            $paymentStatus = 'Lunas';
        } else {
            $paymentStatus = 'Belum Lunas';
        }


        $paymentRef = app('firebase.firestore')->database()->collection('payment')->newDocument();
        $paymentRef->set([
            'blcClass' => $request->blcClass,
            'discount' => $discount,
            'nisBlc' => $request->nisBlc,
            'noPayment' => $noPayment,
            'nominal' => $nominal,
            'operatorName' => $request->operatorName,
            'payAmount' => $request->payAmount,
            'payerName' => $request->name,
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
            'paymentType' => 'Pendaftaran',
            'remainingPayment' => $request->remainingPayment,
            'yearPaid' => $yearPaid,
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
        $paymentDate = Carbon::now()->toDayDateTimeString(); // Tanggal saat ini dalam format yang diinginkan

        // Ambil tahun dari tanggal pembayaran (paymentDate)
        $yearPaid = Carbon::parse($paymentDate)->year;

        // Update data pembayaran pendaftaran
        $nominal = 250000; // Atur nominal menjadi Rp 250.000
        // Hitung nilai nominal berdasarkan adanya atau ketiadaan discount
        $discount = $request->discount ?? 0; // Gunakan nilai discount jika ada, atau 0 jika tidak ada
        $nominals = $nominal;

        $nominals -= $discount; // Hitung nilai nominal setelah dikurangi discount

        // Hitung sisa pembayaran (remainingPayment)
        $payAmount = $request->payAmount;
        $remainingPayment = max(0, $nominals - $payAmount); // Sisa pembayaran tidak boleh negatif, minimal 0

        // Tentukan nilai paymentStatus berdasarkan nilai payAmount
        if ($payAmount == 0) {
            $paymentStatus = 'Belum Lunas';
        } elseif ($remainingPayment == 0) {
            $paymentStatus = 'Lunas';
        } else {
            $paymentStatus = 'Belum Lunas';
        }

        // Update data pada Firestore
        $paymentRef->set([
            'discount' => $discount,
            'nominal' => $nominal,
            'operatorName' => $request->operatorName,
            'payAmount' => $payAmount,
            'payerName' => $request->payerName,
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
            'remainingPayment' => $remainingPayment,
            'yearPaid' => $yearPaid,
        ], ['merge' => true]);

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
        //
    }
}
