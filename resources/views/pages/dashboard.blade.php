@extends('masterpage')

@section('content')

    <!-- Xenon Counter Widget -->
    <div class="row">
@forelse($notes_status as $status)
        <div class="col-sm-3">
            <div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="{{$status->count}}" data-suffix="" data-duration="1">
                <div class="xe-icon">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">0</strong> یادداشت
                    <span>{{$status->status}}</span>
                </div>
            </div>
        </div>
@empty
<div class="col-sm-3">
        <div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="0" data-suffix="" data-duration="1">
            <div class="xe-icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <div class="xe-label">
                <strong class="num">0</strong> یادداشت
                <span>هیچ یادداشتی ندارید</span>
            </div>
        </div>
    </div>
@endforelse
    </div> {{--end of first row --}}
    <!-- Xenon Block Counter Widget -->
    {{--  <div class="row">
       
        <div class="col-sm-3">
            <div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="5" data-suffix=" نفر" data-duration="1">
                <div class="xe-upper">
                    
                    <div class="xe-icon">
                        <i class="fa-users"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0</strong>
                        <span>مدیر</span>
                    </div>
                    
                </div>
                <div class="xe-lower">
                    <div class="border"></div>
                    <span>Result</span>
                    <strong>78% Increase</strong>
                </div>
            </div>
            
        </div>
    </div>  --}}
    
    @hasrole('modir')
    <!-- Xenon Progress Counter Widget -->
    <div class="row">
    @forelse($users_semat as $user)
        <div class="col-sm-3">
            <div class="xe-widget xe-progress-counter xe-progress-counter-turquoise2" data-count=".num" data-from="0" data-to="{{$user->count}}" data-suffix=" نفر" data-duration="2">
                
                <div class="xe-background">
                    <i class="fa-star-o"></i>
                </div>
                
                <div class="xe-upper">
                    <div class="xe-icon">
                        <i class="fa-users"></i>
                    </div>
                    <div class="xe-label">
                        <span>اعضاء</span>
                        <strong class="num">0</strong>
                    </div>
                </div>
                
                <div class="xe-progress">
                    <span class="xe-progress-fill" data-fill-from="0" data-fill-to="0" data-fill-unit="%" data-fill-property="width" data-fill-duration="1" data-fill-easing="true"></span>
                </div>
                
                <div class="xe-lower">
                    <span>بعنوان</span>
                    <strong>{{$user->semat}}</strong>
                </div>
                
            </div>
            
        </div>
        @empty
        @endforelse
    </div>
    @endhasrole
    
    <!-- Xenon Verical Counter -->
    <div class="row">
        <div class="col-sm-3">
            
            <div class="xe-widget xe-vertical-counter xe-vertical-counter-yellow" data-count=".num" data-from="0" data-to="128.4" data-decimal="," data-suffix="%" data-duration="2.5">
                <div class="xe-icon">
                    <i class="linecons-videocam"></i>
                </div>
                
                <div class="xe-label">
                    <strong class="num">0,0%</strong>
                    <span>Video Views</span>
                </div>
            </div>
            
        </div>
        <div class="col-sm-3">
            
            <div class="xe-widget xe-vertical-counter xe-vertical-counter-danger" data-count=".num" data-from="0" data-to="67.9" data-decimal="," data-suffix="%" data-duration="3">
                <div class="xe-icon">
                    <i class="linecons-doc"></i>
                </div>
                
                <div class="xe-label">
                    <strong class="num">0,0%</strong>
                    <span>Document Downloads</span>
                </div>
            </div>
            
        </div>
        <div class="col-sm-3">
            
            <div class="xe-widget xe-vertical-counter xe-vertical-counter-white" data-count=".num" data-from="0" data-to="128" data-duration="4">
                <div class="xe-icon">
                    <i class="linecons-lightbulb"></i>
                </div>
                
                <div class="xe-label">
                    <strong class="num">0</strong>
                    <span>New Topics Published</span>
                </div>
            </div>
            
        </div>
        <div class="col-sm-3">
            
            <div class="xe-widget xe-vertical-counter xe-vertical-counter-primary" data-count=".num" data-from="0" data-to="442" data-suffix=" TB" data-duration="5">
                <div class="xe-icon">
                    <i class="linecons-truck"></i>
                </div>
                
                <div class="xe-label">
                    <strong class="num">0</strong>
                    <span>Traffic Delivered</span>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Imported scripts on this page -->
    <script src="assets/js/xenon-widgets.js"></script>

@endsection
