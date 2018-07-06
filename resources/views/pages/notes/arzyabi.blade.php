@extends('masterpage') @section('content')
<div class="row">
        <div class="col-sm-12">
            
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

        </div>
</div>


     
<div class="panel panel-default">
    <div class="panel-heading">امتیاز ارزیابی برای هر مورد بین 0 تا 20 میباشد.</div>
    <div class="panel-body">	
        {!! Form::open(['class'=>'form-horizontal','route'=>'arzyabi.store']) !!}
            {!! Form::hidden('note_id', $note->id, []) !!}
            <div class="form-group">

                    @foreach($zaribs as $zarib)
                    <h5>{{$zarib->title}}</h5>
                    <div class="col col-sm-6">
                        <div class="slider slider-success" data-min="10" data-max="20" data-value="15" data-fill="#{{$zarib->name}}"></div>
                        <input type="hidden" value="15" name="zaribs[{{$zarib->name}}][{{$zarib->zarib}}]" id="{{$zarib->name}}" required type="number" width="auto" min="0" max="20" class="form-control" placeholder="{{$zarib->title}}">
                    </div>
                 @endforeach   
            </div>
           
        
            <div class="form-group">
                <label class="col-sm-2 control-label" for="field-5"></label>
        
                <div class="col-sm-10">
                    {!! Form::submit('ثبت امتیاز', ['class'=>'btn btn-success']) !!}
                </div>
            </div>
        </form>
    </div>
    <div class="panel-footer">سامانه ارزیابی یادداشتها</div>

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

<!-- Imported scripts on this page -->
<script src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/js/knob/jquery.knob.min.js"></script>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="/assets/js/jquery-ui/jquery-ui.min.css">
@stop