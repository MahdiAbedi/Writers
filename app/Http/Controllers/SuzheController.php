<?php

namespace App\Http\Controllers;

use App\Suzhe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuzheController extends Controller
{
    private $rules = [
        'title' => 'required|max:200',
        'body' => 'required',
        'halghe_id' => 'required',
       
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suzhes=Suzhe::where(function($query) 
            {
                $data=array();
                /**
                 * اگر کاربر مدیر یا عضو ستاد شبکه نبود فقط بتواند سوژه های حلقه خود را ببیند
                 */
                if (!auth()->user()->hasRole(['modir','shabake']))
                 {
                    $halghes=auth()->user()->halghe;
                    foreach($halghes as $halghe)
                    { 
                        $data[]=$halghe->id;  
                        
                    }
                   // dd($data);
                    //بغییر از مدیر و ستاد شبکه بقیه فقط سوژه های تایید شده را مشاهده میکنند
                    $query->where('status','منتشر شده');
                    //فقط سوژه هایی که ظرفیت خالی دارند به کاربران نمایش داده میشود
                   //i used whereRaw() to compare two fields
                    $query->whereRaw('user_limit > choosed_users');
                    //یادداشت نویس قبل از انقضای سوژه میتواند آنرا انتخاب کند
                   // $query->whereRaw('expire_date > date(now())');
                    //کاربران فقط سوژه های حلقه خود را مشاهده میکنند
                    $query->whereIn('halghe_id', $data);
                    return $query;
                }
    
            });
           // dd($suzhes->toSql());  
        $suzhes=$suzhes->get();
        
        return view('pages.suzhe.index',compact('suzhes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.suzhe.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

       $suzeh=$request->all();
       
       $suzeh['user_id']=auth()->user()->id;
       $suzhe['expire_date']=Carbon::now()->addDays(2);
       Suzhe::create($suzeh);
        return redirect('suzhe')->with('message', 'سوژه جدید ایجاد شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suzheh  $suzheh
     * @return \Illuminate\Http\Response
     */
    public function show(Suzhe $suzhe)
    {
        $suzhe=Suzhe::find($suzhe->id);
        return view('pages.suzhe.show',compact('suzhe'));
    }

    /**عدم تایید سوژه از طرف ستاد شبکه برای نمایش */
    public function reject($id)
    {
        $data['status']='مردود';
        $suzhe=Suzhe::find($id);
        $suzhe->Update($data);
        return redirect('suzhe')->with('message', 'سوژه مردود اعلام شد.');
    }
/**انتشار سوژه */
    // public function publish($id)
    // {
    //     $data['status']='منتشر شده';
    //     $suzhe=Suzhe::find($id);
    //     $suzhe->Update($data);
    //     return redirect('suzhe')->with('message', 'سوژه منتشر شد.');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suzheh  $suzheh
     * @return \Illuminate\Http\Response
     */
    public function edit(Suzhe $suzhe)
    {
        return view('pages.suzhe.form',compact('suzhe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suzheh  $suzheh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suzhe $suzhe)
    {
        $request->validate($this->rules);
        $data=$request->all();
        //در هنگام بروز رسانی نیازی نیست ارسال کننده سوژه تغییر کند
       // $data['user_id']=auth()->user()->id;
        //dd($data);
        $suzhes=Suzhe::find($suzhe->id);
        $suzhes->Update($data);

        return redirect('suzhe')->with('message', 'سوژه با موفقیت بروز رسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suzheh  $suzheh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suzhe $suzhe)
    {
        $suzheh=Suzhe::find($suzhe->id);
        $suzheh->delete();
        return redirect('suzhe')->with('message', 'سوژه با موفقیت حذف شد.');
    }
    
}
