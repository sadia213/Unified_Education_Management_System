<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksDistribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'department_id',
        'category_name',
        'marks',
    ];
    // Assuming you have a 'course' relationship defined
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
