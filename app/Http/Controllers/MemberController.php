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
        // Ambil user yang sedang login
        $currentUser = Auth::user();

        // Ambil admin dari database berdasarkan kolom role
        // Jadi admin tidak lagi hardcode dari Auth::user()
        $admin = User::where('role', 'admin')->first();

        // Ambil daftar member yang di-invite oleh user login
        $members = Member::with('member')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Hitung total collaborator:
        // 1 admin + jumlah member yang di-invite
        $totalMembers = $members->count() + ($admin ? 1 : 0);

        return view('members.member', compact('admin', 'members', 'totalMembers', 'currentUser'));
    }

    public function invite(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $invitedUser = User::where('email', $validated['email'])->first();

        if ($invitedUser->id === Auth::id()) {
            return back()->withErrors([
                'email' => 'You cannot invite yourself.',
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

        return back()->with('success', 'Member invited successfully.');
    }

    public function destroy(Member $member)
    {
        if ($member->user_id !== Auth::id()) {
            abort(403);
        }

        $member->delete();

        return back()->with('success', 'Member kicked successfully.');
    }

    public function leave(Member $member)
    {
        if ($member->member_id !== Auth::id()) {
            abort(403);
        }

        $member->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'You have left the workspace.');
    }
}