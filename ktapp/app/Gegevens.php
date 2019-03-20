<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gegevens extends Model
{
    public function user() {
        return $this->hasOne('App\User');
    }

    public function day() {
        return $this->hasOne('App\DaysOfWeek');
    }
    public function days() {
        return $this->belongsTo('App\DaysOfWeek', 'days_id');
    }
    protected $fillable = ['user_id', 'gegevens_datum', 'gegevens_week', 'dag_id', 'gegevens_jaar', 'gegevens_km', 'gegevens_locatie', 'gegevens_aankomst', 'gegevens_vertrek', 'gegevens_no'];

    protected $hidden = ['archived'];
}
