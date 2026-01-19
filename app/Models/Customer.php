<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

  protected $fillable = [
            'name',
            'email',
            'user_id',
            'township',
            'division',

            'birth',
            'phone',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
