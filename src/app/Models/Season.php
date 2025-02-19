<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    // 一度に割り当て可能なカラム
    protected $fillable = [
        'name',
    ];

    /**
     * SeasonとProductのリレーション（多対多）
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season');
    }
}
