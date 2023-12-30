<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];

    public function getAllNews()
    {
        return $this->news;
    }
}
