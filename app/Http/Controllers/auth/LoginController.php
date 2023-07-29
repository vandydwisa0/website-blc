<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Kreait\Firebase\Auth;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        $staff = app('firebase.firestore')->database()->collection('users')->documents();
        return view('auth.login', compact('staff'));
    }

    public function login(Request $request)
    {
        // $email = $request->input('nik');
        // $password = $request->input('nip');
        // $response = $this->login->signInWithEmailAndPassword($email, $password);
        $request->validate([
            'nik' => 'required',
            'nip' => 'required',
        ]);

        $firebaseAuth = app('firebase.auth');

        try {
            // Gunakan metode signInWithEmailAndPassword() untuk melakukan otentikasi berdasarkan email dan kata sandi
            $firebaseAuth->signInWithEmailAndPassword($request->nik . '@blc.com', $request->nip);

            $userID = $firebaseAuth->firebaseUserId();
            Session::put('user_id', $userID);
            // Jika berhasil masuk, Anda tidak perlu melakukan getUserByEmailAndPassword() lagi karena signInWithEmailAndPassword()
            // sudah mengembalikan objek User yang sesuai.

            // Autentikasi berhasil
            // Lakukan tindakan yang diperlukan seperti menyimpan data ke sesi atau membuat token akses

            // Redirect ke dashboard atau halaman yang sesuai berdasarkan peran pengguna
            Alert::success('Success', 'Berhasil Login');
            return redirect()->route('dashboard');
        } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            // Autentikasi gagal
            Alert::error('Gagal', 'Gagal Login');
            return redirect()->route('login');
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            // Pengguna tidak ditemukan di Firebase, berarti akun belum didaftarkan
            Alert::error('Gagal', 'ID Tidak Terdaftar');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        // Lakukan tindakan logout seperti menghapus sesi atau token akses

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }
}
