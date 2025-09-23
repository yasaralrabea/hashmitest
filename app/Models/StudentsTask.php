<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsTask extends Model
{
     protected $fillable = [
        'subject', 'open_to', 'url','file_path' ];


     public function submissions()
    {
        return $this->hasMany(Submission::class, 'task_id');
    }
    
     
}
