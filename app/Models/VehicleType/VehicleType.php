<?php

namespace App\Models\VehicleType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $primaryKey = 'vehicle_type_id';
    
    protected $table = 'vehicle_types';

    protected $fillable = [
        'type_name',
        'code',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active'=> 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toggleStatus($root, array $args): self
    {
        $vehicleType = vehicleType::findOrFail($args['vehicleType_id']);
        $vehicleType->update(['is_active' => !$vehicleType->is_active]);
        return $vehicleType;
    }
}
