<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = app('firebase.firestore')->database()->collection('class')->documents();
        $program = app('firebase.firestore')->database()->collection('program')->documents();
        $cabang = app('firebase.firestore')->database()->collection('companyBranch')->documents();
        return view('admin.kelas.index', compact('kelas', 'program', 'cabang'));
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
            $documentRef = app('firebase.firestore')->database()->collection('program')->document($request->program);
            $documentSnapshot = $documentRef->snapshot(['fieldMask' => ['name', 'meetingsPerWeek']]);
            // dd($request->program);

            // Upload Data
            // $request->validate([
            //     'className' => 'required',
            //     'schoolLevel' => 'required',
            //     'program' => 'required',
            //     'meetingsPerWeek' => 'required',
            //     'companyBranch' => 'required',
            // ]);


            // Simpan data ke Firebase
            $stuRef = app('firebase.firestore')->database()->collection('class')->newDocument();
            $stuRef->set([
                'className' => $request->className,
                'schoolLevel' => $request->schoolLevel,
                'program' => $documentSnapshot->data()['name'],
                'meetingsPerWeek' => $documentSnapshot->data()['meetingsPerWeek'],
                'companyBranch' => $request->companyBranch,
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
        $docRef = app('firebase.firestore')->database()->collection('class')->document($id);
        $docSnapshot = $docRef->snapshot();

        $documentRef = app('firebase.firestore')->database()->collection('program')->document($request->program);
        $documentSnapshot = $documentRef->snapshot(['fieldMask' => ['name', 'meetingsPerWeek']]);

        // Periksa apakah data ditemukan
        if ($docSnapshot->exists()) {
            // Data ditemukan, update data di Firestore berdasarkan data yang dikirim melalui form
            $docRef->update([
                ['path' => 'className', 'value' => $request->className],
                ['path' => 'schoolLevel', 'value' => $request->schoolLevel],
                ['path' => 'program', 'value' => $documentSnapshot->data()['name']],
                ['path' => 'meetingsPerWeek', 'value' => $documentSnapshot->data()['meetingsPerWeek']],
                ['path' => 'companyBranch', 'value' => $request->companyBranch],
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
        app('firebase.firestore')->database()->collection('class')->document($id)->delete();
        Alert::success('Success', 'Success Menghapus Data');
        return redirect()->back();
    }

    public function get_meeting_per_weeks($program_id)
    {
        try {
            $documentRef = app('firebase.firestore')->database()->collection('program')->document($program_id);
            $documentSnapshot = $documentRef->snapshot(['fieldMask' => ['meetingsPerWeek']]);
            return $documentSnapshot->data()['meetingsPerWeek'];
        } catch (\Exception $e) {
            error_log('Error in get_meeting_per_weeks: ' . $e->getMessage());
        }
    }
}
