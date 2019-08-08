<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use DB;

class StateController extends Controller
{
     public function createState(Request $request){

    	$state = new State();
    	$state->name = $request->name;
    	$state->save();
        //$team = Team::create($request->all());
        return response()->json(['message' => 'State creado correctamente'], 200);
    }

    public function getState(){

   		$getState = DB::table('states')
   					->get();
 
       	return response()->json($getState, 200);
    }

     public function updateState(Request $request){

        $state = State:: findOrFail($request -> id);
        $state->name = $request->name;
        $state->save();

        return response()->json(['message' => 'State actualizado correctamente'], 201);
    }
}
