<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOption extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'result_id',
        'question_id',
        'option_id',
        'module_id',
        'course_id',
    ];
}
