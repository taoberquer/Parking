<?php

namespace App\Http\Controllers\Logged;

use App\Places;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function redirect;

/**
 * Class PlaceController
 * @package App\Http\Controllers\Logged
 */
class PlaceController extends Controller
{
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
        //
    }

    /**
     * @param Request $request
     * @param         $parking_id
     * @param null    $user_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'parking_id' => 'required|exists:mysql.parkings,id|integer',
            'user_id' => 'required|exists:mysql.users,id|integer',
        ]);

        $place = Places::assignPlace(
            [
                'user_id'=> $request->get('user_id'),
                'parking_id'=> $request->get('parking_id'),
            ]
        );
//        $place->save();
        return redirect()->route('home')->with('success', 'Nouvel place en attente !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Places::find($id);
        $place->status = 'abandoned';
        $place->save();

        return redirect()->route('home')->with('Succes', 'Place abandonné !');
    }
}
