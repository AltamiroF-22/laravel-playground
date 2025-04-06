<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'likes',
        'user_id',
        'post_id',
    ];

    // Um comentário pertence a um usuário (quem comentou)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Um comentário pertence a um post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Posts::class);
    }
}