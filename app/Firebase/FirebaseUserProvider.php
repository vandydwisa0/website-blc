<?php

namespace App\Firebase;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;

class FirebaseUserProvider implements UserProvider
{
    protected $hasher;
    protected $model;
    protected $auth;
    public function __construct(HasherContract $hasher, $model)
    {
        $this->model = $model;
        $this->hasher = $hasher;
        $this->auth = app('firebase.auth');
    }
    public function retrieveById($identifier)
    {
        $firebaseUser = $this->auth->getUser($identifier);
        $user = new User([
            'email' => $firebaseUser->email,
            'nik' => $firebaseUser->nik,
            'nip' => $firebaseUser->nip,
            'initials' => $firebaseUser->initials,
            'name' => $firebaseUser->name,
            'role' => $firebaseUser->role,
            'phoneNumber' => $firebaseUser->phoneNumber,
            'address' => $firebaseUser->address,
            'placeAndDateOfBirth' => $firebaseUser->placeAndDateOfBirth,
            'gender' => $firebaseUser->gender,
            'religion' => $firebaseUser->religion,
        ]);
        return $user;
    }
    public function retrieveByToken($identifier, $token)
    {
    }
    public function updateRememberToken(UserContract $user, $token)
    {
    }
    public function retrieveByCredentials(array $credentials)
    {
    }
    public function validateCredentials(UserContract $user, array $credentials)
    {
    }
}
