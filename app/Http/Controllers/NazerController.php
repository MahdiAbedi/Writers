<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Nazer;

class NazerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($note_id)
    {
        $note=Note::find($note_id);
        $nazer=Nazer::where('note_id',$note->id)->first();
        return view('pages.notes.barrasi',compact('note','nazer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #وضعیت یادداشت به "تایید مشروط به اصلاح" تغییر میکند
       $note=Note::find($request->note_id);
       $note->update(['status'=>'تایید به شرط اصلاح']);
        Nazer::create($request->all());
        return redirect('notes')->with('message','ارزیابی محتوایی انجام شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\nazer  $nazer
     * @return \Illuminate\Http\Response
     */
    public function show(nazer $nazer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\nazer  $nazer
     * @return \Illuminate\Http\Response
     */
    public function edit(nazer $nazer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\nazer  $nazer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nazer $nazer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\nazer  $nazer
     * @return \Illuminate\Http\Response
     */
    public function destroy(nazer $nazer)
    {
        //
    }
}
