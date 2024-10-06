<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = ['name', 'email', 'cover_letter', 'cv_path'];

    use HasFactory;
}
