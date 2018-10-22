<?php

namespace App\Http\Controllers;

use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Request;

class manage_RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $requests = Requests::with('vaccins', 'user')->get();
        
        return view('manage/requests/index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('manage/requests/create');
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
            'quantity' => 'required|integer',
            'request_date' => 'required|date',
            'status' => 'required'
        ]);

        $request = new Requests([
            'user_id' => Auth::id(),
            'vaccine_id' => $request->get('vaccine_id'),
            'quantity' => $request->get('quantity'),
            'request_date' => $request->get('request_date'),
            'status' => $request->get('status')
        ]);
        
        $request->save();
        return redirect('/manage_requests')->with('success', 'Aanvraag is ingediend');
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

        $requests = Requests::findOrFail($id);

        if(Auth::id() != $requests->user_id){
            return redirect('/manage_requests');
        }

        return view('manage/requests/edit', compact('requests'));
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
            'quantity' => 'required|integer',
            'request_date' => 'required|date',
            'status' => 'required'
        ]);

        $requests = Requests::find($id);
            $requests->vaccine_id = $request->get('vaccine_id');
            $requests->quantity = $request->get('quantity');
            $requests->request_date = $request->get('request_date');  
            $requests->status =  $request->get('status');
            $requests->save();

        return redirect('/manage_requests')->with('success', 'Aanvraag aangepast');
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
            return redirect('/manage_requests');
        }
        $requests->delete();

        return redirect('/manage_requests')->with('success', 'Aanvraag verwijdert');
    }
}
