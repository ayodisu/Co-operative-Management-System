<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'user')->with('profile')->latest()->get();

        return view('admin.members.index', compact('members'));
    }

    public function show(User $member)
    {
        $member->load('profile');

        return view('admin.members.show', compact('member'));
    }

    public function suspend(User $member)
    {
        $member->update([
            'status' => $member->status === 'suspended' ? 'active' : 'suspended'
        ]);

        $message = $member->status === 'suspended' ? 'Member suspended.' : 'Member reactivated.';

        return back()->with('success', $message);
    }

    public function destroy(User $member)
    {
        $member->profile()->delete();

        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member and profile deleted successfully.');
    }

    public function edit(User $member)
    {
        $member->load('profile');
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'monthly_contribution' => 'nullable|numeric|min:0',
            'total_contributions' => 'nullable|numeric|min:0',
        ]);

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $member->profile()->updateOrCreate(
            ['user_id' => $member->id],
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'monthly_contribution' => $request->monthly_contribution ?? 0,
                'total_contributions' => $request->total_contributions ?? 0,
            ]
        );

        return redirect()->route('admin.members.show', $member->id)
            ->with('success', 'Member updated successfully.');
    }
}
