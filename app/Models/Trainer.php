<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = ['name', 'email', 'hospital_id', 'program_id'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // A trainer can have many trainees
    public function trainees()
    {
        return $this->belongsToMany(Trainee::class, 'trainer_trainee');
    }
}
