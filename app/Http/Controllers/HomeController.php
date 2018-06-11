<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //به دست آورد تعداد و وضعیت هر یادداشت
        // SELECT COUNT(id), `status`
        // FROM notes
        // WHERE user_id =30
        // GROUP BY `status`;

        /**
         * تعداد و سمت هر کاربر
         */

        // SELECT COUNT(model_id), `role_id` ,(select display_name from roles where id=role_id) as 'rolename'
        // FROM model_has_roles
        // GROUP BY `role_id`;
        // return view('home');


    }

    public function dashboard()
    {
        /**تعداد یادداشتها و وضعیت هر یادداشت را به کاربر نمایش میدهیم */
        $query = "SELECT COUNT(id) as count, `status` FROM notes ";
        if (!auth()->user()->hasRole('modir')) {
            $query .= "WHERE user_id =" . auth()->id();
        }
        $query .= " GROUP BY `status`;";
        $notes_status = DB::select($query);
        /*****************************************************/
        /**تعداد و سمت هر کاربر فقط برای مدیر */
        if (auth()->user()->hasRole('modir')) {

        }
        $query = "SELECT COUNT(model_id) as count, `role_id` ,(select display_name from roles where id=role_id) as 'semat'
     FROM model_has_roles
     GROUP BY `role_id`;";
        $users_semat = DB::select($query);
        /*****************************************************/
        return view('pages.dashboard', compact('notes_status', 'users_semat'));
    }//end of dashboard

}//end of class
