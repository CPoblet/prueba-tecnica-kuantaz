<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitUser extends Model
{
    use HasFactory;

    protected $table = 'benefit_user';

    protected $fillable = [
        'user_id',
        'benefit_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function benefit()
    {
        return $this->belongsTo(Benefit::class);
    }
}
