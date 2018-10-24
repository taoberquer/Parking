<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Parking;
use function compact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

/**
 * Class ParkingController
 * @package App\Http\Controllers\Admin
 */
class ParkingController extends Controller
{
    /**
     * ParkingController constructor.
     */
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
        $this->authorize('index', Parking::class);

        $parkings = Parking::all();

        return view('admin.parking.index', compact('parkings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Parking::class);

        return view('admin.parking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Parking::class);

        $request->validate([
            'name' => 'required|string',
            'maximum_place' => 'required|min:0|numeric',
            'using_time' => 'required|min:0|numeric',
        ]);

        $parking = new Parking([
            'name' => $request->get('name'),
            'maximum_place' => $request->get('maximum_place'),
            'using_time' => $request->get('using_time'),
        ]);

        $parking->save();

        return redirect()->route('adminParkingsHome')->with('success', 'Parking ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Parking::class);

        $parking = Parking::find($id);

        return view('admin.parking.show', compact('parking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Parking::class);

        $parking = Parking::find($id);

        return view('admin.parking.edit', compact('parking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Parking::class);

        $parking = Parking::find($id);

        $request->validate([
            'name' => 'required|string',
            'maximum_place' => 'required|min:0|numeric',
            'using_time' => 'required|min:0|numeric',
        ]);

        $parking->name = $request->get('name');
        $parking->maximum_place = $request->get('maximum_place');
        $parking->using_time = $request->get('using_time');

        $parking->save();

        return redirect()->route('adminParkingsHome')->with('success', 'Parking mit à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Parking::class);
        
        $parking = Parking::find($id);
        $parking->delete();

        return redirect()->route('adminParkingsHome')->with('success', 'Parking supprimé !');
    }
}
