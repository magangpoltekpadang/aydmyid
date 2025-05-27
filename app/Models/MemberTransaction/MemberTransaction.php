<?php

namespace App\Models\MemberTransaction;

use App\Models\MembershipPackage\MembershipPackage;
use App\Models\Outlet\Outlet;
use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTransaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'member_transaction_id';
    
    protected $table = 'member_transactions';

    protected $fillable = [
        'customer_id',
        'package_id',
        'outlet_id',
        'transaction_date',
        'expiry_date',
        'price',
        'payment_method_id',
        'staff_id',
        'receipt_number'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function membershipPackage()
    {
        return $this->belongsTo(MembershipPackage::class, 'package_id', 'package_id');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'outlet_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }
}
