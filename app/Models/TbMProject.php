<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class TbMProject extends Model
{
    use HasFactory;
    protected $primaryKey = 'project_id';

    public static function createData($request)
    {
    	DB::beginTransaction();
        try {
            $db = new TbMProject();
			$db->project_name =  $request->project_name;
			$db->client_id =  $request->client_id;
			$db->project_start =  $request->project_start;
			$db->project_end =  $request->project_end;
			$db->project_status =  $request->project_status;
			$db->save();
	    	DB::commit();
			$responseData = 'Data berhasil disimpan';
			return response()->json(['message'=> $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
			return response()->json(['message'=> 'failed', 'data' => $responseData], 400);
        }
    }

	public static function updateData($request)
    {
    	DB::beginTransaction();
        try {
            $db = TbMProject::find($request->project_id);
			$db->project_name =  $request->project_name;
			$db->client_id =  $request->client_id;
			$db->project_start =  $request->project_start;
			$db->project_end =  $request->project_end;
			$db->project_status =  $request->project_status;
			$db->save();
            DB::commit();
			$responseData = 'Data berhasil dirubah';
	    	return response()->json(['message'=> $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
			return response()->json(['message'=> 'failed', 'data' => $responseData], 400);
        }
    }

    public static function deleteData($request)
    {
    	DB::beginTransaction();
        try {
            
            $db = TbMProject::whereIn('project_id',explode(",", $request->id));
			$db->delete();
            DB::commit();
			$responseData = 'Data berhasil dihapus';
	    	return response()->json(['message'=> $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
	    	return response()->json(['message'=> 'failed', 'data' => $responseData], 400);
        }
    }

}
