<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    public $casts = ['data' => 'array'];
    protected $fillable = ['article', 'name', 'status', 'data'];

    public function scopeAvailable(Builder $query)
    {
        $query->where('status', '=', 'available');
    }

}
