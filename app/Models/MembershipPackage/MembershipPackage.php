<?php

namespace App\Models\MembershipPackage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPackage extends Model
{
    use HasFactory;

    protected $primaryKey = 'package_id';
    
    protected $table = 'membership_packages';

    protected $fillable = [
        'package_name',
        'duration_days',
        'price',
        'max_vehicles',
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
        $membershipPackage = membershipPackage::findOrFail($args['membershipPackage_id']);
        $membershipPackage->update(['is_active' => !$membershipPackage->is_active]);
        return $membershipPackage;
    }
}
