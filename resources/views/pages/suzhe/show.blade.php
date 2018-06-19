@extends('masterpage')
@section('content')

<div class="row">
        <div class="col-sm-12">
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">تایید و بررسی سوژه</h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">–</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="remove">
                            ×
                        </a>
                    </div>
                </div>
                <div class="panel-body">
    
                       
                        {!! Form::Model($suzhe,array('class'=>'form-horizontal','route'=>['suzhe.update',$suzhe->id],'method'=>'PATCH'))!!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1">عنوان سوژه*</label>
    
                            <div class="col-sm-10">
                                {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'عنوان سوژه','readonly'])!!}
                                
                            </div>
                        </div>
    
                        <div class="form-group-separator"></div>
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-5">متن سوژه*</label>
    
                            <div class="col-sm-10">
                            
                            {!! Form::textarea('body', null, ['class'=>'form-control autogrow','readonly','placeholder'=>'توضیحات مربوط به سوژه را وارد نمایید.','style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 50px']) !!}
                            
                                
                            </div>
                        </div>
    
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">انتخاب حلقه</label>
        
                                <div class="col-sm-10">
                                        {!! Form::select('halghe_id', App\Halghe::getUserHalghes()->pluck('name','id'),null, ['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>
                            
                            @hasrole('shabake')
                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="field-1">محدودیت یادداشت</label>
            
                                    <div class="col-sm-10">
                                        {!!Form::number('user_limit',4,['class'=>'form-control'])!!}
                                        
                                    </div>
                            </div>
                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="field-1">زمان انقضای سوژه</label>
            
                                    <div class="col-sm-10">
                                        
                                            {!! Form::text('expire_date', null, ['class'=>'form-control input-small','id'=>'datepicker6']) !!}
                                       
                                        
                                    </div>
                            </div>
                            @endhasrole
                            {!! Form::hidden('status', 'منتشر شده', ['class'=>'form-control']) !!}
                            
                                <div class="form-group-separator"></div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="field-5"></label>
            
                                    <div class="col-sm-10">
                                            @hasrole('writer')
                                    <a href="/choosesuzhe/{{$suzhe->id}}" class="btn btn-secondary  btn-icon icon-left pull-left" title="ویرایش">
                                        <i class="fa-edit"></i>
                                        انتخاب سوژه برای یادداشت نویسی
                                    </a>
                                    @endhasrole
                            @hasrole('shabake')
                                    <a href="/suzhe/{{$suzhe->id}}/reject" class="pull-left btn  btn-danger btn-icon icon-left" title="رد سوژه">
                                      <i class="fa-trash"></i>
                                    عدم تایید سوژه
                                    </a>
                            
                                    <button type="submit" class="btn btn-success  btn-icon icon-left pull-left" title="مشاهده">
                                        <i class="fa-eye"></i>
                                        تائید سوژه
                                    </button>
                                            
                                    </div>
                                    
                                </div>
                           
                            <div class="form-group-separator"></div>
                        {!! Form::close() !!}
    
                </div>
            </div>
    
        </div>
    </div>


@endhasrole
    </div>
</div>
<!-- Imported scripts on this page -->
                            <script src="/assets/js/datepicker/bootstrap-datepicker.js"></script>
                            <script src="/assets/js/datepicker/bootstrap-datepicker.fa.js"></script>
<link rel="stylesheet" href="/assets/js/datepicker/bootstrap-datepicker.css">
<script>
        $(document).ready(function() {
            $("#datepicker6").datepicker({
                isRTL: true,
                dateFormat: "yy/mm/dd 23:59:59",
                changeMonth: true,
                changeYear: true

            });
        });
    </script>
@stop