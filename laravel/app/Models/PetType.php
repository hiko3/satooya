<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetType extends Model
{
    protected $fillable = ['name'];

    protected $table = 'pet_types';
}
