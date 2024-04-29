<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'category',
        'description',
        'id_benefit',
    ];

    /**
     * Get the benefits for the document.
     */
    public function benefits()
    {
        return $this->belongsTo(Benefit::class);
    }
}
