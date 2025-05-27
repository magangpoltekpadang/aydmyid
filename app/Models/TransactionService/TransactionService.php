<?php

namespace App\Models\TransactionService;

use App\Models\Staff\Staff;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Federation\Resolvers\Service;

class TransactionService extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_service_id';
    
    protected $table = 'transaction_services';

    protected $fillable = [
        'transaction_id',
        'service_id',
        'quantity',
        'unit_price',
        'discount',
        'stotal_price',
        'worker_id',
        'start_time',
        'end_time',
        'status',
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

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'worker_id', 'staff_id');
    }
}