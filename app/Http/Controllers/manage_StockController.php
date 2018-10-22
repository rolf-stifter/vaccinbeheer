<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\User;
//use App\Http\Controllers\Controller;

class manage_StockController extends Controller
{

    public function index()
    {

        $stock_lines = Stock::with('user', 'vaccins')->get();

        return view('manage/stock/index', compact('stock_lines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('manage/stock/create', compact('users'));
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
            'productName' => 'required',
            'quantity' => 'required|integer',
            'quantityAfterVac' => 'required|integer'
        ]);

        $stock_lines = new Stock([
            'isUsed' => $request->get('isUsed'),
            'user_id' => $request->get('user_id'),
            'productName' => $request->get('productName'),
            'quantity' => $request->get('quantity'),
            'quantityAfterVac' => $request->get('quantityAfterVac')
        ]);
        
        $stock_lines->save();
        return redirect('manage_stock')->with('success', 'product is toegevoegd');
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
        $stock_lines = Stock::find($id);

        return view('manage/stock/edit', compact('stock_lines', 'users'));
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

        return redirect('manage_stock')->with('success', 'Aanvraag aangepast');
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

        return redirect('manage_stock')->with('success', 'Aanvraag verwijdert');
    }
}
