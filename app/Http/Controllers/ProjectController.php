<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;
class ProjectController extends Controller
{
        // add project
        public function addProject (Request $request)
        {
            
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'about' => 'required',
                    'status' => 'required',
                    'team_id' => 'required|exists:teams,id',
                ]);
    
                if ($validator->fails()) {
                    $project = [
                        
                        'message' => $validator->errors()->first(),
                        
                    ]; 
                    return $project;  
                }
                else{
                $project= new Project();
                $project->name = $request->input('name');
                $project->about = $request->input('about');
                $project->status = $request->input('status');
                
                $team_id = $request->input('team_id');
                $team = Team::find($team_id);
                $project->team()->associate($team);
                $project->save();
    
                return response()->json([
                    'message' => 'Project created successfully!',
                    'project'=> $project,
                ]);

                }
        
        }
    //  get project
        public function getProject(Request $request, $id)
        {
            try {
                $project = Project::where('id',$id)/*->with(['teams'])*/->get();
    
                if (!$project) {
                    throw new \Exception(json_encode(['error' => 'Project not found']), 404);
                }
    
                return response()->json([
                    'message' => 'Project found',
                    'employee' => $project
                ]);
            } catch (\Exception $err) {
                return response()->json(['error' => json_decode($err->getMessage(), true)], $err->getCode());
            }
        }
    
        public function deleteProject(Request $request, $id)
        {
            try {
                $project = Project::find($id);
    
                if (!$project) {
                    throw new \Exception(json_encode(['error' => 'Project not found']), 404);
                }
    
             
    
                return response()->json([
                    'message' => 'Project deleted successfully!'
                ]);
            } catch (\Exception $err) {
                return response()->json(['error' => json_decode($err->getMessage(), true)], $err->getCode());
            }
        }
        public function editProject(Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
    
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required',
                'about' => 'sometimes|required',
                'status' => 'sometimes|required',
                
                'team_id' => 'sometimes|required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            if($request->hasFile('teams')){
                $project->teams()->sync(json_decode($request->input('teams')));
            }
            // Update Project details
            $project->update([
                'name' => $request->input('name'),
                'about' => $request->input('about'),
                'status' => $request->input('status'),
                'team_id' => $request->input('team_id'),
            ]);
    
            return response()->json([
                'message'=>'Project updated successfully',
                'Employee' => $project,
            ]);
    
        } catch (\Exception $err) {
            return response()->json([
                'error' => 'Error updating project: ' . $err->getMessage(),
            ], 500);
        }
    }
    public function getAllProject(Request $request){
        {
           
            $perPage = $request->input('per_page', 20);

            $project = Project::with('team')->paginate($perPage);
                // ->with(['employee', 'recurring']);
                // ->orderBy('email')
                // ->paginate($perPage);
        
            return response()->json(
                // 'message' => 'Successfully got Employee',
                // 'data' => 
                $project,
            );
           
        }
        
        
        
        
        
        }
}

