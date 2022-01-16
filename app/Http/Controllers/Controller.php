<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($data = null, $msg = 'success', $status = 200)
    {
        return response()->json(['status' => true, 'message' => $msg, 'data' => $data], $status);
    }

    public function responseFail($msg = 'fail', $status = 200)
    {
        return response()->json(['status' => false, 'message' => $msg], $status);
    }
}
