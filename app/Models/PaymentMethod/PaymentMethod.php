<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_method_id';
    
    protected $table = 'payment_methods';

    protected $fillable = [
        'method_name',
        'code',
        'is_active',
        'description'
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
        $paymentMethod = paymentMethod::findOrFail($args['paymentMethod_id']);
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);
        return $paymentMethod;
    }
    
}
