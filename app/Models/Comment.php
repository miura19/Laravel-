<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
