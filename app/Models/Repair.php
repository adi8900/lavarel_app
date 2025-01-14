<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     *
     * @var array<string>
     */
    protected $fillable = [
        'device_id',
        'status_id',
        'assigned_to',
        'description',
        'cost',
    ];

    /**
     * Relacja: Naprawa należy do urządzenia.
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Relacja: Naprawa ma określony status.
     */
    public function status()
    {
        return $this->belongsTo(RepairStatus::class, 'status_id');
    }

    /**
     * Relacja: Użytkownik przypisany do naprawy.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relacja: Naprawa ma powiązane płatności.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
