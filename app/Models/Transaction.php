<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['amount', 'date', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}