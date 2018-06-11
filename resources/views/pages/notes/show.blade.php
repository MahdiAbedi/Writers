@extends('masterpage') @section('content')
<div class="row">
        <div class="col-sm-12">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$note->title}}</h3>
                    @if($note->point)
                    <div class="pull-left btn btn-success">
                        <p style="color:white">امتیاز کسب شده
                             <span class="badge badge-blue">{{$note->point}}</span>
                        </p>
                    </div>
                    @endif
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

        </div>
</div>

@if($note->status=='نهایی شده')
{{--  اگر یادداشت نهایی شد مدیر میتواند آنرا بین رسانه ها توزیع کند  --}}
<div class="panel panel-default">
    <div class="panel-heading">جهت انتشار این یادداشت در رسانه ها،رسانه مورد نظر خود را انتخاب نمایید.</div>
    <div class="panel-body">	
        {!! Form::open(['class'=>'form-horizontal','route'=>'arzyabi.store']) !!}
        <section class="gallery-env">
            <div class="row">

                <div class="col-sm-12 gallery-right">
                    <!-- Album Images -->
                    <div class="album-images row ui-sortable">
                    @foreach($medias as $media)
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6 ui-sortable-handle" style="position: relative; left: 0px; top: 0px;">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="/uploads/resaneha/{{$media->id}}.jpg" class="img-responsive" width="150" height="150">
                                </a>
        
                                <a href="#" class="name">
                                    <span>{{$media->name}}</span>
                                    <em>{{$media->user->name}}</em>
                                </a>
        
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
        
                                <div class="image-checkbox">
                                    <div class="cbr-replaced cbr-checked"><div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div><div class="cbr-state"><span></span></div></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
        
        
                    
        
                </div>
            </div>
        </section>
       
        </form>
    </div>
    <div class="panel-footer">سامانه ارزیابی یادداشتها</div>

</div>




@endif

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

<!-- Imported scripts on this page -->
<script src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/js/knob/jquery.knob.min.js"></script>

@stop