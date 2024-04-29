<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
    ];

    /**
     * The users that belong to the benefit.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the document that owns the benefit.
     */
    public function document()
    {
        return $this->hasOne(Document::class);
    }
}
