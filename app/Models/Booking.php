<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'rute_bus_id',
        'nama',
        'telepon',
        'email',
        'kursi',
    ];

    public function rute()
    {
        return $this->belongsTo(RuteBus::class, 'rute_bus_id');
    }
}
