<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMark extends Model
{
    use HasFactory;
    protected $table = 'add_marks';

    protected $fillable = [
        'user_id',
        'course_id',
        'department_id',
        'category_name',
        'marks',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
}
