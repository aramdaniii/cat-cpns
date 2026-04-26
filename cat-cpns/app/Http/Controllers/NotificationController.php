<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\TestSession;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display user's notifications
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        $unreadCount = Notification::getUnreadCount(Auth::id());

        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification)
    {
        // Check if notification belongs to user
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::markAllAsRead(Auth::id());

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Get unread notifications count (for AJAX)
     */
    public function getUnreadCount()
    {
        $count = Notification::getUnreadCount(Auth::id());
        
        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications (for dropdown)
     */
    public function getRecentNotifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->unread()
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'notifications' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'icon' => $notification->icon,
                    'color' => $notification->color,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'data' => $notification->data,
                ];
            })
        ]);
    }

    /**
     * Create test reminder notification
     */
    public static function createTestReminder(TestSession $session)
    {
        // Only create reminder if test is still active and not completed
        if ($session->status === 'completed') {
            return null;
        }

        // Check if reminder already exists for this session
        $existingReminder = Notification::where('user_id', $session->user_id)
            ->where('type', 'test_reminder')
            ->where('data->test_session_id', $session->id)
            ->where('created_at', '>', now()->subHours(2))
            ->first();

        if ($existingReminder) {
            return $existingReminder;
        }

        return Notification::createTestReminder($session->user_id, $session);
    }

    /**
     * Create test completion notification
     */
    public static function createTestCompletedNotification(TestSession $session)
    {
        // Only create notification for completed tests
        if ($session->status !== 'completed') {
            return null;
        }

        try {
            // Check if notification already exists
            $existingNotification = Notification::where('user_id', $session->user_id)
                ->where('type', 'test_completed')
                ->where('data->test_session_id', $session->id)
                ->first();

            if ($existingNotification) {
                return $existingNotification;
            }

            return Notification::createTestCompleted($session->user_id, $session);
        } catch (\Exception $e) {
            // Log error but don't break the test completion flow
            \Log::error('Failed to create test completion notification: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create certificate issued notification
     */
    public static function createCertificateIssuedNotification(Certificate $certificate)
    {
        try {
            return Notification::createCertificateIssued($certificate->user_id, $certificate);
        } catch (\Exception $e) {
            // Log error but don't break the certificate generation flow
            \Log::error('Failed to create certificate notification: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create certificate expiring soon notifications (batch job)
     */
    public static function createCertificateExpiringNotifications()
    {
        $certificates = Certificate::expiringSoon()->get();

        foreach ($certificates as $certificate) {
            // Check if notification already exists
            $existingNotification = Notification::where('user_id', $certificate->user_id)
                ->where('type', 'certificate_expiring')
                ->where('data->certificate_id', $certificate->id)
                ->where('created_at', '>', now()->subDays(7))
                ->first();

            if (!$existingNotification) {
                Notification::createCertificateExpiringSoon($certificate->user_id, $certificate);
            }
        }
    }

    /**
     * Delete notification
     */
    public function destroy(Notification $notification)
    {
        // Check if notification belongs to user
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->delete();

        return back()->with('success', 'Notifikasi telah dihapus.');
    }

    /**
     * Get notification statistics (admin only)
     */
    public function statistics()
    {
        $totalNotifications = Notification::count();
        $unreadNotifications = Notification::where('is_read', false)->count();
        $readNotifications = Notification::where('is_read', true)->count();

        $notificationsByType = Notification::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $notificationsByChannel = Notification::selectRaw('channel, COUNT(*) as count')
            ->groupBy('channel')
            ->pluck('count', 'channel')
            ->toArray();

        $recentNotifications = Notification::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.notifications.statistics', compact(
            'totalNotifications',
            'unreadNotifications',
            'readNotifications',
            'notificationsByType',
            'notificationsByChannel',
            'recentNotifications'
        ));
    }
}
