<?php 
namespace App\Traits;

trait RespondsWithHttpStatus
{
    private $result = [
        'status' => false,
        'message' => '',
        'data' => [],
        'error' => []
    ];
    
    public function resSuccess($msg = '', $data = [], $code = 200)
    {
        $this->result['status'] = true;
        $this->result['message'] = $msg;
        $this->result['data'] = $data;
        unset($this->result['error']);

        return \response()->json($this->result, $code);
    }

    public function resError($msg = '', $error = [], $code = 200)
    {
        $this->result['status'] = false;
        $this->result['message'] = $msg;
        $this->result['data'] = null;
        $this->result['error'] = $error;
        return \response()->json($this->result, $code);
    }

    protected function internalError($err_message)
    {
    	return response()->json([
            'status' => 500,
            'message' => "Internal server error",
            'data' => $err_message
        ], 500);
    }
}
?>