<?php

namespace App\Models\NotificationStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationStatuses extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_id';
    
    protected $table = 'notification_statuses';

    protected $fillable = [
        'status_name',
        'code',
        'desctiption'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
