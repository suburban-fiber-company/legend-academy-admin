<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'course_id',
    ];

    
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
