<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
        'sent_at',
        'channel',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'sent_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->is_read = true;
        $this->read_at = now();
        $this->save();
    }

    /**
     * Create notification for test reminder
     */
    public static function createTestReminder($userId, $testSession)
    {
        return self::create([
            'user_id' => $userId,
            'type' => 'test_reminder',
            'title' => 'Reminder: Tes Anda Belum Selesai',
            'message' => "Tes {$testSession->kategori} Anda masih berjalan. Segera selesaikan untuk mendapatkan hasil terbaik.",
            'data' => [
                'test_session_id' => $testSession->id,
                'kategori' => $testSession->kategori,
                'current_question' => $testSession->current_question,
                'total_questions' => $testSession->total_questions,
            ],
            'channel' => 'web',
        ]);
    }

    /**
     * Create notification for test completion
     */
    public static function createTestCompleted($userId, $testSession)
    {
        $percentage = $testSession->total_questions > 0 ? round(($testSession->score / $testSession->total_questions) * 100, 1) : 0;
        $passed = $percentage >= 65;

        return self::create([
            'user_id' => $userId,
            'type' => 'test_completed',
            'title' => $passed ? 'Selamat! Anda Lulus Tes' : 'Tes Selesai',
            'message' => "Tes {$testSession->kategori} Anda telah selesai dengan skor {$testSession->score}/{$testSession->total_questions} ({$percentage}%).",
            'data' => [
                'test_session_id' => $testSession->id,
                'kategori' => $testSession->kategori,
                'score' => $testSession->score,
                'percentage' => $percentage,
                'passed' => $passed,
            ],
            'channel' => 'web',
        ]);
    }

    /**
     * Create notification for certificate issued
     */
    public static function createCertificateIssued($userId, $certificate)
    {
        return self::create([
            'user_id' => $userId,
            'type' => 'certificate_issued',
            'title' => 'Sertifikat Telah Diterbitkan',
            'message' => "Selamat! Sertifikat {$certificate->category} Anda telah diterbitkan. Unduh sertifikat Anda sekarang.",
            'data' => [
                'certificate_id' => $certificate->id,
                'certificate_number' => $certificate->certificate_number,
                'category' => $certificate->category,
                'percentage' => $certificate->percentage,
            ],
            'channel' => 'web',
        ]);
    }

    /**
     * Create notification for certificate expiring soon
     */
    public static function createCertificateExpiringSoon($userId, $certificate)
    {
        return self::create([
            'user_id' => $userId,
            'type' => 'certificate_expiring',
            'title' => 'Sertifikat Akan Kadaluarsa',
            'message' => "Sertifikat {$certificate->category} Anda akan kadaluarsa pada {$certificate->expires_at->format('d F Y')}.",
            'data' => [
                'certificate_id' => $certificate->id,
                'certificate_number' => $certificate->certificate_number,
                'category' => $certificate->category,
                'expires_at' => $certificate->expires_at->toISOString(),
            ],
            'channel' => 'web',
        ]);
    }

    /**
     * Scope by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get unread count for user
     */
    public static function getUnreadCount($userId)
    {
        return self::where('user_id', $userId)->where('is_read', false)->count();
    }

    /**
     * Mark all notifications as read for user
     */
    public static function markAllAsRead($userId)
    {
        return self::where('user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Get notification icon based on type
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'test_reminder' => 'fas fa-clock',
            'test_completed' => 'fas fa-check-circle',
            'certificate_issued' => 'fas fa-certificate',
            'certificate_expiring' => 'fas fa-exclamation-triangle',
            default => 'fas fa-bell'
        };
    }

    /**
     * Get notification color based on type
     */
    public function getColorAttribute()
    {
        return match($this->type) {
            'test_reminder' => 'blue',
            'test_completed' => $this->data['passed'] ?? false ? 'emerald' : 'amber',
            'certificate_issued' => 'emerald',
            'certificate_expiring' => 'amber',
            default => 'slate'
        };
    }
}
