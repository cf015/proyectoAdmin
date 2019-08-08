<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use Auth;
use DB;

class TeamController extends Controller
{
    public function createTeam(Request $request){

        $getMatch = Team::all()-> count();
        $getNumTeam = Auth::user()['numTeam'];

        if($getMatch < $getNumTeam){

            $team = new Team();
            $team->name = $request->name;
            $team->usuario_id = Auth::id();
            $team->save();

            return response()->json(['message' => 'Team creado correctamente'], 200);
         
         }
         else{

             return response()->json(['message' => 'Team completados.'], 200);  
         }
    }

    public function getTeams(){

        $getTeam = Team::all()-> count();
        $getNumTeam = Auth::user()['numTeam'];
        $getNumTeams = $getNumTeam - $getTeam;
        $getNumTeams2 = $getNumTeam + $getTeam;          

   		$getTeams = DB::table('teams')
   					->where('usuario_id',Auth::id())
   					->get();
 
       	/*return response()->json([
            'id' => $getTeams
        ], 200);*/
         return response()->json([
            'message' => $getTeams,
            'numTeams' => $getNumTeams,
            'numTeams2' => $getNumTeams2
        ], 200);
    }

   	public function updateTeam(Request $request){

    	$team = Team:: findOrFail($request -> id);
    	$team->name = $request->name;
    	$team->save();
        //$team = Team::create($request->all());
        return response()->json(['message' => 'Team actualizado correctamente'], 201);
    }


    public function deleteTeam(Request $request){

        /*$team = Team:: findOrFail($request -> id);
        $team-> delete();*/
        $id = $request -> id;
        $team = Team::where(array(
            'id' => $id,
            'usuario_id' => Auth::id()
        ))->first();
        $team-> delete();

        return response()->json([
            'message' => 'Team eliminado correctamente',
            'error' => 'Erroreliminar team'
        ], 201);
    }


}
