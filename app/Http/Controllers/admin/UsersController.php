<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use PhpParser\Node\Expr\BinaryOp\Equal;
use RealRashid\SweetAlert\Facades\Alert;
use Kreait\Firebase\Exception\FirebaseException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        $users = app('firebase.firestore')->database()->collection('users');
        $query = $users->where('role', '!=', 'siswa');
        $snapshot = $query->documents();
        return view('admin.users.index', compact('snapshot'));
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
    // public function store(Request $request)
    // {
    //     if ($request->doc_id == null) {
    //         // Uplode Data
    //         $request->validate([]);


    //         // Simpan data ke Firebase
    //         $stuRef = app('firebase.firestore')->database()->collection('users')->newDocument();
    //         $stuRef->set([
    //             'nik' => $request->nik,
    //             'nip' => $request->nip,
    //             'initials' => $request->initials,
    //             'name' => $request->name,
    //             'role' => $request->role,
    //             'phoneNumber' => $request->phoneNumber,
    //             'address' => $request->address,
    //             'placeAndDateOfBirth' => $request->placeAndDateOfBirth,
    //             'gender' => $request->gender,
    //             'religion' => $request->religion,
    //         ]);

    //         Alert::success('Success', 'Success Menambah Data');
    //         return redirect()->back();
    //     }
    // }


    public function store(Request $request)
    {
        try {

            $userProperties = [
                'email' => $request->email,
                'emailVerified' => true,
                'password' => $request->nip,
                'displayName' => "", // bisa jadi mun aya valuean te bisa assup
            ];

            $createUserAccount = $this->auth->createUser($userProperties);

            $userProperties = [
                'email' => $request->email,
                'emailVerified' => true,
                'nik' => $request->nik,
                'nip' => $request->nip,
                'initials' => $request->initials,
                'name' => $request->name,
                'role' => $request->role,
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'placeAndDateOfBirth' => $request->placeAndDateOfBirth,
                'gender' => $request->gender,
                'religion' => $request->religion,
            ];

            $createUser = app('firebase.firestore')->database()->collection('users')->document($createUserAccount->uid);
            $createUser->set($userProperties);

            return redirect()->back();
        } catch (FirebaseException $e) {
            // bere alert amun gagal
            Alert::error('error', 'Aya nu error fieldna');
            return back()->withInput();
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

        // Periksa apakah data ditemukan
        if ($docSnapshot->exists()) {
            // Data ditemukan, update data di Firestore berdasarkan data yang dikirim melalui form
            $docRef->update([
                ['path' => 'nik', 'value' => $request->nik],
                ['path' => 'nip', 'value' => $request->nip],
                ['path' => 'initials', 'value' => $request->initials],
                ['path' => 'name', 'value' => $request->name],
                ['path' => 'role', 'value' => $request->role],
                ['path' => 'phoneNumber', 'value' => $request->phoneNumber],
                ['path' => 'address', 'value' => $request->address],
                ['path' => 'placeAndDateOfBirth', 'value' => $request->placeAndDateOfBirth],
                ['path' => 'gender', 'value' => $request->gender],
                ['path' => 'religion', 'value' => $request->religion],
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
    }
}
