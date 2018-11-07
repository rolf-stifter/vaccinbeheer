<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Stock;
use App\Vaccins;

//use App\Http\Controllers\Controller;

class StockController extends Controller
{

    public function index()
    {
        Stock::calc_user();

        $stock_lines = Stock::with('vaccins')->get();

        return view('stock/index', compact('stock_lines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock/create');
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
            'productName' => 'required',
            'quantity' => 'required|integer',
            'quantityAfterVac' => 'required|integer'
        ]);

        $stock_lines = new Stock([
            'isUsed' => $request->get('isUsed'),
            'productName' => $request->get('productName'),
            'quantity' => $request->get('quantity'),
            'quantityAfterVac' => $request->get('quantityAfterVac')
        ]);
        
        $stock_lines->save();
        return redirect('/stock')->with('success', 'Aanvraag is ingediend');
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

        $stock_lines = Stock::findOrFail($id);

        return view('stock/edit', compact('stock_lines'));
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
            'productName' => 'required',
            'quantity' => 'required|integer',
            'quantityAfterVac' => 'required|integer'
        ]);

        $stock_lines = Stock::find($id);
            $stock_lines->isUsed = $request->get('isUsed');
            $stock_lines->productName = $request->get('productName');
            $stock_lines->quantity = $request->get('quantity');
            $stock_lines->quantityAfterVac =  $request->get('quantityAfterVac');
            $stock_lines->save();

        return redirect('/stock')->with('success', 'Aanvraag aangepast');
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

        return redirect('/stock')->with('success', 'Aanvraag verwijdert');
    }

    
    public function add_external_stock(Request $request, $id)
    {

        $vaccins = Vaccins::where([
            ['id', $request->get('vaccine_id')]
        ])
        ->first();

        $stock_lines = Stock::where([
            ['user_id', Auth::id()],
            ['vaccine_id', $request->get('vaccine_id')]
        ])
        ->first();
        //dd($stock_lines);

        $request->validate([
           'quantity' => "required|integer|max:$stock_lines->quantityAfterVac"
        ]);

        $stock_lines->quantity = $stock_lines->quantity -  $request->get('quantity');
        $vaccins->total_stock_distributed = $vaccins->total_stock_distributed - $request->get('quantity');

        $stock_lines->save();
        $vaccins->save();

        return redirect('/stock')->with('success', 'Voorraad afgestaan');
    }
    
}
