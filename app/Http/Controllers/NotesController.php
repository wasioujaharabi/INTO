<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notes;

class NotesController extends Controller
{
    public function index(){
        return view('Notes');
    }
    public function create(){
        return view('createnote');
    }
    public function store(Request $request){
        $request->validate([
            'notes'=>'required'
        ]);
        $notes = new notes;
        $notes->notes = $request->input('notes');
        $notes->save();

        return redirect('notes.show');
    }
    public function show(){

        $notes = notes::find();
        return view('notes.show',['notes'=>$notes]);
    
    }
}
