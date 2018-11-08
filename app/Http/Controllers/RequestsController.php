<?php

namespace App\Http\Controllers;

use App\Requests;
use App\Status;
use App\Vaccins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Request;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Requests::with('vaccins', 'user', 'status')->get();

        return view('requests/index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vaccins = Vaccins::where('active', 1)->get();
        return view('requests/create', compact('vaccins'));
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
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        $request = new Requests([
            'user_id' => Auth::id(),
            'vaccine_id' => $request->get('vaccine_id'),
            'quantity' => $request->get('quantity'),
            'request_date' => date('Y-m-d H:i:s'),
            'status_id' => 1
        ]);
        
        $request->save();
        return redirect('/requests')->with('success', 'Aanvraag is ingediend');
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
        $statuses = Status::all();
        $requests = Requests::findOrFail($id);
        $vaccins = Vaccins::where('active', 1)->get();

        if(Auth::id() != $requests->user_id){
            return redirect('/requests');
        }

        return view('requests/edit', compact('requests', 'statuses', 'vaccins'));
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
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        $requests = Requests::find($id);
            $requests->vaccine_id = $request->get('vaccine_id');
            $requests->quantity = $request->get('quantity');
            $requests->save();

        return redirect('/requests')->with('success', 'Aanvraag aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requests = Requests::find($id);

        if(Auth::id() != $requests->user_id){
            return redirect('/requests');
        }
        $requests->delete();

        return redirect('/requests')->with('success', 'Aanvraag verwijdert');
    }
}
