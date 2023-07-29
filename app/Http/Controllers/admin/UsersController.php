<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use PhpParser\Node\Expr\BinaryOp\Equal;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = app('firebase.firestore')->database()->collection('users');
        $query = $users->where('role', '=', 'admin', 'manager', 'director');
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
        if ($request->doc_id == null) {
            // Validasi Data
            $request->validate([]);

            // Autentikasi dengan Firebase
            $firebaseAuth = app('firebase.auth');
            $user = $firebaseAuth->getUserByEmailAndPassword($request->nik . '@blc.com', $request->nip);

            if ($user) {
                // Autentikasi pengguna berhasil, lanjutkan menyimpan data
                $role = $request->role; // Anda mungkin ingin memvalidasi peran disini untuk mencegah perubahan peran yang tidak diizinkan

                // Simpan data ke Firebase
                $stuRef = app('firebase.firestore')->database()->collection('users')->newDocument();
                $stuRef->set([
                    'nik' => $request->nik,
                    'nip' => $request->nip,
                    'initials' => $request->initials,
                    'name' => $request->name,
                    'role' => $role,
                    'phoneNumber' => $request->phoneNumber,
                    'address' => $request->address,
                    'placeAndDateOfBirth' => $request->placeAndDateOfBirth,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                ]);

                Alert::success('Success', 'Berhasil Menambah Data');
                return redirect()->back();
            } else {
                // Autentikasi gagal, tampilkan pesan kesalahan atau arahkan ke halaman login
                return redirect()->route('login')->with('error', 'Kredensial tidak valid');
            }
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
        //
    }
}
