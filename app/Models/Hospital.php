<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['name', 'country'];

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
