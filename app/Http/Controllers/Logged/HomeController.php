<?php

namespace App\Http\Controllers\Logged;

use App\Parking;
use function compact;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function view;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkings = Parking::getUserParkingsById(\Auth::user()->id);

        return view('logged.index', compact('parkings'));
    }
}
