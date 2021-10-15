<?php

namespace App\Http\Controllers;

use App\Models\Maqebot;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MaqebotController extends Controller
{
    function getCodex(Request $request){
        $data = Maqebot::decodeCodex($request->codex);
        if ($data != false) {
            return $data;
        } else {
            // return Response::json(['error' => 'Error msg'], 404);
            return response()->json(['error' => 'Error msg'], 404);
        }
    }

    function index()
    {
        $authors = $this->authors();
        print_r($authors);
        $posts = $this->posts();
        return view('app',["authors"=>$authors,"posts"=>$posts]);

    }

    function authors()
    {
        $authors = Http::get('https://maqe.github.io/json/authors.json');
         return $authors->object();
    }
    function posts()
    {
        $posts = Http::get('https://maqe.github.io/json/posts.json');
        return $posts->object();
        
    }
}
