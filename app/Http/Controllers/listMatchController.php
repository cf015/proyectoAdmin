<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Match;
use DB;

class listMatchController extends Controller
{
    public function getListMatch(){

    	 $getMatch = DB::table('matches')
        		->join('users as u', 'matches.teamLocal','=','u.id')
        		->join('users as d', 'matches.teamVisitor','=','d.id')
        		->select('matches.id','matches.dateMatch','u.nameTeam as teamLocal','matches.scoreLocal','d.nameTeam as teamVisitor','matches.scoreVisitor')
        		->get();

       	return response()->json($getMatch, 200);
    }
}
