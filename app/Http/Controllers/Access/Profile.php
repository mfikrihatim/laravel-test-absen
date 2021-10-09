<?php 

namespace App\Http\Controllers\Access;
use Illuminate\Support\Facades\Storage;
use App\Traits\RespondsWithHttpStatus;
use App\Models\{Users, UsersUpdate};
use Illuminate\Http\Request;
use Exception;
use Validator;
use Str;

trait Profile
{
	use RespondsWithHttpStatus;

	/*
	* Get Profile By ID Token
	*/
	public function GetProfile($auth_data)
	{
		try {
			$data = Users::with('users_update')->where('id_users', $auth_data->id_users)->first();
			
			return [
	            'status' => 'resSuccess',
	            'message' => 'Success get profile',
	            'data'    => [
	                'data' => $data
	            ]
	        ];

		} catch (Exception $e) {
			
			return [
	            'message' => 'Invalid Request, Get Profile !',
	            'data' => [],
	            'error' =>  [
	            	'error' => $e->getMessage()
	            ]
			];
		}
	}

	public function EditProfileProcess($auth_data, Request $request)
	{
		$check_file = UsersUpdate::select(['foto_profile'])->where(['fk_id_users' => $auth_data->id_users])->first(); // Check File
		/*$validationUsers = Validator::make($request->all(), [
			'jns_kelamin' => 'min:3'
		]);*/

		$validationUsersUpdate = Validator::make($request->all(), [
			'biografi' => 'min:4',
            'hobi' => 'max:30',
            'motivasi' => 'max:30',
            'no_telp' => 'integer',
            'alamat' => 'string|max:30',
		]);

		/*if ($validationUsers->fails()) {
        	return $this->resError($validationUsers->errors(),"Validation failed");
    	}*/

    	if ($validationUsersUpdate->fails()) {
        	// return $this->resError($validationUsersUpdate->errors(),"Validation failed");
        	return [
        		'status' => 'resError',
        		'message' => $validationUsersUpdate->errors(),
        		'data' => null,
        		'error' => 'Validation failed'
        	];
    	}

		// $dataUser1 = $validationUsers->validate();
		$dataUser2 = $validationUsersUpdate->validate();
		$file_profile = $request->file('foto_profile');
		if ($file_profile) {
			if (Storage::get('public/foto_profile/'.$check_file->foto_profile)) {
				
				unlink(storage_path('app/public/foto_profile/' . $check_file->foto_profile));

				$foto_profile = Str::random(9);
				$request->file('foto_profile')->move(storage_path('app/public/foto_profile'), $foto_profile);
				$dataUser2['foto_profile'] = $foto_profile;
			}
		}
		// Users::where('id_users', $auth_data->id_users)->update($dataUser1);
		UsersUpdate::where('fk_id_users', $auth_data->id_users)->update($dataUser2);
		
		return [
			'status' => 'resSuccess',
            'message' => 'Success Edit Profile',
            'data'    => [
                'data' => $dataUser2
            ]
		];
	}
}

?>