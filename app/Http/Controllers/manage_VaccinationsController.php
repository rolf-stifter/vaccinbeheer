<?php

namespace App\Http\Controllers;

use App\Vaccinations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schools;
use App\User;
use App\Vaccins;

class manage_VaccinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schools = Schools::all();
        $vaccins = Vaccins::all();
        $users = User::all();

        $vaccinations_finished = Vaccinations::get_finished_vaccinations($request);
        $vaccinations_planned = Vaccinations::get_planned_vaccinations($request);

        return view('manage/vaccinations/index', compact('vaccinations_finished', 'vaccinations_planned', 'schools', 'users', 'vaccins', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = Schools::all();
        $vaccins = Vaccins::where('active', 1)->get();
        $users = User::all();

        return view('manage/vaccinations/create', compact('schools', 'vaccins', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $request->validate([
            'vaccination_date' => "required|after:$now",
            'school_id' => 'required',
            'school_class' => 'required',
            'vaccine_id' => 'required|integer',
            'user_id' => 'required|integer',
            'quantity' => 'required|integer|min:0'
        ]);

        $vaccinations = new Vaccinations([
            'vaccination_date' => $request->get('vaccination_date'),
            'school_id' => $request->get('school_id'),
            'school_class' => $request->get('school_class'),
            'vaccine_id' => $request->get('vaccine_id'),
            'user_id' => $request->get('user_id'),
            'quantity' => $request->get('quantity')
        ]);
        
        $vaccinations->save();
        return redirect('/manage_vaccinations')->with('success', 'Vaccinatie is toegevoegd');
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
        $vaccins = Vaccins::where('active', 1)->get();
        $users = User::all();

        return view('manage/vaccinations/edit', compact('vaccinations', 'vaccins', 'users', 'schools'));
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
        $now = date('Y-m-d H:i:s');
        $request->validate([
            'vaccination_date' => "required|after:$now",
            'school_id' => 'required',
            'school_class' => 'required',
            'vaccine_id' => 'required|integer',
            'user_id' => 'required|integer',
            'quantity' => 'required|integer|min:0'
        ]);

        $vaccinations = Vaccinations::find($id);
            $vaccinations->vaccination_date = $request->get('vaccination_date');
            $vaccinations->school_id = $request->get('school_id');
            $vaccinations->school_class = $request->get('school_class');
            $vaccinations->vaccine_id =  $request->get('vaccine_id');
            $vaccinations->user_id = $request->get('user_id');
            $vaccinations->quantity =  $request->get('quantity');
            $vaccinations->save();

        return redirect('/manage_vaccinations')->with('success', 'Vaccinatie is aangepast');
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
        $vaccinations->delete();

        return redirect('/manage_vaccinations')->with('success', 'Vaccinatie is verwijdert');
    }
}
