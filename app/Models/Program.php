<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function companies()
    {
        return $this->morphedByMany(Company::class, 'programable');
    }

    public function challenges()
    {
        return $this->morphedByMany(Challenge::class, 'programable')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->morphedByMany(User::class, 'programable')
            ->withTimestamps();
    }
}