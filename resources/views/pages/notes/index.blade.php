@extends('masterpage')
 @section('content')
<!-- Custom column filtering -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">یادداشت ها</h3>
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
                $("#record-list").dataTable().yadcf([
                   
                    {column_number : 0, filter_default_label: "انتخاب کنید"},
                    {column_number : 1, filter_default_label: "انتخاب کنید"},
                    {column_number : 2, filter_default_label: "انتخاب کنید"},
                    {column_number : 3, filter_default_label: "انتخاب کنید"},
                    {column_number : 4, filter_default_label: "انتخاب کنید"},
                    {column_number : 5,filter_type:'text', filter_default_label: "جستجو"},
                    {column_number : 6, data: [""], filter_default_label: "X"},
                    
                ]);
            });
        </script>

        <table class="table table-striped table-bordered" id="records">
            <thead>
                <tr class="replace-inputs"> 
                    <!-- <th>عنوان</th> -->
                    <th>سوژه</th>
                    <th>حلقه</th>
                    <th>یادداشت نویس</th>
                    <th>وضعیت</th>
                    <th>ناظر محتوایی</th>
                    <th>ارزیاب</th>
                    <th>فرصت باقی مانده</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notes as $note)
                <tr>
                    <!-- <td>{{$note->title}}</td> -->
                    <td>{{$note->suzhe->title}}</td>
                    <td>{{$note->suzhe->halghe->name or 'حذف شده'}}</td>
                    <td>{{$note->user->name}}</td>
                    <td>{{$note->status}}</td>
                    {{-- <td>{{isset($note->nazer->name) ?$note->nazer->name :'نامشخص'}}</td> --}}
                   @hasrole('modir')
                    <td>{{$note->nazer->name or 'حذف شده'}}</td>
                    <td>{{$note->arzyab->name or 'حذف شده'}}</td>
                    @else
                    <td>---</td>
                    <td>---</td>
                    @endhasrole
                    <td class="btn btn-danger" id="timer">{{$note->updated_at}}</td>
                    <td>
                             @hasrole('writer')
                                @if(in_array($note->status,['اعلام آمادگی','تایید به شرط اصلاح']))
                                    <a href="/notes/{{$note->id}}/edit" class="btn btn-secondary btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                        <i class="fa-edit"></i>
                                        ویرایش
                                    </a>
                                @endif
                         
                            @endhasrole
                            @hasrole('ozve_halghe')
                            <a href="/notes/{{$note->id}}" class="btn btn-warning btn-xs btn-icon icon-left pull-left" title="مشاهده">
                                <i class="fa-search-plus"></i>
                                بررسی محتوایی
                            </a>
                            @endhasrole
                            {{--  @hasrole('modir_halghe')
                            <a href="/set-nazer/{{$note->id}}" class="btn btn-secondary btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-user"></i>
                                تعیین ناظر
                            </a>
                            @endhasrole  --}}
                            @hasrole('arzyab')
                            <a href="/arzyabi/{{$note->id}}" class="btn btn-success btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-thumbs-o-up"></i>
                                ارزیابی
                            </a>
                            @endhasrole

                            @hasrole('modir|writer|modir_halghe')
                            <a href="/history/{{$note->id}}" class="btn btn-gray btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-history"></i>
                                تاریخچه
                            </a>
                            @endhasrole

                            <a href="/notes/{{$note->id}}" class="btn btn-info btn-xs btn-icon icon-left pull-left" title="مشاهده">
                                <i class="fa-eye"></i>
                                مشاهده
                            </a>
                           
                            @hasrole('modir')
                            {!! Form::open(['method'=>'Delete','route'=>['notes.destroy',$note->id]]) !!}
            
                            <button type="submit" onclick="return confirm('شما در حال حذف یادداشت هستید؟')" class="pull-right btn  btn-danger btn-icon icon-left btn-xs" title="حذف">
                              <i class="fa-trash"></i>
                              حذف
                            </button>
                            @endhasrole
                            {!! Form::close() !!}
                            
                            

                        </td>
                </tr>
                @empty
                <div class="alert alert-success">
                        <p style="color:white">یادداشتی یافت نشد.</p>
                </div>
                @endforelse



            </tbody>
            <tfoot>
                <tr>
                    <!-- <th>عنوان</th> -->
                    <th>سوژه</th>
                    <th>حلقه</th>
                    <th>یادداشت نویس</th>
                    <th>وضعیت</th>
                    <th>ناظر محتوایی</th>
                    <th>ارزیاب</th>
                    <th>فرصت باقی مانده</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

<!-- JavaScripts initializations and stuff -->
<script src="assets/js/xenon-custom.js"></script>

<script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{(isset($note->expire_date))? $note->expire_date :0}}").getTime();
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
          // Get todays date and time
          var now = new Date().getTime();
        
          // Find the distance between now an the count down date
          var distance = countDownDate - now;
        
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
          // Display the result in the element with id="demo"
          document.getElementById("timer").innerHTML = seconds + ": " + minutes + ": "
          + hours + "- " + days +"روز " ;
        
          // If the count down is finished, write some text 
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "منقضی شد";
          }
        }, 1000);
        </script>

@endsection