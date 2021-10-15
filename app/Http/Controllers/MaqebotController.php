<?php

namespace App\Http\Controllers;

use App\Models\Maqebot;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class MaqebotController extends Controller
{
    function getCodex(Request $request){
        $data = Maqebot::decodeCodex($request->codex);
        if ($data != false) {
            return Maqebot::findTheResult($data);
        } else {
            return response()->json(['error' => 'Error msg'], 404);
        }
    }
}
