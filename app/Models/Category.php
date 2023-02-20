<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'created_by'
    ];

    protected $attributes = [
        'created_by' => ''
    ];
}
