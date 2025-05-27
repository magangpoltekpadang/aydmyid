<?php

namespace App\Models\Staff;

use App\Models\Outlet\Outlet;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $primaryKey = 'staff_id';
    
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password_hash',
        'outlet_id',
        'role_id',
        'is_active',
        'last_login',
        'is_active'
    ];

    protected $casts = [
        'is_active'=> 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'outlet_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toggleStatus($root, array $args): self
    {
        $staff = Staff::findOrFail($args['staff_id']);
        $staff->update(['is_active' => !$staff->is_active]);
        return $staff;
    }
}