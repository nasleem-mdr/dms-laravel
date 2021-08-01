<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
