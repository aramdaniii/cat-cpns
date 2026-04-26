<?php

if (!function_exists('isAdmin')) {
    function isAdmin($user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }
        return $user && $user->role === 'admin';
    }
}

if (!function_exists('isUser')) {
    function isUser($user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }
        return $user && $user->role === 'user';
    }
}

if (!function_exists('userRole')) {
    function userRole($user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }
        return $user ? $user->role : 'guest';
    }
}

if (!function_exists('roleBadge')) {
    function roleBadge($user = null)
    {
        $role = userRole($user);
        
        return match($role) {
            'admin' => '<span class="badge bg-danger">Admin</span>',
            'user' => '<span class="badge bg-primary">User</span>',
            'guest' => '<span class="badge bg-secondary">Guest</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }
}
