<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // TAMBAHKAN INI
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'capacity',
        'facilities',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($room) {
            $room->slug = Str::slug($room->name);
        });

        static::updating(function ($room) {
            if ($room->isDirty('name')) {
                $room->slug = Str::slug($room->name);
            }
        });

        // Hapus file saat room dihapus
        static::deleting(function ($room) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
        });
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // METHOD BARU: Get image URL from storage
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Cek apakah file ada di storage
            if (Storage::disk('public')->exists($this->image)) {
                return Storage::url($this->image);
            }
        }
        
        // Default image jika tidak ada
        return asset('images/rooms/default.jpg');
    }

    // METHOD BARU: Get image path
    public function getImagePathAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->path($this->image);
        }
        return null;
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