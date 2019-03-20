<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaysOfWeek extends Model
{  
    protected $table = 'days_of_week';
    protected $fillable = ['id', 'dag'];
}
