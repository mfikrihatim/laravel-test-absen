<?php 

/*
* Get Data by Token JWT
*/
function getTokenData($request){
	$header = $request->header('Authorization');	
	$ex = explode(" ", $header);
	$ex2 = explode(".", $ex[1]);
	$base64 = base64_decode($ex2[1]);
	$json = json_decode($base64);
	return $json;
}	

/*
* Get Levels Untuk User Id Ngambil Dari Token
*/
function getLevels($request)
{
	$tokenData = getTokenData($request);
	return $tokenData->sub->level_id;
}

function ExpriredCustom($hours, $minutes, $second)
{
	date_default_timezone_set("Asia/Bangkok");
	$now = Carbon::now()->toDateTimeString();
	$waktu_sekarang = explode(' ', $now);
    
	$waktu_di_db = '06:32:10';
	
	$hitung_waktu_5_jam = Carbon::createFromFormat('H:i:s', $waktu_di_db)->addHours($hours)->addMinutes($minutes)->addSeconds($second)->toTimeString();    	
	// $hitung_waktu_5_jam = Carbon::createFromFormat('H:i:s', $waktu_di_db)->addMinutes(20)->toTimeString();    	
	// echo $hitung_waktu_5_jam; die();

	if ($waktu_sekarang[1] <= $hitung_waktu_5_jam) {
		print_r('masih ada token');
	}else{
		print_r('udah ngak ada token');
	}
}	

/*
* Get Status Akun
*/
function ChosePatner($request)
{
	$tokenData = getTokenData($request);
	return $tokenData->sub->choose_patner;
}

/*
* Send Email
*/
function sendEmailStatus($email, $status, $alasan)
{
	$data = ['email' => $email, 'status' => $status, 'body' => $alasan, 'name' => 'DatingBudhist'];

	$send = Mail::send('emails.mail', $data, function ($message) use ($email) {
        $message->to($email)->subject('Notifikasi Status');
        $message->from('iqbalnurw8@gmail.com');
    });

    if ($send) {    	
    	return true;
    }else{
    	return false;
    }
}

?>