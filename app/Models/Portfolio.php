<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title','slug','description','client','category',
        'technologies','image','url','completed_at','order',
        'is_active','is_featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'completed_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($p) {
            if (empty($p->slug)) $p->slug = Str::slug($p->title);
        });
    }

    public function getTechArrayAttribute() {
        return array_map('trim', explode(',', $this->technologies));
    }

    public function scopeActive($query) {
        return $query->where('is_active', true)->orderBy('order');
    }
}
