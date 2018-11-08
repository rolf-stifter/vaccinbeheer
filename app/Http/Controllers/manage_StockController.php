<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\User;
use App\Vaccins;
use App\Rules\notHigherThanTotal;
//use App\Http\Controllers\Controller;

class manage_StockController extends Controller
{

    public function index(Request $request)
    {
        Stock::calc_user();
        Vaccins::calc();
        Vaccins::calc_distributed();
        
        $vaccins = Vaccins::all();
        $users = User::all();

        $where = [];
        if($request->get('vaccine_id')){
            $where[] = ['vaccine_id' ,'=' , $request->get('vaccine_id')];
        }
        if($request->get('user_id')){
            $where[] = ['user_id' ,'=' , $request->get('user_id')];
        }
        $stock_lines = Stock::with('vaccins', 'user')->where($where)
        ->paginate(5);

        return view('manage/stock/index', compact('stock_lines', 'vaccins', 'total_vaccins', 'users', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $vaccins = Vaccins::where('active', 1)->get();
        
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
        $vaccins = Vaccins::where('id' , $request->get('vaccine_id'))->get();

        $request->validate([
            'isUsed' => 'required|integer',
            'user_id' => 'required',
            'vaccine_id' => 'required|integer',
            'quantity' => [
                'bail',
                "required",
                "numeric",
                "integer",
                "min:0",
                new notHigherThanTotal($request->get('vaccine_id'))
            ]
        ]);
        
        if(
            $stock_lines = Stock::where([
                ['user_id', '=', $request->get('user_id')],
                ['vaccine_id', '=',  $request->get('vaccine_id')]
            ])
            ->first()
        ){
            $stock_lines->quantity = $stock_lines->quantity + $request->get('quantity');
        }else {
            $stock_lines = new Stock([
                'isUsed' => $request->get('isUsed'),
                'user_id' => $request->get('user_id'),
                'vaccine_id' => $request->get('vaccine_id'),
                'quantity' => $request->get('quantity'),
                'quantityAfterVac' => $request->get('quantity'),
            ]);
        }
        
        $stock_lines->save();
        return redirect('manage_stock')->with('success', 'Vorraad is toegevoegd');
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
        $vaccins = Vaccins::where('active', 1)->get();
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
            'quantity' => 'required|integer|min:0',
        ]);

        $stock_lines = Stock::find($id);
            $stock_lines->isUsed = $request->get('isUsed');
            $stock_lines->user_id = $request->get('user_id');
            $stock_lines->vaccine_id = $request->get('vaccine_id');
            $stock_lines->quantity = $request->get('quantity');
            $stock_lines->save();

        return redirect('manage_stock')->with('success', 'Voorraad is aangepast');
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

        return redirect('manage_stock')->with('success', 'Voorraad is verwijdert');
    }

    public function add_total_stock(Request $request)
    {
        $vaccins = Vaccins::where('id', $request->get('vaccine_id'))->first();
            $vaccins->total_stock += $request->get('quantity');
            $vaccins->total_stock_after_vac += $request->get('quantity');
            $vaccins->save();
        
        return redirect('manage_stock')->with('success', 'Voorraad toegevoegd');
    }
}
