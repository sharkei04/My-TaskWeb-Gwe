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
        $admin = Auth::user();

        $members = Member::with('member')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $totalMembers = $members->count() + 1;

        return view('members.member', compact('admin', 'members', 'totalMembers'));
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