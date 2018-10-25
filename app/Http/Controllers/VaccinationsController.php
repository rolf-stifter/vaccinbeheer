<?php

namespace App\Http\Controllers;

use App\Vaccinations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schools;
use App\Vaccins;

class VaccinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vaccinations_finished = Vaccinations::get_finished_vaccinations_for_user(Auth::id());
        $vaccinations_planned = Vaccinations::get_planned_vaccinations_for_user(Auth::id());

        return view('vaccinations/index', compact('vaccinations_planned', 'vaccinations_finished'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = Schools::all();
        $vaccins = Vaccins::all();
        return view('vaccinations/create', compact('schools', 'vaccins'));
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
            'vaccination_date' => 'required',
            'school_id' => 'required',
            'school_class' => 'required',
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $vaccinations = new Vaccinations([
            'vaccination_date' => $request->get('vaccination_date'),
            'school_id' => $request->get('school_id'),
            'school_class' => $request->get('school_class'),
            'vaccine_id' => $request->get('vaccine_id'),
            'user_id' => Auth::id(),
            'quantity' => $request->get('quantity')
        ]);
        
        $vaccinations->save();
        return redirect('/vaccinations')->with('success', 'Aanvraag is ingediend');
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

        $vaccinations = Vaccinations::find($id);
        $schools = Schools::all();
        $vaccins = Vaccins::all();

        if(Auth::id() != $vaccinations->user_id){
            return redirect('/vaccinations');
        }

        return view('vaccinations/edit', compact('vaccinations', 'schools', 'vaccins'));
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
            'vaccination_date' => 'required',
            'school_id' => 'required',
            'school_class' => 'required',
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $vaccinations = Vaccinations::find($id);
            $vaccinations->vaccination_date = $request->get('vaccination_date');
            $vaccinations->school_id = $request->get('school_id');
            $vaccinations->school_class = $request->get('school_class');
            $vaccinations->vaccine_id =  $request->get('vaccine_id');
            $vaccinations->quantity =  $request->get('quantity');
            $vaccinations->save();

        return redirect('/vaccinations')->with('success', 'Aanvraag aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vaccinations = Vaccinations::find($id);

        if(Auth::id() != $vaccinations->user_id){
            return redirect('/vaccinations');
        }

        $vaccinations->delete();

        return redirect('/vaccinations')->with('success', 'Aanvraag verwijdert');
    }
}
