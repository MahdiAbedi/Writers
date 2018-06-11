<?php
namespace App\Http\Controllers;


use App\User;
use Image; 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:modir'])->except(['edit','update','getPhoto']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $roles = Role::get()->pluck('display_name','name');
        $arzyabs = User::role('arzyab')->get()->pluck('name','id');

       //$arzyabs=array(['1'=>'mahdi']);
        return view('pages.users.form',compact('roles','arzyabs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->except('roles','halghes','_token','photo'));
        $this->getPhoto($request);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $halghes= $request->input('halghes') ? $request->input('halghes') : [];
        
        $user->halghe()->attach($halghes);
        $user->assignRole($roles);

        return redirect('users')->with('message','کاربر جدید ایجاد شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * بارگزاری تصویر پروفایل کاربر
     */

    private function getPhoto(Request $request)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = $request->code_melli.'.jpg';
            $destination = base_path() . '/public/uploads/users-pic';

            $photo->move($destination, $fileName);
            
            $imagePath = base_path() . '/public/uploads/users-pic/'.$fileName;
            $image = Image::make($imagePath);

            $image->resize(250, NULL, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save();
           // $data['photo'] = $fileName;

        }
        return true;
    }
    
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //فقط هر کاربر میتواند اطلاعات خودش را ویرایش کند مگر مدیر
        if (auth()->user()->hasRole(['modir']) || (auth()->id()==$id)){
            $arzyabs = User::role('arzyab')->get()->pluck('name','id');
            $user = User::findOrFail($id);
            $halghes=$user->halghe()->pluck('id');
            $roles = Role::get()->pluck('display_name','name');
            return view('pages.users.form',compact('roles','user','arzyabs','halghes'));
        }else{
                abort(403);
        }
      
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
        $user=User::find($id);
        $data=$request->except('roles','halghes','_token','photo');
        $user->update($data);
        $this->getPhoto($request);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $halghes= $request->input('halghes') ? $request->input('halghes') : [];
        //for updating halghes we have to use sync
        $user->halghe()->sync($halghes);
        $user->syncRoles($roles);

        return redirect('users')->with('message','اطلاعات کاربر با موفقیت بروز رسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        
        if ($user->delete()) {

            $user->halghe()->detach();
            $user->roles()->detach();

            $this->deletePhoto($user->code_melli);
            return redirect('users')->with('message', 'کاربر با موفقیت حذف شد.');
        }
        return redirect('users')->with('message', 'خطایی در هنگام حذف کاربر رخ داده است.');
    }

/** 
 * Deleting user profile picture when we delete the user
 */

    public function deletePhoto($photo)
    {
        if (!empty($photo)) {
            $filepath = base_path() . '/public/uploads/users-pic/' . $photo.'.jpg';

            if (file_exists($filepath)) {
                unlink($filepath);
            }

        }

    }

    /**
     * مشاهده تاریخچه امتیازاتی که هر کاربر بدست آورده است.
     */

     public function showHistory($user_id)
     {
         echo 'user points';
     }
}//end of class