<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function options() {
        return $this->hasMany(UserOption::class);
    }
}
