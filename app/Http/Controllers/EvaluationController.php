<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Employee;
// use App\Models\Kpi;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class EvaluationController extends Controller
{
    public function addEvaluation (Request $request){
        $validator= Validator::make($request->all(),[
            'evaluation'=> 'required|integer|min:1|max:10',
            'evaluation_date'=>'required|date'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=> 'Validation Error',
                'errors'=> $validator->errors(),
            ],
                442,
        );
        }
         $evaluation= new Evaluation();
         $id=$request->input('id');
         $evaluation_score=$request->input('evaluation');
         $evaluation_date=$request->input('evaluation_date');
         
         $evaluation->evaluation = $evaluation_score;
         $evaluation->evaluation_date = $evaluation_date;
         $evaluation->save();
         return response()->json([
           'message'=>'Evaluation Created',
         ]);
   }


    public function getEvaluation (){
       try{
           $evaluation=Evaluation::with(['employees', 'kpis'])->get();
           return response()->json([
               'evaluation'=>$evaluation
           ], 200);
       }catch (\Exception $e) {
           return response()->json(['message' => 'Failed to retrieve evaluations.'], 500);
       }
    }


    public function getEvaluationById($id)
    {
        try {
            $evaluation = Evaluation::with('employees','kpis')->find($id);

            return response()->json([
                'evaluation' => $evaluation,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Evaluation retrieval failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    


    public function deleteEvaluation($id)
    {
        
        try {
            $evaluations = Evaluation::findOrFail($id);
            $evaluations->delete();

            return response()->json([
                'message' => 'Evaluation deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete evaluation.',
            ], 500);
        }
       
    }
    

    public function updateEvaluation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'evaluation' => 'string|max:255',
            'date_evaluated' => 'date',
            'employee_id' => 'exists:employees,id',
            'kpi_id' => 'exists:kpis,id',

        ]);
    
        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }
        $evaluation=Evaluation::find($id);
        $evaluation->update($validator->validated());

    
        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $evaluation,
        ]);
    }
}
