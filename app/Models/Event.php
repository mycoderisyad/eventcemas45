<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'type',
        'date',
        'time',
        'location',
        'price',
        'capacity',
        'image',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function getAvailableSlotsAttribute()
    {
        return $this->capacity - $this->registrations()->where('status', '!=', 'cancelled')->count();
    }

    public function getRegistrationCountAttribute()
    {
        return $this->registrations()->where('status', '!=', 'cancelled')->count();
    }

    public function getRevenueAttribute()
    {
        return $this->registrations()
            ->where('payment_status', 'paid')
            ->sum('amount');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->toDateString());
    }
}
