<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
 protected $fillable = [
        'name', 'age', 'track', 'memorization', 'level', 'goal', 'phone','user_id','juz'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
    
    public function recitations()
{
    return $this->hasMany(Recitation::class);
}

}
