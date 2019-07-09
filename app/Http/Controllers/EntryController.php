<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Status;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $entries = Entry::all();
          
        return view('frontend.zgloszenia.index')->with('entries', $entries);
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
        //
    }

    public function restore(Request $request, $id)
    { 
        $entry = Entry::withTrashed()->find($id);

        $entry->restore();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' przywrócone.');

        return redirect()->route('entries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    { 
        return view('frontend.zgloszenia.show')->with('entry', $entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        $subjects = Subject::all();
        $statuses = Status::all();
        return view('frontend.zgloszenia.edit')->with('entry', $entry)->with('subjects', $subjects)->with('statuses', $statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {

        $request->validate([
            'company' => 'required',
            'subject_id' => 'required',
            'anonymous' => 'required',
            'person' => 'required',
            'who' => 'required',
            'what' => 'required',
            'where' => 'required',
            'when' => 'required',
            'how' => 'required',
            //'attachment_id' => 'nullable',
            'why' => 'required',
            'already_done' => 'required',
            'agree' => 'required',
            'status_id' => 'required'
        ]);

        $entry->company = $request->company;
        $entry->subject_id = $request->subject_id;
        $entry->anonymous = $request->anonymous;
        $entry->person = $request->person;
        $entry->who = $request->who;
        $entry->what = $request->what;
        $entry->where = $request->where;
        $entry->when = $request->when;
        $entry->how = $request->how;
        //$entry->attachment_id = $request->attachment_id;
        $entry->why = $request->why;
        $entry->already_done = $request->already_done;
        $entry->agree = $request->agree;
        $entry->status_id = $request->status_id;

        $entry->save();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' zapisane.');

        return redirect()->back();
    }


    public function changeStatus(Entry $entry)
    {
        $maxid = DB::table('statuses')->max('id');

        if($entry->status_id < $maxid) {
            $entry->status_id += 1;
            $entry->save();
        } else {
            $entry->status_id = 1;
            $entry->save();
        }

        return redirect()->back();
    }

    public function trashed()
    {
        $entries = Entry::onlyTrashed()->get();
          
        return view('frontend.zgloszenia.trashed')->with('entries', $entries);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $entry = Entry::withTrashed()->find($id);

        if (!$entry->trashed()) {
            $entry->delete();
            $request->session()->flash('class', 'alert-success');
            $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' przeniesione do kosza.');
        } else {
            $entry->forceDelete();
            $request->session()->flash('class', 'alert-danger');
            $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' usunięte.');
        }



        return redirect()->route('entries');
    }
}
