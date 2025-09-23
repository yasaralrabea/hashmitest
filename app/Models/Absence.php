<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
     protected $fillable = [
        'student_id', 'date','reason'
    ];
    
    public function student()
{
    return $this->belongsTo(Student::class)->withDefault([
        'name' => 'غير محدد'
    ]);
}

}
