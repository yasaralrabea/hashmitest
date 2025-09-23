<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    
    protected $fillable = [
        'submission','rate', 'file', 'url','user_id','task_id' ];


         public function user() {
        return $this->belongsTo(User::class);
    }

    public function task() {
        return $this->belongsTo(StudentsTask::class);
    }
}
