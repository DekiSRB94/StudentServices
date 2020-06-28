<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

  protected $fillable = [
	'name', 'surname', 'identification_number', 'index_number', 'address', 'phone_number', 'picture', 'email', 'password', 'account_balance'
  ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'students__subjects');
  	}

}
