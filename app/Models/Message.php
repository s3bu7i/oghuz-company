<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name','email','phone','subject','service','message',
        'is_read','status','ip_address'
    ];

    protected $casts = ['is_read' => 'boolean'];

    public function scopeUnread($query) {
        return $query->where('is_read', false);
    }
}
