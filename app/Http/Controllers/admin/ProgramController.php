<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $program = app('firebase.firestore')->database()->collection('program')->documents();
        return view('admin.program.index', compact('program'));
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
                // 'paymentType' => 'required',
                'price' => 'required',
                'meetingsPerWeek' => 'required',
            ]);


            // Simpan data ke Firebase
            $stuRef = app('firebase.firestore')->database()->collection('program')->newDocument();
            $stuRef->set([
                'name' => $request->name,
                // 'paymentType' => $request->paymentType,
                'price' => $request->price,
                'meetingsPerWeek' => $request->meetingsPerWeek,
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
        $docRef = app('firebase.firestore')->database()->collection('program')->document($request->program);
        $docSnapshot = $docRef->snapshot();

        // Periksa apakah data ditemukan
        if ($docSnapshot->exists()) {
            // Data ditemukan, update data di Firestore berdasarkan data yang dikirim melalui form
            $docRef->update([
                ['path' => 'name', 'value' => $request->name],
                // ['path' => 'paymentType', 'value' => $request->paymentType],
                ['path' => 'price', 'value' => $request->price],
                ['path' => 'meetingsPerWeek', 'value' => $request->meetingsPerWeek],
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
        app('firebase.firestore')->database()->collection('program')->document($id)->delete();
        Alert::success('Success', 'Success Menghapus Data');
        return redirect()->back();
    }
}
