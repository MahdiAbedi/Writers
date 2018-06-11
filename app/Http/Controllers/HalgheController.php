<?php

namespace App\Http\Controllers;

use App\halghe;
use Illuminate\Http\Request;

class HalgheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $halghes=Halghe::all();
        return view('pages.halghe',compact('halghes'));
        
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

    /**
     * Display the specified resource.
     *
     * @param  \App\halghe  $halghe
     * @return \Illuminate\Http\Response
     */
    public function show(halghe $halghe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\halghe  $halghe
     * @return \Illuminate\Http\Response
     */
    public function edit(halghe $halghe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\halghe  $halghe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, halghe $halghe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\halghe  $halghe
     * @return \Illuminate\Http\Response
     */
    public function destroy(halghe $halghe)
    {
        //
    }
}
