@extends('masterpage')
 @section('content')
<!-- Custom column filtering -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">لیست سوژه ها</h3>
        @hasrole('modir_halghe')
            <a href="suzhe/create" class="btn btn-success pull-left btn-icon icon-left">
                ایجاد سوژه جدید
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
             /*عدم نمایش برخی ستونها برای برخی کاربران*/
            
            
         
            $(document).ready(function() {
               {{--  table.column( 2 ).visible( false, false );  --}}
                $('#records').dataTable().yadcf([
                                    
                    {{--  {column_number : 2, data: ["Yes", "No"], filter_default_label: "Select Yes/No"},  --}}
                    {column_number : 0,filter_type:'text', filter_default_label: "جستجو"},
                    {column_number : 1, filter_default_label: "انتخاب کنید"},
                    {column_number : 2, filter_default_label: "انتخاب کنید"},
                    {column_number : 3, filter_default_label: "انتخاب کنید"},
                    {column_number : 4, filter_default_label: "انتخاب کنید"},
                    {column_number : 5, filter_default_label: "انتخاب کنید"},
                    {column_number : 6, filter_default_label: "انتخاب کنید"},
                    {column_number : 7, data: [""], filter_default_label: "X"},

                    ]);
                        
                     
            }); // End of use strict   
        </script>
<style>
    @hasanyrole('writer1')
#sender_name{
    display: none;

    @endhasanyrole
}

</style>
        <table class="table table-bordered table-striped table-hover display" id="records" >
            <thead>
                <tr class="replace-inputs"> 
                    <th>عنوان</th>
                    <th>حلقه</th>
               
                    <th id="sender_name">ارسال کننده</th>
               
                    <th>وضعیت</th>
                    <th>محدودیت</th>
                    <th>داوطلبین</th>
                    <th>مهلت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suzhes as $suzhe)
                <tr>
                   
                    <td>{{$suzhe->title}}</td>
                    <td>{{$suzhe->halghe->name}}</td>
                
                    <td id="sender_name">
                    @hasanyrole('modir|ozve_halghe')
                        {{$suzhe->user->name}}
                        @else
                        نامشخص
                    @endhasanyrole

                    </td>
               
                    <td>{{$suzhe->status}}</td>
                    <td>{{$suzhe->user_limit}} نفر</td>
                    <td>{{$suzhe->choosed_users}} نفر</td>
                    <td class="btn btn-danger" id="timer">{{$suzhe->updated_at}}</td>
                    <td>
                        @hasrole('modir_halghe')
                            <a href="/suzhe/{{$suzhe->id}}/edit" class="btn btn-secondary btn-xs btn-icon icon-left pull-left" title="ویرایش">
                                <i class="fa-edit"></i>
                                ویرایش
                            </a>
                        @endhasrole

                        @hasrole('modir')
                            {!! Form::open(['method'=>'Delete','route'=>['suzhe.destroy',$suzhe->id]]) !!}
            
                            <button type="submit" onclick="return confirm('شما در حال حذف سوژه هستید؟')" class="pull-right btn  btn-danger btn-icon icon-left btn-xs" title="حذف">
                              <i class="fa-trash"></i>
                              حذف
                            </button>
                        @endhasrole    
                            {!! Form::close() !!}
                            <a href="suzhe/{{$suzhe->id}}" class="btn btn-info btn-xs btn-icon icon-left pull-left" title="مشاهده">
                                <i class="fa-eye"></i>
                                مشاهده
                            </a>
                        </td>
                </tr>
                @empty
                <div class="alert alert-success">
                        <p style="color:white">سوژه ای یافت نشد.</p>
                </div>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>عنوان</th>
                    <th>حلقه</th>
               
                    <th  id="sender_name">ارسال کننده</th>
               
                    <th>وضعیت</th>
                    <th>محدودیت</th>
                    <th>داوطلبین</th>
                    <th>مهلت</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{(isset($suzhe->expire_date))? $suzhe->expire_date :0}}").getTime();
    
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