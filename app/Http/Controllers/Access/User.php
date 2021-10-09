<?php 

namespace App\Http\Controllers\Access;
use Illuminate\Support\Facades\Storage;
use App\Traits\RespondsWithHttpStatus;
use App\Models\{Users, UsersUpdate};
use Illuminate\Http\Request;
use Exception;
use Validator;
use Str;

trait User
{
	/*
	* Get All Users
	*/
	public function GetAll()
	{
		$data = Users::with('users_update')->get();
		// SELECT tbl_users.nama_lngkp, tbl_update_users.umur FROM tbl_users INNER JOIN tbl_update_users ON tbl_users.id_users = tbl_update_users.fk_id_users 
        $result = array();
        foreach ($data as $key => $value) {
            $result[] = [
                'nama_lengkap' => $value->nama_lngkp,
                'umur' => $value->users_update->umur,
                'alamat' => $value->users_update->alamat,
                'jenis_kelamin' => $value->jns_kelamin,
                'status_aktif' => $value->status_akun,
                'status_relation' => $value->users_update->status_relation
            ];  
        }

		return [
			'status' => 'resSuccess',
            'message' => 'Success get all users',
            'data'    => $result
        ];
	}

	/*
	* Update Profile By ID Token
	*/
    public function UpdateUsersValidation($auth_data, Request $request)
    {
    	
    	if ($auth_data->choose_patner !== 'find_a_patner') {
    		
    		return [
        		'status' => 'resError',
        		'message' => 'Authorized',
        		'data' => null,
        		'error' => 'Authorized'
        	];
    	}

		$check_file = UsersUpdate::where(['fk_id_users' => $auth_data->id_users])->first(); // Check File
		$validatorUsers = Validator::make($request->all(), [
            'no_telp' => 'required|min:6',
            'alamat' => 'required|min:4',
            'tmp_lahir' => 'required|min:3',
            'tgl_lahir' => 'required',
            'umur' => 'required',
            'status_sosial' => 'required',
            'status_relation' => 'required',
            'nik' => 'required|integer|min:16',
            'no_ktp' => 'required|integer|min:16',
            'biografi' => 'required|min:4',
            'hobi' => 'required|max:30',
            'motivasi' => 'required|max:30',
            'vr_ktp_pelajar' => 'required|mimes:jpeg,png,jpg',
            'foto_profile' => 'required|mimes:jpeg,png,jpg'
    	]);

    	if ($validatorUsers->fails()) {
            return [
        		'status' => 'resError',
        		'message' => $validatorUsers->errors(),
        		'data' => null,
        		'error' => 'Validation failed'
        	];
        }

        $dataUsers = $validatorUsers->validate(); // Validasi

        /*	Foto VR KTP / Pelajar */
		if ($request->file('vr_ktp_pelajar')) {
			// Pengecekan jika vr_ktp_pelajar masih kosong datanya
			if (empty($check_file->vr_ktp_pelajar && storage_path('app/public/vr_ktp_pelajar/' . $check_file->vr_ktp_pelajar))) {
				$vr_ktp_pelajar = Str::random(9);
				$request->file('vr_ktp_pelajar')->move(storage_path('app/public/vr_ktp_pelajar'), $vr_ktp_pelajar);
				$dataUsers['vr_ktp_pelajar'] = $vr_ktp_pelajar;

			}else{
				// Jika Sudah Ada Foto VR_KTP akan di lakukan pengecekan dan menghpus data sblumnya supaya ngak numpuk
				if (Storage::get('public/vr_ktp_pelajar/'.$check_file->vr_ktp_pelajar)) {
					unlink(storage_path('app/public/vr_ktp_pelajar/' . $check_file->vr_ktp_pelajar));

					$vr_ktp_pelajar = Str::random(9);
					$request->file('vr_ktp_pelajar')->move(storage_path('app/public/vr_ktp_pelajar'), $vr_ktp_pelajar);
					$dataUsers['vr_ktp_pelajar'] = $vr_ktp_pelajar;
				}else { 
					
					return [
		        		'status' => 'resError',
		        		'message' => 'File Image Not Found',
		        		'data' => null,
		        		'error' => ['errors' => 'Please Upload File VR KTP !']
		        	]; // Jika File Tidak Di Temukan
				}
			}
		}
		/*	Foto Profile Upload  */
		if ($request->file('foto_profile')) {
			// Pengecekan jika vr_ktp_pelajar masih kosong datanya
			if (empty($check_file->foto_profile && storage_path('app/public/foto_profile/' . $check_file->foto_profile))) {
				$foto_profile = Str::random(9);
				$request->file('foto_profile')->move(storage_path('app/public/foto_profile'), $foto_profile);
				$dataUsers['foto_profile'] = $foto_profile;

			}else{
				// Jika Sudah Ada Foto VR_KTP akan di lakukan pengecekan dan menghpus data sblumnya supaya ngak numpuk
				if (Storage::get('public/foto_profile/'.$check_file->foto_profile)) {
					unlink(storage_path('app/public/foto_profile/' . $check_file->foto_profile));

					$foto_profile = Str::random(9);
					$request->file('foto_profile')->move(storage_path('app/public/foto_profile'), $foto_profile);
					$dataUsers['foto_profile'] = $foto_profile;
				}else { 

					return [
		        		'status' => 'resError',
		        		'message' => 'File Image Not Found',
		        		'data' => null,
		        		'error' => ['errors' => 'Please Upload File VR KTP !']
		        	]; // Jika File Tidak Di Temukan
				}
			} 
		}    		
		UsersUpdate::where(['fk_id_users' => $auth_data->id_users])->update($dataUsers);
		
		return [
			'status' => 'resSuccess',
            'message' => 'Success get all users',
            'data'    => [
                'data' => $dataUsers
            ]
        ];
    }
}

?>