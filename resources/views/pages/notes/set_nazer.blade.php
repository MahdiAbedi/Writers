@extends('masterpage') @section('content')
{{--  تعیین ناظر محتوایی از سوی مدیر محتوایی حلقه  --}}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            
            <div class="panel-body">

                @if(isset($note->id)) {!! Form::Model($note,array('class'=>'form-horizontal','route'=>['notes.update',$note->id],'method'=>'PATCH'))!!}
               @endif

               <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$note->title}}</h3>
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
                    <div class="ps-container ps-active-y" data-max-height="400" style="max-height: 400px;">
                        {!! Form::textarea(null, $note->body, ['class'=>'form-control autogrow tinymce','required','style'=>'overflow: hidden; word-wrap: break-word; resize: both;height: 80px;']) !!}

                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -230px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 233px; height: 400px; right: 2px;"><div class="ps-scrollbar-y" style="top: 75px; height: 129px;"></div></div></div>
                    
                </div>
            </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">ناظر محتوایی</label>

                    <div class="col-sm-10">
                        {!! Form::select('nazer_id',DB::table('user_role_halghe')->where(['role'=>'ozve_halghe','halghe_id'=>$note->suzhe->halghe->id])->pluck('user_name','user_id'),isset($note->nazer_id)?$note->nazer_id:null,
                        ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group-separator"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="field-5"></label>

                    <div class="col-sm-10">
                        {!! Form::submit('ثبت ناظر محتوایی', ['class'=>'btn btn-success']) !!}

                    </div>
                </div>

                <div class="form-group-separator"></div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>
<script src="/assets/js/tinymce/tinymce.min.js"></script>
<script src="/assets/js/tinymce/tinymce.setup.js"></script>
@stop