<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'image',
        'name',
        'company',
        'creadt_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'creadt_at');
    }
}
