<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
          
        return view('frontend.statusy.index')->with('statuses', $statuses);
    }

    public function entries(Status $status)
    {
        $entries = $status->entries()->get();
          
        return view('frontend.statusy.entries')->with('entries', $entries)->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'color' => 'required',
        ]);

        $status = new Status;

        $status->name = $request->name;
        $status->color = $request->color;

        $status->save();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Status '.$status->name.' zapisany.');

        return redirect()->route('statuses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('frontend.statusy.edit')->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        $status->name = $request->name;
        $status->color = $request->color;

        $status->save();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Status '.$status->name.' zaktualizowany.');

        return redirect()->route('statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Status $status)
    {
        $status->delete();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Status '.$status->name.' usunięty!');

        return redirect()->route('statuses'); 
    }
}
