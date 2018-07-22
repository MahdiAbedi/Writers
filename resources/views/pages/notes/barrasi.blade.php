@extends('masterpage')
 @section('content')
 <div class="row">
    <div class="col-sm-12">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$note->title}}</h3>
                <div class="col-sm-2">
                    <a class="btn btn-info" href="/uploads/notes/{{$note->id}}.docx">دانلود فایل یادداشت</a>
                </div>
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

        
        {!! Form::open(['class'=>'form-horizontal','route'=>'nazer.store']) !!}

        <div class="form-group-separator"></div>

        {!! Form::hidden('note_id', $note->id, null) !!}

        <div class="form-group">
            <label class="col-sm-2 control-label" for="field-5">اصلاحات:</label>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                    {!! Form::textarea('body', isset($nazer->id)?$nazer->body:null, ['class'=>'form-control autogrow','required','style'=>'overflow: hidden; word-wrap: break-word; resize: both;height: 80px;']) !!}

            </div>
        </div>

        <div class="form-group-separator"></div>
        
        
        
        @if($note->status !='ارزیابی مجدد')
        <button type="submit" class="btn btn-secondary  btn-icon icon-left" title="ویرایش">
            <i class="fa-edit"></i>
            تایید به شرط اصلاح
        </button>
        {{--  @else
        {{'این یادداشت ارزیابی اولیه شده است'}}  --}}
        @endif
        <a href="/notes/{{$note->id}}/reject" class="pull-left btn  btn-danger btn-icon icon-left" title="رد سوژه">
            <i class="fa-trash"></i>
          یادداشت مردود است
          </a>
  
          <a href="/notes/{{$note->id}}/publish" class="btn btn-success  btn-icon icon-left pull-left" title="مشاهده">
              <i class="fa-eye"></i>
             تایید یادداشت
          </a>
        {!! Form::close() !!}
       
    </div>
</div>
<script src="/assets/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        /* replace textarea having class .tinymce with tinymce editor */
        selector: "textarea.tinymce",
        /* theme of the editor */
        theme: "modern",
        skin: "lightgray",   
        /* width and height of the editor */
        width: "100%",
        height: 300,
        directionality: 'rtl',  
       
    });
</script>

@stop