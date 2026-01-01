<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'date_of_appointment' => 'nullable|date',
            'grade_level' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
            'retirement_year' => 'nullable|string|max:4',
        ]);

        $user = Auth::user();

        MemberProfile::updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'phone',
                'address',
                'occupation',
                'date_of_birth',
                'gender',
                'date_of_appointment',
                'grade_level',
                'department',
                'retirement_year',
            ])
        );

        return back()->with('status', 'profile-updated');
    }
}
