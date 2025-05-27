<?php

namespace App\Models\TransactionPayment;

use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Transaction\Transaction;
use App\Models\TransactionService\TransactionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    
    protected $table = 'transaction_payments';

    protected $fillable = [
        'transaction_id',
        'payment_method_id',
        'amount',
        'payment_date',
        'reference_number',
        'status_id',
        'notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }

    public function transactionService()
    {
        return $this->belongsTo(TransactionService::class, 'status_id', 'status_id');
    }
}
