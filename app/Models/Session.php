<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function add_session()
    {
        return $this->belongsTo(AddSession::class, 'add_session_id')->where('status', 1);
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'Teacher');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
   
}
