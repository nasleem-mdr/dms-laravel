<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }


    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
