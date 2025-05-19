<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    'label', 'title', 'desc', 'location',
    'date', 'time', 'price', 'seats',
    'organizer_id', 'approved'
    ];


    /**
     * Relationship: Event belongs to an organizer (user).
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function cart() 
    {
        return $this->hasMany(Cart::class);
    }

}
