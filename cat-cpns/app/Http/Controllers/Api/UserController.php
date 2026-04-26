<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get user profile
     */
    public function profile()
    {
        $user = Auth::user();
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required_with:new_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ], 422);
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }

    /**
     * Get user statistics
     */
    public function statistics()
    {
        $user = Auth::user();
        
        $testSessions = $user->testSessions()->where('status', 'completed')->get();
        $certificates = $user->certificates;
        
        $stats = [
            'total_tests' => $testSessions->count(),
            'passed_tests' => $testSessions->filter(function ($session) {
                $percentage = $session->total_questions > 0 ? ($session->score / $session->total_questions) * 100 : 0;
                return $percentage >= 65;
            })->count(),
            'total_certificates' => $certificates->count(),
            'valid_certificates' => $certificates->filter(function ($cert) {
                return $cert->isValid();
            })->count(),
            'average_score' => $testSessions->avg('score'),
            'best_score' => $testSessions->max('score'),
            'tests_by_category' => $testSessions->groupBy('kategori')->map->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
