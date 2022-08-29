<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPage extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_module_id',
        'page_id',
        'course_id',
        'module_id',
        'is_completed',
        'user_id'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user_module()
    {
        return $this->belongsTo(UserModule::class);
    }
}
