<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professors_Subject extends Model
{
    
	protected $fillable = [
		'professor_id', 'subject_id'
	];

}
