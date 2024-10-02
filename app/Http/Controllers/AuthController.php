<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\Auth as FirebaseAuth;
// use Kreait\Firebase\Exception\InvalidToken;  // Correct import

// class AuthController extends Controller
// {
//     protected $firebase;

    // public function __construct()
    // {
    //     // Initialize Firebase Authentication
    //     $this->firebase = (new Factory)
    //         ->withServiceAccount(storage_path('app/firebase-auth.json'))
    //         ->createAuth();
    // }

    // public function create(Request $request)
    // {
    //     $idToken = $request->input('token');  // Get the token from request
        
    //     if (!$idToken || !is_string($idToken)) {
    //         return redirect()->back()->with([
    //             'message' => 'Invalid token',
    //             'type' => 'danger'
    //         ]);
    //     }

    //     try {
    //         // Verify the Firebase token
    //         Log::info('ID Token:', ['token' => $idToken]);  // Log the token for debugging
    //         $verifiedIdToken = $this->firebase->verifyIdToken($idToken);

    //         Log::info('Verified Token:', ['verified_token' => $verifiedIdToken]);

    //         // Extract Firebase UID (user ID) from the token
    //         $firebaseUid = $verifiedIdToken->claims()->get('sub');

    //         // Extract email from token
    //         $email = $verifiedIdToken->claims()->get('email');
    //         if (!$email) {
    //             throw new \Exception('Email not found in Firebase token');
    //         }

    //         // Check if user exists in local database by Firebase UID
    //         $user = User::where('firebase_uid', $firebaseUid)->first();

    //         if (!$user) {
    //             Log::info('Creating new user in the database');
    //             // Create a new user if they don't exist
    //             $user = User::create([
    //                 'name' => $request->input('name'),  // Check if this is being sent from the frontend
    //                 'email' => $email,
    //                 'firebase_uid' => $firebaseUid
    //             ]);
    //         }

    //         // Log in the user
    //         Auth::login($user);

    //         return redirect()->route('home')->with([
    //             'message' => 'You are welcome',
    //             'type' => 'success'
    //         ]);
    //     } catch (InvalidToken $e) {
    //         Log::error('Invalid Firebase token', ['exception' => $e->getMessage()]);
    //         return redirect()->back()->with([
    //             'message' => 'Invalid Firebase token',
    //             'type' => 'danger'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Error during token verification or user creation', ['exception' => $e->getMessage()]);
    //         return redirect()->back()->with([
    //             'message' => 'Token verification failed',
    //             'type' => 'danger'
    //         ]);
    //     }
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email', 'max:255'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials, $request->remember)) {
    //         return redirect()->intended('/')->with([
    //             'message' => 'You are Successfully login',
    //             'type' => 'success'
    //         ]);
    //     }
    //     return back()->withErrors(['email' => 'Email is not existed']);
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect()->route('login');
    // }
// }



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\InvalidToken;

class AuthController extends Controller
{
    protected $firebase;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase-auth.json'))
            ->createAuth();
    }

    public function create(Request $request)
    {
        $idToken = $request->input('token');  // Get the token from request
        
        if (!$idToken || !is_string($idToken)) {
            return redirect()->back()->with([
                'message' => 'Invalid token',
                'type' => 'danger'
            ]);
        }

        try {
            Log::info('ID Token:', ['token' => $idToken]);  
            $verifiedIdToken = $this->firebase->verifyIdToken($idToken);

            Log::info('Verified Token:', ['verified_token' => $verifiedIdToken]);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');
            $email = $verifiedIdToken->claims()->get('email');

            if (!$email) {
                throw new \Exception('Email not found in Firebase token');
            }
            session(['firebase_uid' => $firebaseUid]);

            return redirect()->route('home')->with([
                'message' => 'You are authenticated via Firebase',
                'type' => 'success'
            ]);
            Auth::login($user);

        } catch (InvalidToken $e) {
            Log::error('Invalid Firebase token', ['exception' => $e->getMessage()]);
            return redirect()->back()->with([
                'message' => 'Invalid Firebase token',
                'type' => 'danger'
            ]);
        }
    }
}





 

