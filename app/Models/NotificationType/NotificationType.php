<?php

namespace App\Models\NotificationType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_type_id';
    
    protected $table = 'notification_types';

    protected $fillable = [
        'type_name',
        'code',
        'template_text',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toggleStatus($root, array $args): self
    {
        $notificationType = notificationType::findOrFail($args['notificationType_id']);
        $notificationType->update(['is_active' => !$notificationType->is_active]);
        return $notificationType;
    }
}
