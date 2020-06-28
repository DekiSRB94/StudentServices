<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register_Exam extends Model
{
    protected $fillable = [
	'student_id', 'subject_name', 'examination_period', 'status', 'year'
  	];
}
