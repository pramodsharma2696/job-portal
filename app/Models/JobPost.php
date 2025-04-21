<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'experience',
        'salary',
        'location',
        'extra_info',
        'company_name',
        'company_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
