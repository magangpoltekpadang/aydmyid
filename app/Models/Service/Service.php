<?php

namespace App\Models\Service;

use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_id';

    protected $table = 'services';

    protected $fillable = [
        'service_name',
        'service_type_id',
        'price',
        'estimated_duration',
        'description',
        'outlet_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'service_type_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toggleStatus($root, array $args): self
    {
        $service = service::findOrFail($args['service_id']);
        $service->update(['is_active' => !$service->is_active]);
        return $service;
    }
}
