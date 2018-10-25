<?php

namespace App\Http\Controllers;

use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Status;
use App\Vaccins;
use Illuminate\Foundation\Auth\User;

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
        $statusses = Status::all();
        $request_tabs = [];

        foreach($statusses as $status){
            $request_tabs[$status->id] = Requests::get_data_for_request_tabs($status->id);
        }
        //dd($request_tabs);
        return view('manage/requests/index', compact('request_tabs', 'statusses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vaccins = Vaccins::all();
        $users = User::all();
        $statusses = Status::all();

        return view('manage/requests/create', compact('users', 'vaccins', 'statusses'));
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
            'user_id' => 'required|integer',
            'status_id' => 'required'
        ]);

        $request = new Requests([
            'user_id' => Auth::id(),
            'vaccine_id' => $request->get('vaccine_id'),
            'quantity' => $request->get('quantity'),
            'request_date' => $request->get('request_date'),
            'user_id' => $request->get('user_id'),
            'status_id' => $request->get('status_id')
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
        $statusses = Status::all();
        $vaccins = Vaccins::all();
        $users = User::all();

        return view('manage/requests/edit', compact('requests', 'statusses', 'vaccins', 'users'));
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
            'user_id' => 'required|integer',
            'status_id' => 'required|integer'
        ]);

        $requests = Requests::find($id);
            $requests->vaccine_id = $request->get('vaccine_id');
            $requests->quantity = $request->get('quantity');
            $requests->request_date = $request->get('request_date');
            $requests->user_id = $request->get('user_id');
            $requests->status_id =  $request->get('status_id');
            $requests->save();

        return redirect('/manage_requests')->with('success', 'Aanvraag is aangepast');
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
        $requests->delete();

        return redirect('/manage_requests')->with('success', 'Aanvraag is verwijdert');
    }
}
