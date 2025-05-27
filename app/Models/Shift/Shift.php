<?php

namespace App\Models\Shift;

use App\Models\Outlet\Outlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $primaryKey = 'shift_id';
    
    protected $table = 'shifts';

    protected $fillable = [
        'outlet_id',
        'shift_name',
        'start_time',
        'end_time',
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toggleStatus($root, array $args): self
    {
        $shift = shift::findOrFail($args['shift_id']);
        $shift->update(['is_active' => !$shift->is_active]);
        return $shift;
    }

    protected static function booted()
    {
        static::saving(function ($shift) {
            if ($shift->start_time >= $shift->end_time) {
                throw new \Exception('Waktu mulai harus sebelum waktu selesai');
            }
        });
    }

}
