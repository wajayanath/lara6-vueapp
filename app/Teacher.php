<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
+
    public function classrooms()
    {
        return $this->hasOne(Classroom::class);
    }
}
