<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Session;

class PembayaranController extends Controller
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

            $query = $pembayaran->where('paymentType', '!=', 'Pendaftaran');

            $snapshot = $query->documents();
        }
        $siswa = app('firebase.firestore')->database()->collection('users')->documents();
        $kelas = app('firebase.firestore')->database()->collection('class')->documents();
        $program = app('firebase.firestore')->database()->collection('program')->documents();
        return view('admin.pembayaran.index', compact('snapshot', 'kelas', 'siswa', 'program'));
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
        // $paymentDate = Carbon::now('Asia/Jakarta')->format('d F Y H:i'); // Tanggal saat ini dalam format yang diinginkan
        $paymentDate = Carbon::now('Asia/Jakarta'); // Tanggal saat ini dalam format yang diinginkan


        // Ambil tahun dari tanggal pembayaran (paymentDate)
        $yearPaid = Carbon::now()->isoFormat('Y');
        // $yearPaid = Carbon::parse($paymentDate)->toString('Y');

        // Tambahkan data pembayaran pendaftaran

        // Hitung nilai nominal berdasarkan adanya atau ketiadaan discount
        // $discount = $request->discount ?? 0; // Gunakan nilai discount jika ada, atau 0 jika tidak ada
        // $nominal = is_numeric($request['nominal']) ? floatval($request['nominal']) : 0;
        $discount = str_replace(".", "", $request['discount']);
        $nominal = str_replace(".", "", $request['nominal']);
        // Convert $request->payAmount to a numeric value (float) if it's a string representation of a number
        // $payAmount = is_numeric($request['payAmount']) ? floatval($request['payAmount']) : 0;
        $payAmount = str_replace(".", "", $request['payAmount']);
        $remainingPayment = str_replace(".", "", $request['remainingPayment']);
        // dd($payAmount);
        // $remainingPayment = is_numeric($request['remainingPayment']) ? floatval($request['remainingPayment']) : 0;
        // Calculate $remainingPayment
        $nominals = $nominal;

        // $nominals -= $discount;
        $remainingPayment = max(0, $nominals - $payAmount); // Sisa pembayaran tidak boleh negatif, minimal 0

        // $remainingPayment = $nominal - $payAmount;
        if ($payAmount == $nominal) {
            $paymentStatus = 'Lunas';
        } elseif ($remainingPayment > 0) {
            $paymentStatus = 'Belum Lunas';
        } else {
            $paymentStatus = 'Lunas';
        }
        // $class = [
        //     $request->blcClass,
        //     $request->blcClass2,
        // ];
        $paymentRef = app('firebase.firestore')->database()->collection('payment')->newDocument();
        $paymentRef->set([
            'payerName' => $request->name,
            'payerId' => $request->payerId,
            // 'companyBranch' => $request->companyBranch,
            'blcClass' => $request->blcClass,
            'nisBlc' => $request->nisBlc,
            'noPayment' => $noPayment,
            // 'program' => $request->program,
            'paymentType' => $request->paymentType,
            'nominal' => intval($nominal),
            'discount' => intval($discount),
            'periode' => $request->periode,
            'payAmount' => intval($payAmount),
            'operatorName' => Session::get('name'),
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
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
        // Hasil akhir noPayment
        $paymentRef = app('firebase.firestore')->database()->collection('payment')->document($id);
        $docSnapshot = $paymentRef->snapshot();

        // Tambahkan kolom paymentDate dengan tanggal saat ini tanpa waktu dan timezone
        $paymentDate = Carbon::now()->toDayDateTimeString(); // Tanggal saat ini dalam format yang diinginkan

        // Ambil tahun dari tanggal pembayaran (paymentDate)
        $yearPaid = Carbon::parse($paymentDate)->year;

        // Tambahkan data pembayaran pendaftaran

        $discount = str_replace(".", "", $request['discount']);
        $nominal = str_replace(".", "", $request['nominal']);
        // Convert $request->payAmount to a numeric value (float) if it's a string representation of a number
        // $payAmount = is_numeric($request['payAmount']) ? floatval($request['payAmount']) : 0;
        $payAmount = str_replace(
            ".",
            "",
            $request['payAmount']
        );
        $remainingPayment = str_replace(".", "", $request['remainingPayment']);
        // dd($payAmount);
        // $remainingPayment = is_numeric($request['remainingPayment']) ? floatval($request['remainingPayment']) : 0;
        // Calculate $remainingPayment
        $nominals = $nominal;

        $nominals -= $discount;
        $remainingPayment = max(0, $nominals - $payAmount); // Sisa pembayaran tidak boleh negatif, minimal 0

        // $remainingPayment = $nominal - $payAmount;
        if ($payAmount == $nominal) {
            $paymentStatus = 'Lunas';
        } elseif ($remainingPayment > 0) {
            $paymentStatus = 'Belum Lunas';
        } else {
            $paymentStatus = 'Lunas';
        }

        if ($docSnapshot->exists()) {
            // Data ditemukan, update data di Firestore berdasarkan data yang dikirim melalui form
            $paymentRef->update([
                ['path' => 'paymentType', 'value' => $request->paymentType],
                ['path' => 'nominal', 'value' => intval($nominal)],
                ['path' => 'discount', 'value' => intval($discount)],
                ['path' => 'payAmount', 'value' => intval($payAmount)],
                ['path' => 'operatorName', 'value' => Session::get('name')],
                ['path' => 'paymentDate', 'value' => $paymentDate],
                ['path' => 'paymentStatus', 'value' => $paymentStatus],
                ['path' => 'remainingPayment', 'value' => intval($remainingPayment)],
                ['path' => 'yearPaid', 'value' => strval($yearPaid)],
            ]);

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            Alert::success('Success', 'Success Mengupdate Data');
            return redirect()->back();
        }
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

    // Metode untuk mengambil opsi-opsi nisBlc dari Firestore collection "users"
    public function getNisBlcOptions()
    {
        try {
            $usersCollection = app('firebase.firestore')->database()->collection('users');
            $nisBlcOptions = $usersCollection->where('role', '=', 'siswa')->documents();
            $options = [];
            foreach ($nisBlcOptions as $document) {
                $options[] = $document->data()['nisBlc'];
            }
            return $options;
        } catch (\Exception $e) {
            // Tangani kesalahan dan kirimkan respon error ke sisi klien
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }

    // Metode untuk mengambil data siswa berdasarkan nisBlc dari Firestore collection "users"
    public function getStudentByNisBlc($nisBlc)
    {
        try {
            // Ambil koleksi "users" dari Firebase Firestore
            $usersCollection = app('firebase.firestore')->database()->collection('users');
            // Lakukan query untuk mencari data siswa berdasarkan NIS BLC dan peran "siswa"
            $query = $usersCollection->where('nisBlc', '=', $nisBlc)->where('role', '=', 'siswa')->documents();

            $results = [];

            foreach ($query as $document) {
                $data = $document->data();
                $payerId = $document->id();
                $name = $data['name'];
                $blcClass = $data['blcClass'];

                $results[] = $payerId;
                $results[] = $name;
                $results[] = $blcClass;
            }

            return $results;

            // // Periksa apakah data siswa ditemukan
            // if (!$query->isEmpty()) {
            //     // Ambil dokumen pertama dari hasil query (hanya mengambil satu dokumen karena NIS BLC seharusnya unik)
            //     $studentDocument = $query->first();

            //     // Ambil data siswa dari dokumen
            //     $studentData = $studentDocument->data();

            //     // Kembalikan data siswa dalam bentuk JSON sebagai respons
            //     return $studentData;
            // } else {
            //     // Jika data siswa tidak ditemukan, kembalikan respons error 404
            //     return $query;
            // }
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error fetching student data:', ['message' => $e->getMessage()]);

            // Return an error response
            return response()->json(['error' => 'Terjadi Kesalahan Server Internal'], 500);
        }
    }

    public function invoicedetailspembayaran($id)
    {
        $pembayaranpembayaran = app('firebase.firestore')->database()->collection('payment');
        $query = $pembayaranpembayaran->where('noPayment', '=', $id);
        $snapshot = $query->documents();
        return view(
            'admin.pembayaran.invoicedetailspembayaran',
            compact('snapshot')
        );
    }
    public function printpembayaran()
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

            $query = $pembayaran->where('paymentType', '!=', 'Pendaftaran');

            $snapshot = $query->documents();
        }
        return view(
            'admin.pembayaran.events',
            compact('snapshot')
        );
    }
}
