<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name','phone','position','qualification','salary','user_id'];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
