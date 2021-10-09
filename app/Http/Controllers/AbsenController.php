<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Absen, Users};
use Validator;

class AbsenController extends Controller
{
    

	public function GetAllIzin()
	{
		try {
			
			$getAllIzin = Absen::with('user')->where(['izin' => 1])->get();
			return response()->json(['code'    => 200,'message' => 'success','data' => $getAllIzin ], 200);
			
		} catch (Exception $e) {
			
			return response()->json(['code'    => 401, 'message' => 'error', 'data' => 'Internal Server Error'], 401);
		}
	}

	public function ProcessIzin(Request $request)
	{
		try {

			$validatorAbsen = Validator::make($request->all(), [
			    'fk_id_users' 	=> 'required',
			    'nama_user' 	=> 'required',
	            'izin' 			=> 'required',
			    'keterangan' 	=> 'required',
			    'tanggal_izin'  => 'required',
	        ]);

	        if ($validatorAbsen->fails()) {
	            return response()->json([ 'code'    => 401, 'message' => $validatorAbsen->errors(), ], 200);
	        } 

	        $dataValidate = $validatorAbsen->validate();

			$tanggal_izin = $request->tanggal_izin;
			$tmpung_tngl_izin = [];
			foreach (json_decode($tanggal_izin) as $key) {
				$tmpung_tngl_izin[] = $key;
			}

	        $dataValidate['tanggal_izin'] = json_encode($tmpung_tngl_izin); 
	        // $dataValidate['id_absen'] = Str::uuid(); 
	        $dataValidate['deleted_at'] = 0; 
	        $dataValidate['created_at'] = date('Y-m-d H:s:i'); 
			$result = Absen::insert($dataValidate);
			
			if ($result) {
				return response()->json([ 'code'    => 200, 'message' => 'success', 'data' => $dataValidate  ], 200);
			}else{
				return response()->json([ 'code'    => 200, 'message' => 'error', 'data' => 'failed insert'  ], 200);
			}

		} catch (Exception $e) {
			
			return response()->json([ 'code'    => 401, 'message' => 'error', 'data' => 'Internal Server Error'  ], 401);
		}
	}

	public function getIzinById($id = null)
	{
			$getByIdIzin = Absen::with('user')->where(['id_absen' => $id, 'izin' => 1])->first();
			if ($getByIdIzin) {
				return response()->json([ 'code'    => 200, 'message' => 'success', 'data' => $getByIdIzin  ], 200);	
			}else{
				return response()->json([ 'code'    => 200, 'message' => 'error', 'data' => 'Id not found'  ], 200);
			}

	}

}
