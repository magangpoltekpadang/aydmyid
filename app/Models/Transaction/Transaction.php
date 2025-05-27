<?php

namespace App\Models\Transaction;

use App\Models\Customer\Customer;
use App\Models\Outlet\Outlet;
use App\Models\PaymentStatus\PaymentStatus;
use App\Models\Shift\Shift;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';
    
    protected $table = 'transactions';

    protected $fillable = [
        'transaction_code',
        'customer_id',
        'outlet_id',
        'transaction_date',
        'subtotal',
        'discount',
        'tax',
        'final_price',
        'payment_status_id',
        'get_opened',
        'staff_id',
        'shift_id',
        'receipt_printed',
        'whatsapp_sent',
        'notes'
        
    ];

    protected $casts = [
        'get_opened' => 'boolean',
        'receipt_printed' => 'boolean',
        'whatsapp_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'outlet_id');
    }

    public function paymentStatuses()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id', 'payment_status_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'shift_id');
    }
}


