<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\DocumentSnapshot;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\DatabaseException;
use Kreait\Firebase\Firestore;
use RealRashid\SweetAlert\Facades\Alert;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = app('firebase.firestore')->database()->collection('users')->documents();
        return view('admin.pengguna.index', compact('users'));
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
            // Uplode Data
            $request->validate([
                'name' => 'required',
                'placeAndDateOfBirth' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'class' => 'required',
                'school' => 'required',
                'phoneNumber' => 'required',
                'parentName' => 'required',
                'parentPhoneNumber' => 'required',
                'parentJob' => 'required',
                'homeAddress' => 'required',
                'homePhoneNumber' => 'required',
                'nisBlc' => 'required',
                'blcClass' => 'required',
                'reference' => 'required',
            ]);

            $child = [
                'childNumber' => $request->input('childNumber'),
                'numberOfSiblings' => $request->input('numberOfSiblings'),
            ];

            // Simpan data ke Firebase
            $stuRef = app('firebase.firestore')->database()->collection('users')->newDocument();
            $stuRef->set([
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
                'nisBlc' => $request->nisBlc,
                'blcClass' => $request->blcClass,
                'reference' => $request->reference,
            ]);

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

        // Periksa apakah data ditemukan
        if ($docSnapshot->exists()) {
            // Data ditemukan, update data di Firestore berdasarkan data yang dikirim melalui form

            $child = [
                'childNumber' => $request->input('childNumber'),
                'numberOfSiblings' => $request->input('numberOfSiblings'),
            ];

            $docRef->update([
                ['path' => 'name', 'value' => $request->name],
                ['path' => 'placeAndDateOfBirth', 'value' => $request->placeAndDateOfBirth],
                ['path' => 'gender', 'value' => $request->gender],
                ['path' => 'religion', 'value' => $request->religion],
                ['path' => 'child', 'value' => $child],
                ['path' => 'class', 'value' => $request->class],
                ['path' => 'school', 'value' => $request->school],
                ['path' => 'phoneNumber', 'value' => $request->phoneNumber],
                ['path' => 'parentName', 'value' => $request->parentName],
                ['path' => 'parentPhoneNumber', 'value' => $request->parentPhoneNumber],
                ['path' => 'parentJob', 'value' => $request->parentJob],
                ['path' => 'homeAddress', 'value' => $request->homeAddress],
                ['path' => 'homePhoneNumber', 'value' => $request->homePhoneNumber],
                ['path' => 'nisBlc', 'value' => $request->nisBlc],
                ['path' => 'blcClass', 'value' => $request->blcClass],
                ['path' => 'reference', 'value' => $request->reference],
            ]);

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            Alert::success('Success', 'Success Mengupdate Data');
            return redirect()->back();
        } else {
            // Data tidak ditemukan, berikan nilai default untuk objek $item atau tampilkan pesan error
            // Atau bisa juga melakukan redirect kembali ke halaman sebelumnya dengan pesan error
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
}
