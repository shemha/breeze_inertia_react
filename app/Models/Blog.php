<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // データテーブルから呼び出すフィールドを定義
    protected $fillable = [
        'title',
        'content'
    ];
}
