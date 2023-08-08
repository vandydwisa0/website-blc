<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Kreait\Firebase\Auth as FirebaseAuth;

class SiswaController extends Controller
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $siswa = app('firebase.firestore')->database()->collection('users');
        $query = $siswa->where('role', '=', 'siswa');

        // // Check if a search query is provided
        // if ($request->has('cari') && $request->input('cari') !== '') {
        //     $searchTerm = $request->input('cari');

        //     // Check if the 'nisBlc' field exists in Firestore before performing the search
        //     $nisBlcExists = $siswa->where('nisBlc', '=', $searchTerm)->documents()->isEmpty();
        //     if ($nisBlcExists) {
        //         return redirect();
        //     }

        //     $query = $query->where('nisBlc', '>=', $searchTerm)
        //         ->where('nisBlc', '<=', $searchTerm . "\uf8ff");
        //     dd($query);
        // }

        $snapshot = $query->documents();
        // dd($snapshot);
        $cabang = app('firebase.firestore')->database()->collection('companyBranch')->documents();
        $kelas = app('firebase.firestore')->database()->collection('class')->documents();

        return view('admin.siswa.index', compact('snapshot', 'cabang', 'kelas'));
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
        if ($request->doc_id == null) {

            $request->validate([]);

            $child = [
                'childNumber' => $request->input('childNumber'),
                'numberOfSiblings' => $request->input('numberOfSiblings'),
            ];

            // Generate NIS
            $totalStudents = app('firebase.firestore')->database()->collection('users')->documents()->size() + 1;
            $groupNumber = ((int)(($totalStudents - 1) / 500)) + 1;
            $currentChar = (($groupNumber - 1) % 26) + ord('A');
            $alphabet = '';
            if ($currentChar > ord('Z')) {
                $alphabet = chr($currentChar - ord('Z') - 1 + ord('A'));
            } else {
                $alphabet = chr($currentChar);
            }
            $formattedItemNumber = str_pad((($totalStudents - 1) % 500) + 1, 3, '0', STR_PAD_LEFT);
            $formattedIteration = '0' . $alphabet . $formattedItemNumber;

            $class = [
                $request->blcClass,
                $request->blcClass2,
            ];
            // Tentukan jumlah pembayaran pendaftaran berdasarkan jumlah kelas yang dimiliki siswa
            $numRegistrationPayments = ($request->blcClass2) ? 2 : 1;

            $siswaProperties = [
                'email' => $request->email,
                'emailVerified' => true,
                'password' => $request->phoneNumber,
                'displayName' => "", // bisa jadi mun aya valuean te bisa assup
            ];

            $createUserAccount = $this->auth->createUser($siswaProperties);

            $siswaProperties = [
                'email' => $request->email,
                'emailVerified' => true,
                'name' => $request->name,
                'placeAndDateOfBirth' => $request->placeAndDateOfBirth,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'child' => $child,
                'class' => $request->class,
                'school' => $request->school,
                'phoneNumber' => $request->phoneNumber,
                'parentName' => $request->parentName,
                'parentPhoneNumber' => $request->parentPhoneNumber,
                'parentJob' => $request->parentJob,
                'homeAddress' => $request->homeAddress,
                'homePhoneNumber' => $request->homePhoneNumber,
                'nisBlc' => $formattedIteration,
                'role' => 'siswa',
                'companyBranch' => $request->companyBranch,
                'blcClass' => $class,
                'reference' => $request->reference,
            ];

            $createUser = app('firebase.firestore')->database()->collection('users')->document($createUserAccount->uid);
            $createUser->set($siswaProperties);

            // Simpan data ke Firebase
            // Generate noPayment untuk setiap pembayaran pendaftaran
            for ($i = 1; $i <= $numRegistrationPayments; $i++) {
                $siswa = app('firebase.firestore')->database()->collection('payment')->documents()->size() + 1;
                $group = ((int)(($siswa - 1) / 500)) + 1;
                $char = (($group - 1) % 26) + ord('E');
                $abjad = '';
                if ($char > ord('Z')) {
                    $abjad = chr($char - ord('Z') - 1 + ord('A'));
                } else {
                    $abjad = chr($char);
                }
                $formatNopaymentNumber = str_pad((($siswa - 1) % 500) + 1, 5, '0', STR_PAD_LEFT);
                $formatNopayment = $abjad . $formatNopaymentNumber;

                // Hasil akhir noPayment
                $noPayment = $formatNopayment;

                // $paymentDate = Carbon::now('Asia/Jakarta')->format('d F Y H:i'); // Tanggal saat ini dalam format yang diinginkan
                $paymentDate = Carbon::now('Asia/Jakarta'); // Tanggal saat ini dalam format yang diinginkan

                // Ambil tahun dari tanggal pembayaran (paymentDate)
                $yearPaid = Carbon::now()->isoFormat('Y');

                // Update data pembayaran pendaftaran
                $nominal = 250000; // Atur nominal menjadi Rp 250.000
                $nominal = str_replace(".", "", $nominal);
                $discount = str_replace(".", "", $request['discount']);
                $payAmount = str_replace(".", "", $request['payAmount']);
                $remainingPayment = str_replace(".", "", $request['remainingPayment']);

                // Tentukan nilai paymentStatus berdasarkan nilai payAmount
                if ($payAmount == $nominal) {
                    $paymentStatus = 'Lunas';
                } elseif ($remainingPayment > 0) {
                    $paymentStatus = 'Belum Lunas';
                } else {
                    $paymentStatus = 'Lunas';
                }

                // Assuming you have the UID of the user from some previous code
                $uid = $createUserAccount->uid;

                // Retrieve the user's document from the 'users' collection based on their UID
                $userDocRef = app('firebase.firestore')->database()->collection('users')->document($uid);
                $userDoc = $userDocRef->snapshot();
                $payerId = $userDoc->id();

                // Create a new registration payment document for each class
                $paymentRef = app('firebase.firestore')->database()->collection('payment')->newDocument();
                $paymentRef->set([
                    'payerId' => $payerId,
                    'blcClass' => $class[$i - 1], // Get the class based on the iteration index
                    'discount' => intval($discount),
                    'nisBlc' => $formattedIteration,
                    'noPayment' => $noPayment,
                    'nominal' => intval($nominal),
                    'operatorName' => Session::get('name'),
                    'payAmount' => $request->payAmount,
                    'payerName' => $request->name,
                    'paymentDate' => $paymentDate,
                    'paymentStatus' => "Belum Dibayar",
                    'paymentType' => 'Pendaftaran',
                    'remainingPayment' => intval($remainingPayment),
                    'yearPaid' => strval($yearPaid),
                ]);
            }

            Alert::success('Success', 'Success Menambah Data');
            return redirect()->back();
        }
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
        // Ambil data dari Firestore berdasarkan ID
        $docRef = app('firebase.firestore')->database()->collection('users')->document($id);
        $docSnapshot = $docRef->snapshot();

        $documentRef = app('firebase.firestore')->database()->collection('class');
        $asu = $documentRef->where('companyBranch', '=', $request->companyBranch);
        $query = $asu->documents();
        // $documentSnapshot = $query->snapshot(['fieldMask' => ['companyBranch', 'blcClass']]);
        // Periksa apakah data ditemukan
        // dd($query);
        if ($docSnapshot->exists()) {

            $child = [
                'childNumber' => $request->input('childNumber'),
                'numberOfSiblings' => $request->input('numberOfSiblings'),
            ];

            $class = [
                $request->blcClass,
                $request->blcClass2,
            ];
            $docRef->update([
                ['path' => 'name', 'value' => $request->name],
                ['path' => 'placeAndDateOfBirth', 'value' => $request->placeAndDateOfBirth],
                ['path' => 'gender', 'value' => $request->gender],
                ['path' => 'religion', 'value' => $request->religion],
                ['path' => 'child', 'value' => $child], // Update the 'child' field
                ['path' => 'class', 'value' => $request->class],
                ['path' => 'school', 'value' => $request->school],
                ['path' => 'phoneNumber', 'value' => $request->phoneNumber],
                ['path' => 'parentName', 'value' => $request->parentName],
                ['path' => 'parentPhoneNumber', 'value' => $request->parentPhoneNumber],
                ['path' => 'parentJob', 'value' => $request->parentJob],
                ['path' => 'homeAddress', 'value' => $request->homeAddress],
                ['path' => 'homePhoneNumber', 'value' => $request->homePhoneNumber],
                // ['path' => 'nisBlc', 'value' => $request->nisBlc],
                ['path' => 'companyBranch', 'value' => $request->companyBranch],
                ['path' => 'blcClass', 'value' => $class],
                ['path' => 'reference', 'value' => $request->reference],
            ]);

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            Alert::success('Success', 'Success Mengupdate Data');
            return redirect()->back();
        } else {

            Alert::error('Error', 'Data tidak ditemukan.');
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
        app('firebase.firestore')->database()->collection('users')->document($id)->delete();
        Alert::success('Success', 'Success Menghapus Data');
        return redirect()->back();
    }

    public function get_class($companyBranch)
    {
        try {
            $documentRef = app('firebase.firestore')->database()->collection('class');
            $query = $documentRef->where('companyBranch', '=', $companyBranch);

            // Eksekusi query dan dapatkan hasilnya
            $querySnapshot = $query->documents();

            // Inisialisasi array untuk menyimpan data dari masing-masing dokumen
            $results = [];

            // Loop melalui hasil dan tambahkan data dari masing-masing dokumen ke dalam array
            foreach ($querySnapshot as $document) {
                $data = $document->data();

                $className = $data['className'];

                $results[] = $className;
            }

            return $results;
        } catch (\Exception $e) {
            error_log('Error in get_meeting_per_weeks: ' . $e->getMessage());

            return [];
        }
    }
}
