<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home.index');
    }

    public function status()
    {
        return view('frontend.home.status');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'hash' => 'required',
            'hash' => 'alpha_num',
        ]);

        $none = false;
        $entry = Entry::where('hash', $request->hash)->first();

        if(!$entry) {
             $none = true;
        }

        return view('frontend.home.status')->with('entry', $entry)->with('none', $none);
        
    }
}
