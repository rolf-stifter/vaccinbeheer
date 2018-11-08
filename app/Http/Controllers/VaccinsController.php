<?php

namespace App\Http\Controllers;

use App\Vaccins;
use Illuminate\Http\Request;

class VaccinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccins = Vaccins::all();

        return view('manage/vaccins/index', compact('vaccins'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage/vaccins/create');
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
            'type' => 'required',
            'minimum_amount' => 'required|integer|min:0',
            'active' => 'required|integer'
        ]);

        $vaccins = new Vaccins([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'minimum_amount' => $request->get('minimum_amount'),
            'active' => $request->get('active')
        ]);
        
        $vaccins->save();
        return redirect('/vaccins')->with('success', 'Vaccin is toegevoegd');
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

        $vaccins = Vaccins::find($id);

        return view('manage/vaccins/edit', compact('vaccins'));
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
            'type' => 'required',
            'minimum_amount' => 'required|integer|min:0',
            'active' => 'required|integer'
        ]);

        $vaccins = Vaccins::find($id);
            $vaccins->name = $request->get('name');
            $vaccins->type = $request->get('type');
            $vaccins->minimum_amount = $request->get('minimum_amount');
            $vaccins->active =  $request->get('active');
            $vaccins->save();

        return redirect('/vaccins')->with('success', 'Vaccin aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $vaccins = Vaccins::find($id);
        $vaccins->active = 0;
        $vaccins->save();

        return redirect('/vaccins')->with('success', 'Vaccin verwijdert');
    }

    public function activate_vaccin($id)
    {
        $vaccins = Vaccins::find($id);
        $vaccins->active = 1;
        $vaccins->save();

        return redirect('/vaccins')->with('success', 'Vaccin terug in gebruik');
    }
}
