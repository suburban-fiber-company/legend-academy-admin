<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'module_id',
        'correct_answers',
        'questions_count',
        'status',
    ];

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
