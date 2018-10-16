<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Controller;

class StockController extends Controller
{

    

    public function index()
    {

        $stock_lines = DB::table('stock')->get();

        return view('stock/index', compact('stock_lines'));
    }
}
