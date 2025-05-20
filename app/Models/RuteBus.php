<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuteBus extends Model
{
    use HasFactory;

    protected $fillable = [
        'asal',
        'tujuan',
        'tanggal_berangkat',
        'merk_bus',
        'tipe_bus',
        'harga',
    ];

    // Cast tanggal_berangkat jadi Carbon instance
    protected $casts = [
        'tanggal_berangkat' => 'date',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'rute_bus_id');
    }
}
