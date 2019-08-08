<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
     protected $fillable = [

     	'dateMatch',
        'scoreLocal',
        'scoreVisitor',
        'teamLocal',
        'teamVisitor',
    ];

    public function teams(){
    	return $this->belongsToMany('App\Team');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function state(){

        return $this->belongsTo('App\State');
    }
}
