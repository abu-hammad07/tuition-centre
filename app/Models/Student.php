<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = "students";

    protected $fillable = [
        'full_name',
        'email',
        'dob',
        'gender',
        'address',
        'guardian_name',
        'guardian_phone',
        'class_name',
        'admission_date',
        'status',
        'profile_photo',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'is_deleted');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
