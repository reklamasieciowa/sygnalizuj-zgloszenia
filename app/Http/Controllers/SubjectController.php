<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
          
        return view('frontend.tematy.index')->with('subjects', $subjects);
    }

    public function entries(Subject $subject)
    {
        $entries = $subject->entries()->get();
          
        return view('frontend.tematy.entries')->with('entries', $entries)->with('subject', $subject);
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
        ]);

        $subject = new Subject;

        $subject->name = $request->name;

        $subject->save();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Temat '.$subject->name.' zapisany.');

        return redirect()->route('subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('frontend.tematy.edit')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $subject->name = $request->name;

        $subject->save();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Temat '.$subject->name.' zaktualizowany.');

        return redirect()->route('subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subject $subject)
    {
        $subject->delete();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Temat '.$subject->name.' usunięty!');

        return redirect()->route('subjects'); 
    }
}
