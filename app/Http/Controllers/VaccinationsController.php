<?php

namespace App\Http\Controllers;

use App\Vaccinations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vaccinations = Vaccinations::with('stock', 'user')->get();

        return view('vaccinations/index', compact('vaccinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaccinations/create');
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
            'school' => 'required',
            'school_class' => 'required',
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $vaccinations = new Vaccinations([
            'vaccination_date' => $request->get('vaccination_date'),
            'school' => $request->get('school'),
            'school_class' => $request->get('school_class'),
            'vaccine_id' => $request->get('vaccine_id'),
            'user_id' => Auth::id(),
            'quantity' => $request->get('quantity')
        ]);
        
        $vaccinations->save();
        //return redirect('/vaccinations')->with('success', 'Aanvraag is ingediend');
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
        
        if(Auth::id() != $vaccinations->user_id){
            return redirect('/vaccinations');
        }

        return view('vaccinations/edit', compact('vaccinations'));
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
            'school' => 'required',
            'school_class' => 'required',
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $vaccinations = Vaccinations::find($id);
            $vaccinations->vaccination_date = $request->get('vaccination_date');
            $vaccinations->school = $request->get('school');
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
