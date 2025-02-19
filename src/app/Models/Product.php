<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     // 一度に割り当て可能なカラム
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    /**
     * ProductとSeasonのリレーション（多対多）
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
}
