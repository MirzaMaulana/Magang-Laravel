<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Tags extends Model
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'created_by'
    ];

     protected $attributes = [
        'created_by' => ''
    ];
}
