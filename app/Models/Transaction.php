<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','amount', 'date', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}