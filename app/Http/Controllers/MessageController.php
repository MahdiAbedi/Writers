<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages=Message::where('reciever_id',auth()->id())->orderBy('id','desc')->paginate(20);
        return view('pages.message.inbox',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recievers=User::where(function($query){
            if (!auth()->user()->hasRole(['modir']))
                 {
                     $query->role('modir');
                     $query->orWhere(function($query){
                         $query->role('modir_halghe');
                     });

                 }
        })->get()->pluck('name','id');

        //dd($users);
        return view('pages.message.form',compact('recievers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recievers=$request['recievers'];
        $body=$request['body'];
        $title=$request['title'];
        $sender=auth()->id();

        foreach ($recievers as $reciever) {
            Message::create([
                'title'=>$title,
                'body'=>$body,
                'reciever_id'=>$reciever,
                'sender_id'=>$sender
                ]);
        }

        return redirect('message')->with('message','پیام شما با موفقیت ارسال شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message=Message::find($id);
        $message->update(['status'=>'خوانده شده']);
        return view('pages.message.show',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
