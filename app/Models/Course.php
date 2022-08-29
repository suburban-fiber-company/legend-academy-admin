<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number_of_modules',
        'number_enrolled',
        'user_id',
        'department_id',
        'status',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
