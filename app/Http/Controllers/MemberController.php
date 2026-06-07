<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('members.member', compact('members'));
    }

    public function invite(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $invitedUser = User::where('email', $validated['email'])->first();

        if ($invitedUser->id === Auth::id()) {
            return back()->withErrors([
                'email' => 'Kamu tidak bisa invite akun sendiri.',
            ]);
        }

        Member::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'member_id' => $invitedUser->id,
            ],
            [
                'role' => 'member',
            ]
        );

        return back();
    }
}