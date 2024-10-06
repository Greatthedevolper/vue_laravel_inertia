<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Kreait\Firebase\Factory;

class AuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->firebaseAuth = $firebase->createAuth();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'token' => 'required',
        ]);
        
        $idToken = $request->input('token');

        try {
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->claims()->get('sub'); 
            // $user = User::where('firebase_uid', $firebaseUid)->first();

            // Auth::login($user);
            session(['firebase_uid' => $firebaseUid]);
            return redirect()->route('login')->with([
                'message' => 'You are authenticated via Firebase',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }
        
    }
}
