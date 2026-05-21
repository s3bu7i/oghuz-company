<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title','slug','short_description','description',
        'icon','color','image','order','is_active','is_featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($s) {
            if (empty($s->slug)) $s->slug = Str::slug($s->title);
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true)->orderBy('order');
    }
}
