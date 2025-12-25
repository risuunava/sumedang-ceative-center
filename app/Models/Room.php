<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'capacity',
        'facilities',
        // HAPUS: 'price_per_hour',
        'image',
        'is_active',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('images/rooms/' . $this->image))) {
            return asset('images/rooms/' . $this->image);
        }
        return asset('images/rooms/default.jpg');
    }

    public function availableSlots($date)
    {
        $bookings = $this->bookings()
            ->where('booking_date', $date)
            ->whereIn('status', ['approved', 'pending'])
            ->get();

        return $bookings;
    }
}