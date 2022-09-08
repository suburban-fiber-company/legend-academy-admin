<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'module_id',
        'published',
        'date_created',
        'time_limit',
    ];

    public function questions() {

        return $this->hasMany(Question::class);
    }
}
