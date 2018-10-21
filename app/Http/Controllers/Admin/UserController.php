<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
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
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'email'=>'required|unique:mysql.users|email',
            'name'=> 'required',
            'password' => 'required',
            'role' => ['required', Rule::in('user', 'admin')],
            ]
        );
        $user = new User(
            [
            'email' => $request->get('email'),
            'name'=> $request->get('name'),
            'password'=> Hash::make($request->get('password')),
            'role'=> $request->get('role'),
            ]
        );
        $user->save();
        return redirect()->route('adminUsersHome')->with('success', 'Nouvel utilisateur ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));
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
        $user = User::find($id);

        $request->validate(
            [
            'email' => 'required|unique:users,email,'.$user->id,
            'name'=> 'required',
            'role' => ['required', Rule::in('user', 'admin')],
            ]
        );

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');

        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        return redirect()->route('adminUsersHome')->with('success', 'Utilisateur mit à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('adminUsersHome')->with('success', 'Utilisateur supprimé !');
    }
}
