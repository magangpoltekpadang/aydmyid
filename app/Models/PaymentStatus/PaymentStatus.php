<?php

namespace App\Models\PaymentStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_status_id ';
    
    protected $table = 'payment_status';

    protected $fillable = [
        'status_name',
        'code',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
