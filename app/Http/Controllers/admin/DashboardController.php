<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Jumlah Staff
        $usersCollection = app('firebase.firestore')->database()->collection('users');
        $query = $usersCollection->where('role', '!=', 'siswa');
        $querySnapshot = $query->documents();
        $numberOfUsers = $querySnapshot->size();

        // Jumlah Siswa
        $siswaCollection = app('firebase.firestore')->database()->collection('users');
        $query = $siswaCollection->where('role', '=', 'siswa');
        $querySnapshot = $query->documents();
        $numberOfSiswa = $querySnapshot->size();

        // Jumlah Kelass
        $kelasCollection = app('firebase.firestore')->database()->collection('class');
        $querySnapshot = $kelasCollection->documents();
        $numberOfKelas = $querySnapshot->size();
        // Jumlah Program
        $programCollection = app('firebase.firestore')->database()->collection('program');
        $querySnapshot = $programCollection->documents();
        $numberOfProgram = $querySnapshot->size();
        // Jumlah Cabang
        $cabangCollection = app('firebase.firestore')->database()->collection('companyBranch');
        $querySnapshot = $cabangCollection->documents();
        $numberOfCabang = $querySnapshot->size();
        return view('admin.dashboard.index', compact(
            'numberOfUsers',
            'numberOfSiswa',
            'numberOfKelas',
            'numberOfProgram',
            'numberOfCabang',
        ));
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
        //
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
        //
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
