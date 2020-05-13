<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DB extends Model
{
	protected $connection = 'mysql';
    //protected $table = 'firm_user_data';
    public $timestamps = false;
}
