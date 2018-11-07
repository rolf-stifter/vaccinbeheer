<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Favorite_schools;
use App\Schools;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = DB::table('schools')
                        ->select('schools.*')
                        ->leftJoin('favorite_schools', function ($join){
                            $join->on('schools.id', 'favorite_schools.school_id')
                                  ->where('user_id', Auth::id());
                            })
                        ->whereNull('favorite_schools.school_id')
                        ->get();
       //dd($schools);
        $favorite_schools = DB::table('favorite_schools')
                                ->select('favorite_schools.*', 'schools.name')
                                ->leftJoin('schools', 'schools.id', 'favorite_schools.school_id')
                                ->where('user_id', Auth::id())
                                ->get();
        //dd($favorite_schools);
        return view('profile/index', compact('favorite_schools', 'schools'));
    }

    public function add_to_favorites(Request $request, $id)
    {
        $school = Schools::findOrFail($id);

        $fav_school = new Favorite_schools([
            'user_id' => Auth::id(),
            'school_id' => $school->id
        ]);
        
        $fav_school->save();
        return redirect('/profile')->with('success', 'School is toegevoegd aan favorieten');

    }

    public function delete_favorite($id)
    {
        $fav_school = Favorite_schools::findOrFail($id);

        
        if(Auth::id() != $fav_school->user_id){
            return redirect('/profile');
        }

        $fav_school->delete();

        return redirect('/profile')->with('success', 'Favoriet verwijdert');
    }
}
