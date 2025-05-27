<?php

namespace App\Models\Expense;

use App\Models\Outlet\Outlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $primaryKey = 'expense_id';
    
    protected $table = 'expenses';

    protected $fillable = [
        'expense_code',
        'outlet_id',
        'expense_date',
        'amount',
        'category',
        'description',
        'staff_id',
        'shift_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'outlet_id');
    }
}
