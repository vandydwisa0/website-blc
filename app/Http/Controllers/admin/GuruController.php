<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Kreait\Laravel\Firebase\Facades\FirebaseStorage;
// use Kreait\Firebase\Storage;
use Kreait\Firebase\Storage\CloudStorage;
use Google\Cloud\Storage\StorageClient;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = app('firebase.firestore')->database()->collection('teachers')->documents();
        return view('admin.guru.index', compact('guru'));
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
    // Method untuk mendapatkan URL gambar dari Firebase Storage
    // public function getPhotoUrl($imagePath)
    // {
    //     // Dapatkan Cloud Storage dari Firebase
    //     $storage = app('firebase.storage');

    //     // Buat referensi ke file gambar yang diunggah
    //     $fileReference = $storage->getBucket()->object($imagePath);

    //     // Dapatkan URL gambar dari metadata file
    //     $metadata = $fileReference->info();
    //     $photoUrl = $metadata['gs://bimbel-blc.appspot.com'];

    //     return $photoUrl;
    // }


    public function store(Request $request)
    {
        // Validasi Data
        $request->validate([
            'initials' => 'required',
            'education' => 'required|array',
            // 'education.*' => 'string', // Validate each item in the education array
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'required',
            'teachingAbility' => 'required|array',
            'teachingAbility.SD' => 'array', // Validate SD subarray
            'teachingAbility.SMP' => 'array', // Validate SMP subarray
            'teachingAbility.SMA' => 'array', // Validate SMA subarray
            'teachingAbility.SD.*' => 'string', // Validate each item in SD subarray
            'teachingAbility.SMP.*' => 'string', // Validate each item in SMP subarray
            'teachingAbility.SMA.*' => 'string', // Validate each item in SMA subarray
        ]);

        // Simpan gambar yang diunggah
        $imagePath = $request->file('photo')->store('guru_photos', 'public');
        // $photoUrl = Storage::url('teachers/023b9619da2340c1b567/photo' . basename($imagePath));

        // Menggabungkan kemampuan mengajar untuk setiap tingkatan menjadi string terpisah koma
        $teachingAbilitySD = implode(', ', $request->input('teachingAbility.SD', []));
        $teachingAbilitySMP = implode(', ', $request->input('teachingAbility.SMP', []));
        $teachingAbilitySMA = implode(', ', $request->input('teachingAbility.SMA', []));

        // Menggabungkan riwayat pendidikan menjadi format yang diinginkan
        $education = implode(PHP_EOL . ' ', $request->input('education', []));




        // Dapatkan URL gambar dari Firebase Storage
        // $photoUrl = $this->getPhotoUrl($imagePath);

        // Simpan data ke Firebase
        $stuRef = app('firebase.firestore')->database()->collection('users')->newDocument();
        $stuRef->set([
            'initials' => $request->initials,
            'education' => [$education],
            'name' => $request->name,
            'photo' => $imagePath,
            'specialization' => $request->specialization,
            'teachingAbility' => [
                'SD' => $teachingAbilitySD,
                'SMP' => $teachingAbilitySMP,
                'SMA' => $teachingAbilitySMA,
            ],
        ]);

        // Update data di Firestore dengan URL gambar
        // $stuRef->update([
        //     'photo_url' => $photoUrl, // Save the photo URL in Firestore
        // ]);
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
    // public function update(Request $request, $id)
    // {
    //     // Ambil data dari Firestore berdasarkan ID
    //     $docRef = app('firebase.firestore')->database()->collection('teachers')->document($id);
    //     $docSnapshot = $docRef->snapshot();

    //     // Periksa apakah data ditemukan
    //     if ($docSnapshot->exists()) {
    //         // Validasi data yang dikirim melalui form
    //         $request->validate([
    //             'initials' => 'required',
    //             'lastEducation' => 'required',
    //             'name' => 'required',
    //             'specialization' => 'required',
    //             'teachingAbility' => 'required|array',
    //         ]);

    //         // Ambil data sebelumnya dari Firestore
    //         $data = $docSnapshot->data();

    //         // Simpan data yang diunggah
    //         if ($request->hasFile('photo')) {
    //             $request->validate([
    //                 'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //             ]);

    //             // Hapus photo sebelumnya dari Firebase Storage
    //             if (isset($data['photo'])) {
    //                 Storage::disk('public')->delete($data['photo']);
    //             }

    //             // Simpan photo baru ke Firebase Storage
    //             $imagePath = $request->file('photo')->store('guru_photos', 'public');
    //         } else {
    //             // Jika tidak ada perubahan photo, gunakan photo yang sebelumnya
    //             $imagePath = $data['photo'] ?? null;
    //         }

    //         // Konversi array teachingAbility yang dipilih menjadi string dipisahkan koma
    //         $teachingAbility = implode(',', $request->teachingAbility);

    //         // Update data di Firestore berdasarkan data yang dikirim melalui form
    //         $docRef->update([
    //             ['path' => 'inisials', 'value' => $request->inisial],
    //             ['path' => 'lastEducation', 'value' => $request->lastEducation],
    //             ['path' => 'name', 'value' => $request->name],
    //             ['path' => 'photo', 'value' => $imagePath],
    //             ['path' => 'specialization', 'value' => $request->specialization],
    //             ['path' => 'teachingAbility', 'value' => $teachingAbility],
    //         ]);

    //         // Redirect kembali ke halaman sebelumnya dengan pesan sukses
    //         Alert::success('Success', 'Success Mengupdate Data');
    //         return redirect()->back();
    //     } else {
    //         // Data tidak ditemukan, redirect atau tampilkan pesan error
    //         return redirect()->back()->with('error', 'Data not found');
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('teachers')->document($id)->delete();
        Alert::success('Success', 'Success Menghapus Data');
        return redirect()->back();
    }
}
