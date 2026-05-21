<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name','position','company','avatar','content','rating','is_active','order'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query) {
        return $query->where('is_active', true)->orderBy('order');
    }
}
