<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'serial_number',
        'user_id',
    ];

    // Define an accessor for the 'name' field
    public function getNameAttribute()
    {
        return $this->brand . ' ' . $this->model;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}