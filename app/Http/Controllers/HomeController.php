<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @OA\Get(
     *     path="/api/get-random-test-feed",
     *     tags={"Random"},
     *     summary="Get random",
     *     description="Get random test feed.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="401",description="Unauthorized"),
     * )
     */
    public function getRandom()
    {
        return response()->json('HI');
    }
}
