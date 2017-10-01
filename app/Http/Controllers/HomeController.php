<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function options(Request $request, Response $response)
    {
        if ($request->getMethod() == "OPTIONS"){
            return response()->json([
                'OPTIONS' => 'success',
            ]);
        }
        die();
    }
}
