@extends('masterpage')
@section('content')

<div class="row">
        <div class="col-sm-12">
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{isset($suzhe->id)? 'ویرایش':'سوژه '}}</h3>
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
    
                        @if(isset($suzhe->id))
                        {!! Form::Model($suzhe,array('class'=>'form-horizontal','route'=>['suzhe.update',$suzhe->id],'method'=>'PATCH'))!!}
                           
                        @else
                            {!! Form::open(['class'=>'form-horizontal','route'=>'suzhe.store']) !!}
                        @endif
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1">عنوان سوژه*</label>
    
                            <div class="col-sm-10">
                                {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'عنوان سوژه','required'])!!}
                                
                            </div>
                        </div>
    
                        <div class="form-group-separator"></div>
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-5">متن سوژه*</label>
    
                            <div class="col-sm-10">
                            
                            {!! Form::textarea('body', null, ['class'=>'form-control autogrow','required','placeholder'=>'توضیحات مربوط به سوژه را وارد نمایید.','style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 50px']) !!}
                            
                                
                            </div>
                        </div>
    
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">انتخاب حلقه</label>
        
                                <div class="col-sm-10">
                                        {!! Form::select('halghe_id', App\Halghe::getUserHalghes()->pluck('name','id'),null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="field-5"></label>
            
                                    <div class="col-sm-10">
                                            {!! Form::submit(empty($suzhe->id) ? 'ثبت سوژه':'بروز رسانی سوژه', ['class'=>'btn btn-success']) !!}
                                            
                                    </div>
                                </div>
                           
                            <div class="form-group-separator"></div>
                        {!! Form::close() !!}
    
                </div>
            </div>
    
        </div>
    </div>


@stop




