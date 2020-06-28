<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students_Subject extends Model
{

	protected $fillable = [
		'student_id', 'subject_id', 'mark'
	];

}
