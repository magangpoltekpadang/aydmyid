<?php

namespace App\Models\Customer;

use App\Models\VehicleType\VehicleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';
    
    protected $table = 'customers';

    protected $fillable = [
        'plate_number',
        'name',
        'phone_number',
        'vehicle_type_id',
        'vehicle_color',
        'member_number',
        'join_date',
        'member_expiry_date',
        'is_member'
    ];

    protected $casts = [
        'is_member'=> 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'vehicle_type_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_member', true);
    }

    public function toggleStatus($root, array $args): self
    {
        $customer = Customer::findOrFail($args['customer_id']);
        $customer->update(['is_member' => !$customer->is_member]);
        return $customer;
    }
}
