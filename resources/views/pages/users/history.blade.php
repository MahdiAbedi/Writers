@extends('masterpage') @section('content')
<?php
use Carbon\Carbon;
?>
	<div class="page-title">
			
        <div class="title-env">
            <h1 class="title">تاریخچه</h1>
            <p class="description">و خط زمانی امتیازات و فعالیت های کاربر                                                                                                                                                                                                                                                                                                                                                                                                                                             </p>
        </div>
    
       
        
    </div>
			
    <ul class="cbp_tmtimeline">
        <li>
            <time class="cbp_tmtime" datetime="2014-12-06T18:30"><span class="hidden">06/12/2014</span> <span class="large">اکنون</span></time>
            
            <div class="cbp_tmicon timeline-bg-gray">
                <i class="fa-user"></i>
            </div>
            
            <div class="cbp_tmlabel empty">
                <span>بدون اقدام</span>
            </div>
        </li>
        @foreach($histories as $history)
        <li>
            <time class="cbp_tmtime" datetime="{{$history->created_at}}"><span>{{$history->created_at->diffForHumans()}}</span> <span>{{$history->created_at}}</span></time>
            
            <div class="cbp_tmicon timeline-bg-success">
                <i class="fa-paper-plane-o"></i>
            </div>
            
            <div class="cbp_tmlabel">
                <h2><span>{{$history->point}} امتیاز</span></h2>
                <p>{{$history->description}}</p>
            </div>
        </li>
       @endforeach 
     
    </ul>
@stop