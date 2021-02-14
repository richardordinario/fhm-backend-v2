<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'duration',
        'duration_type',
        'price',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
