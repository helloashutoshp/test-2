<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Authenticatable
{
    use HasFactory, Notifiable; // Notifiable is optional but recommended

    protected $table = 'test';

    protected $fillable = [
        'email', 'password', 'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
// $products = Product::where('price', '<=', 500)->take(10)->get();

