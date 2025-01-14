<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_id',
        'amount',
        'payment_method',
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
