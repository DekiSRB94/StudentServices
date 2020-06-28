<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    
	protected $fillable = [
		'name', 'surname', 'identification_number', 'address', 'phone_number', 'picture', 'email', 'password'
	];


   public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'professors__subjects');
    }

}
