<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $fillable = ['name', 'email', 'pen', 'gender', 'nationality'];

    // A trainee can have many trainers
    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'trainer_trainee');
    }
}