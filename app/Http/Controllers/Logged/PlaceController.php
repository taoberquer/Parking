<?php

namespace App\Http\Controllers\Logged;

use App\Parking;
use App\Places;
use function compact;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

/**
 * Class PlaceController
 *
 * @package App\Http\Controllers\Logged
 */
class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parkings = Parking::all();

        return view('logged.create', compact('parkings'));
    }

    /**
     * @param Request    $request
     * @param $parking_id
     * @param null       $user_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'parking_id' => 'required|exists:mysql.parkings,id|integer',
            'user_id' => 'required|exists:mysql.users,id|integer',
            ]
        );

        Places::assignPlace(
            [
                'user_id'=> $request->get('user_id'),
                'parking_id'=> $request->get('parking_id'),
            ]
        );

        return back()->with('success', 'Demande d\'une place effectué !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Places::find($id);
        $place->status = 'abandoned';
        $place->save();

        return back()->with('success', 'Place abandonné !');
    }
}
