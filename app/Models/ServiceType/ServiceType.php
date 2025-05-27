<?php

namespace App\Models\ServiceType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_type_id';

    protected $table = 'service_types';

    protected $fillable = [
        'type_name',
        'code',
        'description',
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
        $serviceType = serviceType::findOrFail($args['serviceType_id']);
        $serviceType->update(['is_active' => !$serviceType->is_active]);
        return $serviceType;
    }
}
