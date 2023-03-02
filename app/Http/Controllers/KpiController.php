<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kpi ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class KpiController extends Controller
{
    //insert kpi into db 
    public function addKpi(Request $request){
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'about' => 'required',
        ]);
        
        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            //create new empty model
            $kpi= new Kpi;
            $name=$request->input('name');
            $about=$request->input('about');
            $kpi->name = $name; 
            $kpi->about = $about;
            $kpi->save();  
            return response()->json([
                'message'=>'kpi created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create kpi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getAllKpis(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $kpis = Kpi::paginate($perPage);

    return response()->json($kpis);
}






    
    public function getKpi(Request $request,$id){
        try {
            //create new empty model
            if (!is_numeric($id)) {
                return response()->json([
                    'message' => 'Kpi id is invalid',
                ], 404);
            }   
            
            $kpi=Kpi::find($id);
            if (!$kpi) {
                return response()->json([
                    'message'=> 'kpi not found'
                ]);
            }

            $kpi=Kpi::find($id);
            return response()->json([
                'message'=>$kpi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get kpi',
                'error' => $e->getMessage()
            ], 500);
        }
   }
   public function editKpi(Request $request, $id){
    try {
        $Kpi =  Kpi::find($id);

        if (!$Kpi) {
            return response()->json([
                'message' => 'Kpi not found',
            ], 404);
        }    $inputs= $request->except('_method');
        $Kpi->update($inputs);

        return response()->json([
            'message' => 'Kpi edited successfully!',
            'Kpi' => $Kpi,
        ]); } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to edit kpi',
                'error' => $e->getMessage()
            ], 500);
        }
    

}

 

  public function deleteKpi(Request $request, $id)
    {
        try {
            $Kpi =  Kpi::find($id);

            if (!$Kpi) {
                return response()->json([
                    'message' => 'Kpi not found',
                ], 404);
            }

            $Kpi->delete();

            return response()->json([
                'message' => 'Kpi deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete kpi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}