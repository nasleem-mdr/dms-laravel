<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;


    protected $guarded = [
        'id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
