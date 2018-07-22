@extends('masterpage')
 @section('content')
<!-- Custom column filtering -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">رسانه ها</h3>
        
        <a href="media/create" class="btn btn-success pull-left btn-icon icon-left">
           ایجاد رسانه جدید
        </a>
       
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
                   
                    {column_number : 0,filter_type:'text', filter_default_label: "جستجو"},
                    {column_number : 1, filter_default_label: "انتخاب کنید"},
                    {column_number : 2, filter_default_label: "انتخاب کنید"},
                   
                    
                    {column_number : 3, data: [""], filter_default_label: "X"},
                    
                ]);
            });
        </script>

        <table class="table table-striped table-bordered" id="records">
            <thead>
                <tr class="replace-inputs"> 
                    <th>لوگو خبرگزاری</th>
                    <th>عنوان خبرگزاری</th>
                    <th>نام رابط خبرگزاری</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medias as $media)
                <tr>
                    <td class="user-image hidden-xs hidden-sm">
                        <a href="#">
                            @if(file_exists(public_path().'/uploads/resaneha/'.$media->id.'.jpg'))
                            <img src="{{'/uploads/resaneha/'.$media->id.'.jpg'}}" class="img-circle" alt="{{$media->name}}" width="40" height="40">
                            @else
                            <img src="/uploads/resaneha/unknown.jpg" class="img-circle" alt="user-pic" width="40" height="40">
                            @endif
                        </a>
                    </td>
                    <td>{{$media->name}}</td>
                    <td>{{$media->user->name or 'حذف شده'}}</td>
                   
                    <td> 
                        <a href="/media/{{$media->id}}/edit" class="btn btn-secondary btn-xs btn-icon icon-left pull-left" title="ویرایش">
                            <i class="fa-edit"></i>
                            ویرایش
                        </a>
                        @hasrole('modir')
                        {!! Form::open(['method'=>'Delete','route'=>['media.destroy',$media->id]]) !!}
        
                        <button type="submit" onclick="return confirm('شما در حال حذف رسانه هستید؟')" class="pull-right btn  btn-danger btn-icon icon-left btn-xs" title="حذف">
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
                    <th>لوگو خبرگزاری</th>
                    <th>عنوان خبرگزاری</th>
                    <th>نام رابط خبرگزاری</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

<!-- JavaScripts initializations and stuff -->
<script src="assets/js/xenon-custom.js"></script>

@endsection