<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable =[
        'question',
        'correct_answer',
        'quiz_id',
    ];

    public function options() {
        return $this->hasMany(QuestionOption::class);
    }

    public function correctOptionsCount() {
        return $this->options()->where('correct', 1 )->count();
    }

    public function correctOptions() {
       return  $this->options()->where('correct', 1)->get();
    }

    public function topic() {
        return $this->hasOne(Module::class);
    }

    public function course() {
        return $this->hasOne(Course::class);
    }
}
