<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
        'project_title',
        'project_details',
        'member_1_name',
        'member_1_id',
        'member_2_name',
        'member_2_id',
        'member_3_name',
        'member_3_id',
        'member_4_name',
        'member_4_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
    use HasFactory;
}
