<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    use \Conner\Tagging\Taggable;
    
    protected $guarded = [
        'id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function document_category()
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
