@extends('masterpage')
 @section('content')
<!-- Custom column filtering -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">اعضای شبکه نویسندگان</h3>
        @hasrole('modir')
        <a href="users/create" class="btn btn-success pull-left btn-icon icon-left">
            ایجاد کاربر جدید
        </a>
        @endhasrole
        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
    </div>
    <div class="panel-body">
    @include('setup/datatable_setup')
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $("#record-list").dataTable().yadcf( [
                   <?php $roles=DB::table('roles')->pluck('display_name');
                         $halghes=DB::table('halghes')->pluck('name');
                   ?>
                    {column_number : 0,data:[], filter_default_label: "تصویر"},
                    {column_number : 1,filter_type:'text', filter_default_label: "جستجو کنید"},
                    {column_number : 2, data: [@foreach($roles as $role)
                        {!!'"'.$role.'",'!!}
                        @endforeach
                        ], filter_default_label: "انتخاب کنید"},
                        {column_number : 3, data: [@foreach($halghes as $halghe)
                            {!!'"'.$halghe.'",'!!}
                            @endforeach
                            ], filter_default_label: "انتخاب کنید"},
                    {column_number : 4, data: ["فعال", "مسدود"], filter_default_label: "انتخاب کنید"},
                    {column_number : 5, data: ["Yes", "No"], filter_default_label: "انتخاب کنید"},

                ]);
            });
        </script>

        <table class="table table-striped table-bordered" id="records">
            <thead>
                <tr class="replace-inputs">
                    <th>تصویر</th>
                    <th>نام و نام خانوادگی</th>
                    <th>سمت</th>
                    <th>نام حلقه</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="user-image hidden-xs hidden-sm">
                        <a href="#">
                            @if(file_exists('uploads/users-pic/'.$user->code_melli.'.jpg'))
                            <img src="{{'/uploads/users-pic/'.$user->code_melli.'.jpg'}}" class="img-circle" alt="{{$user->name}}" width="40" height="40">
                            @else
                            <img src="/assets/images/user-1.png" class="img-circle" alt="user-pic">
                            @endif
                        </a>
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->userSemat($user)}}</td>
                    <td>@foreach($user->halghe as $halghe)
                        {{$halghe->name .' ، '}}
                        @endforeach
                    </td>
                    <td><a class='btn btn-{{$user->active ? 'success':'red'}}' href="">{{($user->active)?'فعال' : 'مسدود'}}</a></td>
                    <td>
                            <a href="/user/history/{{$user->id}}" class="btn btn-info btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-star"></i>
                                تاریخچه امتیازات
                            </a>
                            <a href="/users/{{$user->id}}/edit" class="btn btn-secondary btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-edit"></i>
                                ویرایش
                            </a>

                            <a href="/invoice/{{$user->id}}" class="btn btn-secondary btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-edit"></i>
                               صورت حساب
                            </a>

                            {!! Form::open(['method'=>'Delete','route'=>['users.destroy',$user->id]]) !!}
            
                            <button type="submit" onclick="return confirm('شما در حال حذف کاربر هستید؟')" class="pull-right btn  btn-danger btn-icon icon-left btn-xs" title="حذف کاربر">
                              <i class="fa-trash"></i>
                              حذف
                            </button>
                            
                            {!! Form::close() !!}
                            
                           
                    </td>
                </tr>
                @empty
                <div class="alert alert-success">
                        <p style="color:white">کاربری یافت نشد.</p>
                </div>
                @endforelse



            </tbody>
            <tfoot>
                <tr>
                    <th>تصویر</th>
                    <th>نام و نام خانوادگی</th>
                    <th>سمت</th>
                    <th>نام حلقه</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

<!-- JavaScripts initializations and stuff -->
<script src="assets/js/xenon-custom.js"></script>

@endsection