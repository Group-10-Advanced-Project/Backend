<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    //create team name
    public function addTeam(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:30',
        ]);
        if ($validator->fails()) {
            $team = [
                'status' => 401,
                'message' => $validator->errors()->first(),
                'data' => null,
            ];
            return $team;
        } else {
            $team = new Team;
            $name = $request->input('name');
            $team->name = $name;
            $team->save();
            $response = [
                'status' => 200,
                'message' => 'Team created successfully!',
                'data' => $team,
            ];
            return $response;
        }
    }

    //get all teams
    public function getAllTeams(Request $request)
    {
        $team = Team::all();
        $team = [
            'status' => 200,
            'message' => 'Retrieved all teams successfully!',
            'data' => $team,
        ];
        return response()->json([
            'message' => $team,
        ]);
    }

    //get team by id
    public function getTeamById(Request $request, $id)
    {
        $team = Team::find($id);
        if (!$team) {
            $response = [
                'status' => 404,
                'message' => 'Team not found!',
                'data' => null,
            ];
            return $response;
        } else {
            $response = [
                'status' => 200,
                'message' => 'Retrieved team successfully!',
                'data' => $team,
            ];
            return $response;
        }
    }

    //get team by name
public function getTeamByName($teamname)
{
    echo ($teamname);
    echo "123";
    if (!$teamname || trim($teamname) === '') {
        $response = [
            'status' => 400,
            'message' => 'Team name cannot be empty.',
            'data' => null,
        ];
        return $response;
    }

 
    $team = Team::where('name', trim($teamname) )->first();
    if ($team) {
        $response = [
            'status' => 200,
            'message' => 'Retrieved team successfully!',
            'data' => $team,
        ];
    } else {
        $response = [
            'status' => 404,
            'message' => 'No team found with this name.',
            'data' => null,
        ];
    }
    return $response;
}


    //edit team by id
    public function editTeam(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:30',
        ]);
        $team = Team::find($id);
        if (!$team) {
            $response = [
                'status' => 404,
                'message' => 'Requested team does not exist!',
                'data' => null,
            ];
            return $response;
        } else if ($validator->fails()) {
            $response = [
                'status' => 401,
                'message' => $validator->errors()->first(),
                'data' => null,
            ];
            return $response;
        } else {
            $input = $request->except('_method');
            $team->update($input);
            $response = [
                'status' => 200,
                'message' => 'Team edited successfully!',
                'data' => $team,
            ];
            return $response;
        }
    }

    //delete team by id
    public function deleteTeam(Request $request, $id)
    {
        $team = Team::find($id);
        if ($team) {
        $team->delete();
        $response = [
            'status' => 200,
            'message' => 'Team deleted successfully!',
            'data' => $team,
        ];
        return $response;
    } else {
        $error = [
            'status' => 404,
            'message' => 'id not found',
            'data' => null,
        ];
        return $error;
    }
    }

    public function getAllPagination() {
        $data = Team::where('data', '<=', now())->orderBy('date', 'desc')->paginate(10);
        foreach($data as $each) {
            $each->team;
            $each->recurring;
        }

        $respond = [
            "status" => 200,
            "message" => "Successfully got Teams",
            "data" => $data
        ];

        return response($respond, $respond["status"]);
    }
}