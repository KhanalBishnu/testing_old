<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'images',
        'videos',
        'thumbnail',
        'status'
    ];
    public function getMediaAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function setMediaAttribute($value)
    {
        $this->attributes['media'] = json_encode($value);
    }
}
