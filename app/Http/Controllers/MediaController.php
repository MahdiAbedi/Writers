<?php

namespace App\Http\Controllers;
use Image; 
use App\Note;
use App\User;
use App\Media;
use Illuminate\Http\Request;
use App\Waiting;


class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias=Media::all();
        return view('pages.media.index',compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rabets = User::role('media')->get()->pluck('name','id');
        return view('pages.media.form',compact('rabets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Media::create($request->except('_token','photo'));
        $this->getPhoto($request);
        return redirect('media')->with('message','رسانه با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(media $media)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rabets = User::role('media')->get()->pluck('name','id');
        $media=Media::find($id);
        return view('pages.media.form',compact('media','rabets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $media=Media::find($id);
        $data=$request->except('_token','photo');
        $media->update($data);
        $this->getPhoto($request);
        return redirect('media')->with('message','رسانه با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media=Media::find($id);
        if ($media->delete()) {
            $this->deletePhoto($id);
        }
        return redirect('media')->with('message','رسانه با موفقیت حذف شد.');
    }


    /**
     * حذف تصویر رسانه از سرور
     */

    public function deletePhoto($photo)
    {
        if (!empty($photo)) {
            $filepath = base_path() . '/public/uploads/resaneha/' . $photo.'.jpg';

            if (file_exists($filepath)) {
                unlink($filepath);
            }

        }

    }

    /**
     * بارگزاری تصویر رسانه
     */

    private function getPhoto(Request $request)
    {
        $media=Media::where('name',$request['name'])->first();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = $media->id.'.jpg';
            $destination = base_path() . '/public/uploads/resaneha';

            $photo->move($destination, $fileName);
            
            $imagePath = base_path() . '/public/uploads/resaneha/'.$fileName;
            $image = Image::make($imagePath);

            $image->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save();
           // $data['photo'] = $fileName;

        }
        return true;
    }

        /**
         * ذخیره یادداشت در رسانه ها
         */
        public function storeMediaForNote(Request $request)
        {
            $note=Note::find($request['note_id']);
            //dd($note);
            $medias=$request->except('note_id','_token');
           // dd($medias);
            $note->medias()->sync($medias);
            $note->update(['status'=>'در صف انتشار رسانه ها']);
            return redirect('notes/final')->with('message','یادداشت برای رابطهای رسانه ای ارسال شد.');
            
        }


        /**
      * یادداشتهای در انتظار انتشار در رسانه توسط رابط رسانه ای
      */

      public function waiting()
      {
        $waitings=Waiting::where('user_id',auth()->id())->get();
        return view('pages.media.waitinglist',compact('waitings'));
      }


      /**
       * ثبت لینک یادداشت در خبرگزاری ها
       */

       public function seturl(Request $request)
       {
           //وقتی لینک یادداشت در خبرگزاری ثبت بشه وضعیت یادداشت تغییر میکنه
           $note=Note::find($request['note_id']);
           $note->update(['status'=>'منتشر شده در رسانه ها']);

           //لینک باید در جدول 
           //Notes_media
           //هم ثبت بشه
           //چون ما داریم از ویو استفاده میکنیم هر تغییری که تو ویو اعمال کنیم روی جدولهای اصلی هم اعمال میشه

           $waiting=Waiting::where(['media_id'=>$request['media_id'],'note_id'=>$request['note_id']]);
            $waiting->update(['url'=>$request['url']]);
            
            return redirect('montashershode')->with('message','یادداشت با موفقیت در رسانه منتشر شد');
            

        }

       /**نمایش صفحه ثبت لینک خبر در رسانه ها */
       public function showsabt($note_id,$media_id)
       {
           $note=Note::find($note_id);
           $media=Media::find($media_id);
           return view('pages.notes.show',compact('note','media'));
       }
}//end of class
