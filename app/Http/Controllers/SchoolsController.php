<?php

namespace App\Http\Controllers;

use App\Schools;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function index()
    {

        $schools = Schools::all();

        return view('manage/schools/index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage/schools/create');
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
            'name' => 'required',
        ]);

        $schools = new Schools([
            'name' => $request->get('name'),
        ]);
        
        $schools->save();
        return redirect('/schools')->with('success', 'School is toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $schools = Schools::find($id);

        return view('manage/schools/edit', compact('schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $schools = Schools::find($id);
            $schools->name = $request->get('name');
            $schools->save();

        return redirect('/schools')->with('success', 'School is aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $schools = Schools::find($id);
        $schools->active = 0;
        $schools->save();

        return redirect('/schools')->with('success', 'School verwijdert');
    }
}
