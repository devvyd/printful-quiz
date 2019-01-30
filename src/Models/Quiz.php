<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // A bit exceptional pluralisation going on here.
    protected $table = 'quizzes';
}