<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'user_id',
        'title',
    ];

    public function jobpost()
    {
        return $this->hasMany(JobPost::class);
    }
}
