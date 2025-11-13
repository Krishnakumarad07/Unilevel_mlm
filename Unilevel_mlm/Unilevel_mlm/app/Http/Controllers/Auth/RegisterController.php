<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm(Request $request)
    {
        $ref = $request->query('ref'); 
        return view('register', compact('ref'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'referral_code' => 'nullable|exists:users,referral_code',
        ]);

        $referrer = null;
        $level = 0;

        if ($request->referral_code) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
            if ($referrer) {
                $level = $referrer->level + 1;
            }
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referred_by' => $referrer?->id,
            'level' => $level,
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully!');
    }
}
