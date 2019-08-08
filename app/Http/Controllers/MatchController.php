<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Match;
use App\State;
use Auth;
use DB;

class MatchController extends Controller
{
     public function createMatch(Request $request){

         $getMatch = Match::all()-> count();
         $getNumTeam = Auth::user()['numTeam'];
         $getMatches = $getNumTeam - $getMatch;
         $getMatches2 = $getNumTeam + $getMatch;          

         if($getMatch < $getNumTeam){

            $match = new Match();
            $match->dateMatch = $request->dateMatch;
            $match->scoreLocal = $request->scoreLocal;
            $match->scoreVisitor = $request->scoreVisitor;
            $match->teamLocal = $request->teamLocal;
            $match->teamVisitor = $request->teamVisitor;
            $match->usuario_id = Auth::id();
            $match->state_id = State::find(1)['id'];
            $match->save();

            return response()->json(['message' => 'Match creado correctamente'], 200);
         }
         else{

             return response()->json(['message' => 'Match completados.'], 200);
         }
    }

   	
    public function getMatch(){

        //$match = Auth::user()['numTeam'];
         $getMatch = DB::table('matches')
                ->where('matches.usuario_id', Auth::id())
                ->join('teams as u', 'matches.teamLocal','=','u.id')
                ->join('teams as d', 'matches.teamVisitor','=','d.id')
                ->join('states', 'matches.state_id','=','states.id')
                ->select('matches.id','matches.dateMatch','u.name as teamLocal','matches.scoreLocal','d.name as teamVisitor','matches.scoreVisitor', 'states.name as stateMatch', 'matches.state_id')
                ->get();

        return response()->json($getMatch, 200);
    }

    public function updateMatch(Request $request){

        $match = Match:: findOrFail($request -> id);
        $match->scoreLocal = $request->scoreLocal;
        $match->scoreVisitor = $request->scoreVisitor;
        $match->state_id = State::find(2)['id'];
        $match->save();

        return response()->json(['message' => 'Match actualizado correctamente'], 201);
    }

    public function deleteMatch(Request $request){

        $match = Match:: findOrFail($request -> id);
        $match -> delete();
       
       return response()->json(['message' => 'Match eliminado correctamente'], 201);
    }

}
