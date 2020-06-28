<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams_option extends Model
{
    protected $fillable = [
		'examination_period', 'status'
	];
}
