@extends('masterpage')
@section('content')

<div class="row">
        <div class="col-sm-12">
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{isset($media->id)? 'ویرایش رسانه':'ایجاد رسانه جدید '}}</h3>
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
                        @if(isset($media->id))
                        {!! Form::Model($media,array('class'=>'form-horizontal','route'=>['media.update',$media->id],'method'=>'PATCH','files'=>true))!!}
                           
                        @else
                            {!! Form::open(['class'=>'form-horizontal','route'=>'media.store','files'=>true]) !!}
                        @endif

                                <div class="panel panel-headerless">
                                    <div class="panel-body">
                                        @if(isset($media->id))
                                        <div class="member-form-add-header">
                                            <div class="row">
                                               
                                                <div class="col-md-10 col-sm-8">
                            
                                                    <div class="user-img">
                                                            @if(file_exists(public_path().'/uploads/resaneha/'.$media->id.'.jpg'))
                                                            <img src="{{'/uploads/resaneha/'.$media->id.'.jpg'}}" class="img-circle" alt="{{$media->name}}" width="60" height="60">
                                                            @else
                                                            <img src="/uploads/resaneha/unknown.jpg" class="img-circle img-corona" alt="user-pic" width="60" height="60" />
                                                            @endif
                                                      
                                                    </div>
                                                    <div class="user-name">
                                                        <a href="#">{{$media->name}}</a>
                                                    </div>
                            
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                            
                                        <div class="member-form-inputs">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">نام رسانه*</label>
                                                </div>
                                                <div class="col-sm-9">
                                                {!! Form::text('name', null, ['class'=>'form-control','required']) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label" for="name">رابط رسانه ای</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                      
                                                      {!! Form::select('user_id', $rabets, null, ['class'=>'form-control']) !!}
                                                      
                                                    </div>
                                                </div>
                                            <div class="row">
                                                    <div class="col-sm-3">
                                                            <label class="control-label" for="name">تصویر رسانه</label>
                                                        </div>
                                                <div class="col-sm-9">
                                             {!! Form::file('photo', ['class'=>'form-control']) !!}       
     
                                                </div>
                                            </div>
                            
                                            <div class="row">
                                                <div class="col-sm-3">
                                                        <label class="control-label" for="name"></label>
                                                    </div>
                                                    
                                            <div class="col-sm-3">
                                               
                                            
                                            {!! Form::submit('ثبت', ['class'=>'form-control btn btn-success']) !!}
                                            
 
                                            </div>
                                        </div>
                        
                                        </div>
                            
                                    </div>
                                </div>
                            </form>
                            <!-- Imported styles on this page -->
                            <link rel="stylesheet" href="/assets/js/select2/select2.css">
                            <link rel="stylesheet" href="/assets/js/select2/select2-bootstrap.css">
                            <link rel="stylesheet" href="/assets/js/multiselect/css/multi-select.css">
                            <link rel="stylesheet" href="/assets/js/datepicker/bootstrap-datepicker.css">
                            
                            <!-- Imported scripts on this page -->
                            <script src="/assets/js/datepicker/bootstrap-datepicker.js"></script>
                            <script src="/assets/js/datepicker/bootstrap-datepicker.fa.js"></script>
                            <script src="/assets/js/select2/select2.min.js"></script>
                            <script src="/assets/js/multiselect/js/jquery.multi-select.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#datepicker0").datepicker();
                                
                                    $("#datepicker1").datepicker();
                                    $("#datepicker1btn").click(function(event) {
                                        event.preventDefault();
                                        $("#datepicker1").focus();
                                    })
                                
                                    $("#datepicker2").datepicker({
                                        showOtherMonths: true,
                                        selectOtherMonths: true
                                    });
                                
                                    $("#datepicker3").datepicker({
                                        numberOfMonths: 3,
                                        showButtonPanel: true
                                    });
                                
                                    $("#datepicker4").datepicker({
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                
                                    $("#datepicker5").datepicker({
                                        minDate: 0,
                                        maxDate: "+14D"
                                    });
                                
                                    $("#datepicker6").datepicker({
                                        isRTL: true,
                                        dateFormat: "yy/mm/dd",
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                });
                            </script>
@stop




