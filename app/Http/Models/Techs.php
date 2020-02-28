<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Techs extends Model
{
    protected $table = 'techs';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function devs()
    {
        return $this->belongsToMany('App\Http\Models\Dev', 'devs_techs', 'techs_id', 'dev_id');
    }
}
