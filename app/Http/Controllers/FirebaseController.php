<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $firebase;

    public function __construct()
    {
        $this->firebase = (new Factory)->withServiceAccount(storage_path('app/firebase-auth.json'));
    }

    public function verifyToken(Request $request)
    {
        $idToken = $request->input('token');

        try {
            $auth = $this->firebase->createAuth();
            $verifiedIdToken = $auth->verifyIdToken($idToken);
            return response()->json($verifiedIdToken);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}
