<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_course_id',
        'course_id',
        'module_id',
        'is_completed',
        'percentage_progress',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user_course()
    {
        return $this->belongsTo(UserCourse::class);
    }
}
