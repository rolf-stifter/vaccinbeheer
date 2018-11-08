<?php

namespace App\Http\Controllers;

use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Status;
use App\Stock;
use App\Vaccins;
use Illuminate\Foundation\Auth\User;

class manage_RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statusses = Status::all();
        $request_tabs = [];

        $vaccins = Vaccins::all();
        $users = User::all();

        foreach($statusses as $status){
            $request_tabs[$status->id] = Requests::get_data_for_request_tabs($status->id, $request);
        }
        
        //dd($request_tabs);
        return view('manage/requests/index', compact('request_tabs', 'statusses', 'vaccins', 'users', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vaccins = Vaccins::where('active', 1)->get();
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
            'quantity' => 'required|integer|min:0',
            'user_id' => 'required|integer',
            'status_id' => 'required'
        ]);

        $request = new Requests([
            'user_id' => Auth::id(),
            'vaccine_id' => $request->get('vaccine_id'),
            'quantity' => $request->get('quantity'),
            'user_id' => $request->get('user_id'),
            'request_date' => date('Y-m-d H:i:s'),
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
        $vaccins = Vaccins::where('active', 1)->get();
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
            'quantity' => 'required|integer|min:0',
            'user_id' => 'required|integer',
            'status_id' => 'required|integer'
        ]);

        $requests = Requests::findOrFail($id);
            $requests->vaccine_id = $request->get('vaccine_id');
            $requests->quantity = $request->get('quantity');
            $requests->user_id = $request->get('user_id');
            $requests->status_id =  $request->get('status_id');
            $requests->save();

            if($requests->status_id == 3){
                if(
                    $stock_lines = Stock::where([
                        ['user_id', '=', $requests->user_id],
                        ['vaccine_id', '=',  $requests->vaccine_id]
                    ])
                    ->first()
                ){
                    $stock_lines->quantity = $stock_lines->quantity + $request->get('quantity');
                    $stock_lines->quantityAfterVac = $stock_lines->quantityAfterVac + $request->get('quantity');
                } else {
                    $stock_lines = new Stock([
                        'isUsed' => 1,
                        'user_id' => $request->get('user_id'),
                        'vaccine_id' => $request->get('vaccine_id'),
                        'quantity' => $request->get('quantity'),
                        'quantityAfterVac' => $request->get('quantity'),
                    ]);
                }
                $stock_lines->save();
            }

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
        $requests = Requests::findOrFail($id);
        $requests->delete();

        return redirect('/manage_requests')->with('success', 'Aanvraag is verwijdert');
    }
}
