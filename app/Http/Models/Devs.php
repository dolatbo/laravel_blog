<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Devs extends Model
{
    protected $table = 'devs';
    protected $primaryKey = 'id';
    //protected $fillable = ['name'];
    protected $hidden = ['created_at'];
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany('App\Http\Models\Posts', 'dev_id', 'id');
    }

    public function techs()
    {
        return $this->belongsToMany(
            'App\Http\Models\Techs',
            'devs_techs',
            'dev_id',
            'techs_id'
        )->using('App\Http\Models\Pivot\DevsTechs');
    }
}
