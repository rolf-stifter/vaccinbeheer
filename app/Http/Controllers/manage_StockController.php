<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\User;
use App\Vaccins;
//use App\Http\Controllers\Controller;

class manage_StockController extends Controller
{

    public function index()
    {
        $vaccins = Vaccins::all();

        $total_vaccins = DB::table('stock')
        ->select(DB::raw('SUM(stock.quantity) AS sum, (SUM(stock.quantity) - SUM(stock.quantityAfterVac)) AS sum_after, stock.vaccine_id, vaccins.name, vaccins.type '))
        ->leftJoin('vaccins', 'stock.vaccine_id', '=' , 'vaccins.id')      
        ->groupBy('stock.vaccine_id', 'vaccins.name', 'vaccins.type')
        ->get();

        //dd($total_vaccins);
        $stock_lines = Stock::with('user', 'vaccins')->get();

        return view('manage/stock/index', compact('stock_lines', 'vaccins', 'total_vaccins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $vaccins = Vaccins::all();
        
        return view('manage/stock/create', compact('users', 'vaccins'));
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
            'isUsed' => 'required|integer',
            'user_id' => 'required',
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer',
            'quantityAfterVac' => 'required|integer'
        ]);

        $stock_lines = new Stock([
            'isUsed' => $request->get('isUsed'),
            'user_id' => $request->get('user_id'),
            'vaccine_id' => $request->get('vaccine_id'),
            'quantity' => $request->get('quantity'),
            'quantityAfterVac' => $request->get('quantityAfterVac')
        ]);
        
        $stock_lines->save();
        return redirect('manage_stock')->with('success', 'Vaccin is toegevoegd');
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
        $users = User::all();
        $vaccins = Vaccins::all();
        $stock_lines = Stock::find($id);

        return view('manage/stock/edit', compact('stock_lines', 'users', 'vaccins'));
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
            'isUsed' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'vaccine_id' => 'required|integer',
            'quantity' => 'required|integer',
            'quantityAfterVac' => 'required|integer'
        ]);

        $stock_lines = Stock::find($id);
            $stock_lines->isUsed = $request->get('isUsed');
            $stock_lines->user_id = $request->get('user_id');
            $stock_lines->vaccine_id = $request->get('vaccine_id');
            $stock_lines->quantity = $request->get('quantity');
            $stock_lines->quantityAfterVac =  $request->get('quantityAfterVac');
            $stock_lines->save();

        return redirect('manage_stock')->with('success', 'Vaccin is aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $stock_lines = Stock::find($id);
        $stock_lines->delete();

        return redirect('manage_stock')->with('success', 'Vaccin is verwijdert');
    }
}
