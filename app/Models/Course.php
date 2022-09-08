<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'number_of_modules',
        'number_enrolled',
        'user_id',
        'department_id',
        'status',
        'unit_id'
    ];

    public function getStatusAttribute($value)
    {   
        
        if($value == 1){
            
            return 'Published';
        }
        else{
            return 'Not Published';
        }
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
