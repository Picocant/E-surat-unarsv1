<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SignatureController extends Controller
{
    public function check(Signature $signature)
    {
        $payload = json_decode($signature->payload, true);

        return view('signature.check', ['payload' => $payload]);
    }

    public function by(Request $request, User $user)
    {
        $token = $request->get('token');

        if (!$token) {
            return view('signature.invalid');
        }

        $decoded = json_decode(base64_decode($token));

        if ($decoded->uid !== $user->id) {
            return view('signature.invalid');
        }

        return view('signature.by', ['user' => $user, 'details' => $decoded->details]);
    }
}
