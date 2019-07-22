<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Entry;
use App\Mail\NewEntry;
use App\Status;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EntryController extends Controller
{

    public function __construct()
{
    $this->middleware('auth', ['except' => array('create', 'store', 'checkStatus')]);
}

    public function home()
    {        
        return view('frontend.zgloszenia.home');
    }

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
        $subjects = Subject::all();
        $statuses = Status::all();
        return view('frontend.zgloszenia.create')->with('subjects', $subjects)->with('statuses', $statuses);
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
            'company' => 'required',
            'subject_id' => 'required',
            'anonymous' => 'required',
            'person' => 'required',
            'who' => 'required',
            'what' => 'required',
            'where' => 'required',
            'when' => 'required',
            'how' => 'required',
            'attachment' => 'nullable|file|max:50000|mimes:doc,docx,jpeg,jpg,png,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,zip',  
            'why' => 'required',
            'already_done' => 'required',
            'agree' => 'required',
        ]);

        $entry = new Entry;
        $entry->company = $request->company;
        $entry->subject_id = $request->subject_id;
        $entry->anonymous = $request->anonymous;
        $entry->person = $request->person;
        $entry->who = $request->who;
        $entry->what = $request->what;
        $entry->where = $request->where;
        $entry->when = $request->when;
        $entry->how = $request->how;
        $entry->why = $request->why;
        $entry->already_done = $request->already_done;
        $entry->agree = $request->agree;
        $entry->hash = md5(uniqid('', true));
        $entry->save();

        if ($request->hasFile('attachment')) {
            if ($request->file('attachment')->isValid()) {
                $attachment_path = $request->attachment->store('zalaczniki');

                $attachment = new Attachment;
                $attachment->entry_id = $entry->id;
                $attachment->file_name = $attachment_path;
                $attachment->mime =  $request->attachment->getMimeType();
               
                $attachment->save();
            }
        }

        $admin = User::find(1);
        Mail::to($admin)->send(new NewEntry($entry));

        $request->session()->flash('class', 'alert-info');
        $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' zapisane. Uwaga! Zapisz numer zgłoszenia, aby w przyszłości sprawdzić jego status. Numer referencyjny zgłoszenia: '.$entry->hash.'.');

        return redirect()->route('home');
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

    public function downloadAttachment(Attachment $attachment)
    {
        return Storage::download($attachment->file_name);
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
        $entry->why = $request->why;
        $entry->already_done = $request->already_done;
        $entry->agree = $request->agree;
        $entry->status_id = $request->status_id;

        $entry->save();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' zapisane.');

        return redirect()->back();
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'hash' => 'required|alpha_num',
        ]);

        $entry = Entry::where('hash', $request->hash)->first();

        if($entry === null) {
            $entry = false;
            $request->session()->flash('class', 'alert-danger');
            $request->session()->flash('info', 'Zgłoszenie o numerze '.$request->hash.' nie istnieje.');
            return back();
        } else {
            $request->session()->flash('class', 'alert-info');
            $request->session()->flash('info', 'Status Twojego zgłoszenia: '.$entry->status->name.'.');
            return back();
        }
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

    public function emptyTrash(Request $request)
    {
        $entries = Entry::onlyTrashed()->get();

        foreach ($entries as $entry) {
            if ( !empty($entry->attachment) ) {
                Storage::delete($entry->attachment->file_name);
                $entry->attachment->delete();
            }
        }

        Entry::onlyTrashed()->forceDelete();

        $request->session()->flash('class', 'alert-success');
        $request->session()->flash('info', 'Kosz opróżniony.');
          
        return redirect()->route('entries.trashed');
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
            return redirect()->route('entries');
        } else {
            //entry attachment deleting in appserviceprovider (deleting event)
            $entry->forceDelete();
            $request->session()->flash('class', 'alert-success');
            $request->session()->flash('info', 'Zgłoszenie '.$entry->company.' usunięte.');
            return redirect()->route('entries.trashed');
        }    
    }
}
