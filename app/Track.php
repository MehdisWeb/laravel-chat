<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Track extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
