<?php

namespace App\Models\Outlet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $primaryKey = 'outlet_id';
    
    protected $table = 'outlets';

    protected $fillable = [
        'outlet_name',
        'address',
        'Phone_number',
        'latitude',
        'longitude',
        'join_date',
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
        $outlet = outlet::findOrFail($args['outlet_id']);
        $outlet->update(['is_active' => !$outlet->is_active]);
        return $outlet;
    }
}