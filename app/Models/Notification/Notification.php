<?php

namespace App\Models\Notification;

use App\Models\NotificationStatuses\NotificationStatuses;
use App\Models\NotificationType\NotificationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notifications_id';
    
    protected $table = 'notifications';

    protected $fillable = [
        'customer_id',
        'notification_type_id',
        'message',
        'sent_at',
        'status_id',
        'retry_count'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id', 'notification_type_id');
    }

    public function notificationStatuses()
    {
        return $this->belongsTo(NotificationStatuses::class, 'status_id', 'status_id');
    }
}
