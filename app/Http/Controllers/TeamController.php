<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;

class TeamController extends Controller
{
    public function addTeam(Request $request){
        $team = new Team;
        $name = $request->input('name');
        $team-> name = $name;
        $team->save();
        return response()->json([
            'message' => 'Team created successfully!',
        ]);
    }

    public function getAllTeams(Request $request){
        $team = Team::all();
        return response()->json([
            'message' => $team,
        ]);
    }

    public function getTeam(Request $request, $id){
        $team = Team::find($id);
        return response()->json([
            'message' => $team,
        ]);
    }

    public function editTeam(Request $request, $id){
        $team = Team::find($id);
        $input = $request->except('_method');
        $team->update($input);
        return response()->json([
            'message' => 'Team edited successfully!',
        ]);
    }

    public function deleteTeam(Request $request, $id){
        $team = Team::find($id);
        $team->delete();
        return response()->json([
            'message' => 'Team deleted successfully!',
        ]);
    }

    
}
