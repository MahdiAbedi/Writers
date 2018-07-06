@extends('masterpage') @section('content')

<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{isset($note->id)? 'ویرایش':'یادداشت '}}</h3>
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

                @if(isset($note->id)) {!! Form::Model($note,array('class'=>'form-horizontal','route'=>['notes.update',$note->id],'method'=>'PATCH'))!!}
                @else {!! Form::open(['class'=>'form-horizontal','route'=>'notes.store']) !!} @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="field-1">عنوان یادداشت*</label>

                    <div class="col-sm-10">
                        {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'عنوان یادداشت','required'])!!}

                    </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="field-5">متن یادداشت*</label>

                    <div class="col-sm-10">
                            {!! Form::textarea('body', null, ['class'=>'form-control autogrow tinymce','style'=>'overflow: hidden; word-wrap: break-word; resize: both;height: 80px;']) !!}

                    </div>
                </div>
                
                <div class="form-group-separator"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="field-5"></label>

                    <div class="col-sm-10">
                        {!! Form::submit(empty($note->id) ? 'ثبت یادداشت':'بروز رسانی یادداشت', ['class'=>'btn btn-success']) !!}

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