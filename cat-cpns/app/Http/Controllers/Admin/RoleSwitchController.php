<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleSwitchController extends Controller
{
    /**
     * Show role switch interface.
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.roleswitch.index', compact('users'));
    }

    /**
     * Switch to another user's account (for testing).
     */
    public function switchTo(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $targetUser = User::findOrFail($request->user_id);

        // Store original user ID in session
        session(['original_user_id' => auth()->id()]);
        
        // Logout current user and login as target user
        auth()->logout();
        auth()->login($targetUser);

        return redirect()->route('dashboard')
            ->with('success', "Switched to {$targetUser->name}'s account. Role: {$targetUser->role}");
    }

    /**
     * Switch back to original admin account.
     */
    public function switchBack()
    {
        $originalUserId = session('original_user_id');
        
        if ($originalUserId) {
            $originalUser = User::findOrFail($originalUserId);
            
            auth()->logout();
            auth()->login($originalUser);
            
            session()->forget('original_user_id');
            
            return redirect()->route('admin.dashboard')
                ->with('success', 'Switched back to admin account');
        }

        return redirect()->route('admin.dashboard')
            ->with('error', 'No original admin session found');
    }
}
