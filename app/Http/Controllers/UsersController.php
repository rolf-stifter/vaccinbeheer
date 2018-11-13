<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\User;
use App\User_roles;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('user_roles')->get();
        //$user_roles = User_roles::all();
        //dd($users);
        return view('manage/users/index', compact('users', 'user_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $user_roles = User_roles::all();

        return view('manage/users/create', compact('users', 'user_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'user_roles_id' => 'required|integer'
        ]);

        $users = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_roles_id' => $request->get('user_roles_id')
        ]);
        $users->save();

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return redirect('/users')->with('success', 'Gebruiker is toegevoegd');
    }

    public function broker()
    {
        return Password::broker();
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
        $users = User::findOrFail($id);
        $user_roles = User_roles::all();

        return view('manage/users/edit', compact('users', 'user_roles'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'user_roles_id' => 'required|integer'
        ]);

        $users = User::findOrFail($id);
            $users->name = $request->get('name');
            $users->email = $request->get('email');
            $users->user_roles_id = $request->get('user_roles_id');
            $users->save();

        return redirect('/users')->with('success', 'Gebruiker is aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        
        $users->active = 0;
        $users->save();

        return redirect('/users')->with('success', 'Gebruiker is verwijdert');

    }
}
