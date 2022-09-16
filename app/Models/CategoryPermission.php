<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'upload',
        'download',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
