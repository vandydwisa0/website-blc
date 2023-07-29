<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = app('firebase.firestore')->database()->collection('schedule')->documents();
        return view('admin.jadwal.index', compact('jadwal'));
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
    public function store(Request $request, $projectId)
    {
        // Validate the request
        $request->validate([
            'className' => 'required',
            'schoolLevel' => 'required',
            'program' => 'required',
            'meetingsPerWeek' => 'required',
            'companyBranch' => 'required',
            'teachers' => 'required', // Assuming 'guru' is the name of the select input in your form
        ]);

        // Create the Cloud Firestore client
        $db = new FirestoreClient([
            'projectId' => $projectId,
        ]);
        # [START firestore_data_get_all_documents]
        $teacherRef = $db->collection('teachers');
        $documents = $teacherRef->documents();
        foreach ($documents as $document) {
            if ($document->exists()) {
                printf('Document data for document %s:' . PHP_EOL, $document->id());
                print_r($document->data());
                printf(PHP_EOL);
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $document->id());
            }
        }
        # [END firestore_data_get_all_documents]

        // Simpan data ke Firebase
        $stuRef = app('firebase.firestore')->database()->collection('schedule')->newDocument();
        $stuRef->set([
            'className' => $request->className,
            'schoolLevel' => $request->schoolLevel,
            'program' => $request->program,
            'meetingsPerWeek' => $request->meetingsPerWeek,
            'companyBranch' => $request->companyBranch,
            'teachers' => $request->teachers, // Store the selected Guru name in the 'teacher' field.
        ]);

        // Other code for success handling, e.g., flash message
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
        // Ambil data dari Firestore berdasarkan ID
        $docRef = app('firebase.firestore')->database()->collection('schedule')->document($id);
        $docSnapshot = $docRef->snapshot();

        // Periksa apakah data ditemukan
        if ($docSnapshot->exists()) {
            // Data ditemukan, update data di Firestore berdasarkan data yang dikirim melalui form
            $docRef->update([
                ['path' => 'className', 'value' => $request->className],
                ['path' => 'schoolLevel', 'value' => $request->schoolLevel],
                ['path' => 'program', 'value' => $request->program],
                ['path' => 'meetingsPerWeek', 'value' => $request->meetingsPerWeek],
                ['path' => 'companyBranch', 'value' => $request->companyBranch],
                ['path' => 'teachers', 'value' => $request->teachers],
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

    // private function getGurus()
    // {
    //     $response = Http::get(route('admin.guru.index'));
    //     $gurus = $response->json()['guru']; // Make sure to use the correct key for the guru data in the JSON response
    //     return $gurus;
    // }
}
