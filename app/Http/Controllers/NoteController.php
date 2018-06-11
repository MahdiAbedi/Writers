<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\Suzhe;
use Carbon\Carbon;
use App\UserPoints;
use App\Note_history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Media;

class NoteController extends Controller
{
    private $rules = [
        'title' => 'max:300',
        'nazer_id' => 'numeric',
        'arzyab_id' => 'numeric',
        'status' => 'max:200'
    ];

    /**انتخاب سوژه برای یادداشت نویسی توسط کاربر  */
    /**ابتدا آی دی سوژه رو میگیریم  */
    public function chooseSuzhe($id)
    {
        #choosing suzhe
        $suzhe=Suzhe::findOrfail($id);
       
        #ایجاد یک یادداشت با وضعیت "اعلام آمادگی" برای کاربری که آنرا انتخاب کرده است
        $user=auth()->user();
        $data['user_id']=$user->id;
        $data['suzhe_id']=$id;
        $data['arzyab_id']=$user->arzyab_id;
        $data['created_at']=date(now());
        $data['halghe_id']=$suzhe->halghe->id;
        //مهلت ارسال یادداشت اولیه
        $data['expire_date']=Carbon::now()->addDays(2);
        //dd($data);
        
        try {
            //بعد از ایجاد یادداشت اطلاعات آنرا برای ارسال به تاریخچه ذخیره میکنیم
            $note= Note::create($data);
            #یکی به فیلد کابرانی که یادداشت را انتخاب کرده اند اضافه میشود
            #ما از این تابع استافده نمیکنیم چون فیلد
            #updated_at را تغییر میدهد
            $suzhe->timestamps = false;
            $suzhe->increment('choosed_users');
            $suzhe->timestamps = true;

            //کسر امتیاز از کاربر در صورت انتخاب سوژه بعد از گذشت 24 ساعت
            if(Carbon::now()->diffInHours($suzhe->updated_at)>24){
                $this->saveUserPoint(-2,'کسر امتیاز به علیت انتخاب سوژه بعد از گذشت 24 ساعت');
            }
            #ثبت انتخاب سوزه توسط کاربر در تاریخچه یادداشت
            $this->addToNoteHistory($note->id,'یادداشت نویس سوژه را انتخاب کرد.','اعلام آمادگی');
          }
          catch (\Exception $e) {
             //return $e->getMessage();
              return redirect('suzhe')->with('message','شما نمیتوانید این سوژه را انتخاب کنید.');
          }

        

        #بازگشت به صفحه سوژه ها
        return redirect('suzhe')->with('message', 'سوژه توسط شما برای یادداشت نویسی انتخاب شد.');
       // return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conditions=null)
    {
        //دقت کنید چون داریم از یک تابع بی نام استفاده میکنیم متغییرهای خارج از آنرا باید
        //توسط کلمه use()
        //به آن ارسال کنیم
        $notes=Note::where(function($query) use ($conditions) 
            {
                $data=[];
                /**
                 * اگر کاربر مدیر نبود فقط بتواند یادداشتهای گروه خود را ببیند
                 */
                if (!auth()->user()->hasRole(['modir']))
                 {
                    $halghes=auth()->user()->halghe;
                    foreach($halghes as $halghe)
                    { 
                        $data[]=$halghe->id;  
                    }
                    //بغییر از مدیر و ستاد شبکه بقیه فقط سوژه های تایید شده را مشاهده میکنند
                   // $query->where('status','منتشر شده');
                    $query->whereIn('halghe_id', $data);

                    /**
                     * اگر کاربر یادداشت نویس بود فقط بتواند یادداشتهای خود را ببیند
                     * با توجه به این شرط مدیر حلقه نمیتواند یادداشت نویس هم باشد
                     */
                    if (auth()->user()->hasRole(['writer'])){
                        //یادداشتهای خودش
                        $query->where('user_id', auth()->id());
                        //یادداشتهایی که در وضعیتهای:"اعلام آمادگی،تایید به شرط اصلاح"" باشند
                        //$query->whereIn('status', []);
                        //کاربر میتواند تمام یادداشتهای خود را
                        // ببیند ولی تنها در وضعیتهای "اعلام آمادگی و تایید به شرط اصلاح " میتواند یادداشت خود را اصلاح  کند
                    }

                    //اگر شرط خاصی وجود داشت
                    //$conditions
                    
                    if ($conditions) {
                       // dd($conditions);
                        $query->where($conditions);
                    }
                }
                return $query;
    
            });
            
       $notes=$notes->get();
        return view('pages.notes.index',compact('notes'));
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
        $request->validate($this->rules);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $note=Note::find($note->id);
        if($note->status=='نهایی شده')
        {
              //این کد باعث میشکه نتونیم از کدی نظیر زیر استفاده کنیم
              //$media->user->name
              # $medias=DB::select('select * from media', [1]);
             //برای همین از این کد استفاده میکنیم

             //کد زیر چون خروجی را بصورت آبجکت برمیگرداند خیلی کارها میتوانیم باهاش انجام بدیم
             $medias=Media::all();

            return view('pages.notes.show',compact('medias','note'));
        }
        return view('pages.notes.show',compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $note=Note::find($note->id);
        return view('pages.notes.form',compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $request->validate($this->rules);
        $note=Note::find($note->id);
      
        #اگر کاربری که دارد تغییر میدهد یادداشت نویس این یادداشت نباشد
        #اجازه تغییر ندارد
        #این ایده اشتباه است چون در طی مراحل مختلف ،ارزیاب،مدیر حلقه محتوایی برای انتساب ناظر،مدیر کل و .. میتوانند تغییراتی بدهند.
        // $current_user=auth()->user()->id;
        // if($note->user_id !=$current_user){
        //     return redirect('notes')->with('message','اقدام شما به عنوان یک هشدار امنتیتی در سامانه ثبت شد.');
        // }

        $data=$request->all();
       
        #اصلاح یادداشت توسط یادداشت نویس
        //اول چک میکنیم که ببینیم چه کسی داره یادداشت را تغییر میده
            $current_user=auth()->id();
            //یادداشت نویس
            if ($current_user==$note->user_id) {
                //ارسال نسخه اولیه
                if ($note->status=="اعلام آمادگی") {
                    //تغییر وضعیت به حالت ارزیابی محتوایی تا به ناظر محتوایی ارسال شود
                    $data['status']='ارزیابی محتوایی';
                   //اگر بعد از گذشت 48 ساعت از زمان اعلام آمادگی بخواهد نسخه اولیه ارسال کند 2 نمره منفی میگیرد
                   if (Carbon::now()->diffInHours($note->updated_at)>48) {
                        $this->saveUserPoint(-2,'کسر امتیاز به خاطر ارسال نسخه اولیه یادداشت بعد از گذشت 48 ساعت از اعلام آمادگی');
                        #ثبت ارسال نسخه اولیه در تاریخچه یادداشت
                        $this->addToNoteHistory($note->id,'نسخه اولیه توسط یادداشت نویس ارسال شد.','ارسال نسخه اولیه');
                    }
                }
                //انجام اصلاح برای ارزیابی مجدد
                else{
                    //تغییر وضعیت برای انجام ارزیابی مجدد توسط ناظر محتوایی
                    //یادداشت نویس فقط 24 ساعت وقت دارد که یادداشت را اصلاح کند
                    $data['status']='ارزیابی مجدد';
                    $this->addToNoteHistory($note->id,'یادداشت نویس یادداشت را برای ارزیابی مجدد اصلاح کرد.','اصلاح توسط یادداشت نویس');
                }

                
                
            }
            //ناظر محتوایی
            elseif ($current_user==$note->nazer_id) {

            }
            //مدیر حلقه برای تعیین ناظر محتوایی
            else {
                $this->addToNoteHistory($note->id,'مدیر حلقه ناظر محتوایی یادداشت را مشخص کرد.','تعیین ناظر محتوایی');
            }


        //پایان 
        $note->update($data);
        
        return redirect('notes')->with('message','یادداشت شما با موفقیت ثبت شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }

    /**
     * یادداشتهای در انتظار تعیین ناظر محتوایی
     */

    public function withoutNazer()
    {
      return $this->index(['nazer_id'=>null]);
    }

    /**تعیین ناظر محتوایی از سوی مدیر حلقه  */
    public function setNazer($id)
    {
        $note=Note::findOrFail($id);
        #ثبت در تاریخچه یادداشت
        $this->addToNoteHistory($note->id,'مدیر حلقه برای یادداشت ناظر محتوایی تعیین کرد','انتساب ناظر محتوایی');
        return view('pages.notes.set_nazer',compact('note'));
    }

    /**صفحه ارزیابی یادداشت */
    public function arzyabi($id)
    {
        $note=Note::find($id);
        $zaribs=DB::select('select * from zaribs', [1]);
        
        return view('pages.notes.arzyabi',compact('zaribs','note'));
    }

    /**ثبت امتیاز ارزیابی برای هر یادداشت */
    public function savePoint(Request $request)
    {
        $sum=0;
        $zarib=0;
        //یادداشتی که این امتیاز متعلق به آن است.
        $note=Note::find($request['note_id']);

        $pointlist=$request->except('_token','note_id');
       // dd($points[0]);
        
        foreach($pointlist as $points){
            foreach ($points as  $point) {
                foreach ($point as $key => $value) {
                     //$key .'=> ' .$value .'</br>';
                      $sum += $key*$value; 
                      $zarib +=$key;
                }
            }
        }
        //اگر ارزیاب در 24 ساعت اول یادداشت را ارزیابی کند 5 امتیاز مثبت دریافت میکند
        if (Carbon::now()->diffInHours($note->updated_at)<24) {
            $this->saveUserPoint(+5,'ارزیابی شکلی یادداشت در کمتر از 24 ساعت');
        }
        //پایان امتیاز
        $miyangin=$sum/$zarib;
        $note->update(['point'=>$miyangin,'status'=>'نهایی شده']);
        //echo 'miyangin: '.$miyangin;
        #ثبت در تاریخچه یادداشت
        $this->addToNoteHistory($note->id,'انجام ارزیابی شکلی و ثبت یادداشت توسط ارزیاب','ارزیابی');
        return redirect('notes');
    }

    /**
     * لیست یادداشتهای در انتظار ارزیابی جهت نمایش برای هر ارزیاب
     */
    public function listArzyabi()
    {
        $notes=Note::where(['arzyab_id'=>auth()->id(),'status'=>'ارزیابی شکلی'])->get();   
        return view('pages.notes.index',compact('notes'));
    }


    /**
     * لیست یادداشتهای در انتظار بررسی محتوایی برای هر ناظر محتوایی
     */
    public function listBarrasi()
    {
        $notes=Note::where('nazer_id',auth()->id())
        ->whereIn('status',['ارزیابی محتوایی','ارزیابی مجدد'])
        // ->whereRaw('((status=ارزیابی محتوایی) OR (status=ارزیابی مجدد))')
       
        ->get();  
       // dd($notes); 
        return view('pages.notes.index',compact('notes'));
    }

    /**
     * یادداشتهایی که نهایی شده اند و مدیر باید آنها را به رابط رسانه ای ارسال کند
     */

     public function finalNotes()
     {
         $notes=Note::where('status','نهایی شده')->get();
         return view('pages.notes.index',compact('notes'));

     } 

     
    /**
     * یادداشتهای منتشر شده در رسانه ها
     */
    public function montashershode()
    {
        $notes=Note::where('status','منتشر شده در رسانه ها')->get();   
        return view('pages.notes.index',compact('notes'));
    }

    /**
     * اتفاقاتی که برای یادداشت می افتد در جدول تاریخچه ذخیره میشود
     * $id of note and $description of event
     */
    public function addToNoteHistory($id,$description,$type)
    {
       $data['note_id']=$id;
       $data['description']=$description;
       $data['created_at']=date(now());
       Note_history::create($data);
    }

    /**
     * ثبت امتیاز کاربر در هر فعالیت
     */
    public function saveUserPoint($point,$description)
    {
        try{
            $data2['user_id']=auth()->id();
            $data2['point']=-2;
            $data2['description']='انتخاب سوژه بعد از گذشت 24 ساعت از ارسال آن';
            $data2['created_at']=date(now());
            UserPoints::create($data2);
            User::where('id',auth()->id())->increment('point',$point);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * نمایش تاریخچه هر یادداشت
     */
    public function showNoteHistory($id)
    {
        $histories=Note_history::where('note_id',$id)->get();
        return view('pages.notes.history',compact('histories'));
    }

}//end of class

