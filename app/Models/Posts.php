<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posts extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'likes',
        'is_published',
        'published_at',
        'user_id',
    ];

    // Um post pertence a um usuário (autor)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Um post pode ter vários comentários
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}