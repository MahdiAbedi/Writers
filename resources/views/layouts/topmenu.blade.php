<nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->
	<?php
use Carbon\Carbon;
?>		
    <!-- Right links for user info navbar -->
    <ul class="user-info-menu right-links list-inline list-unstyled">

        <li class="hidden-sm hidden-xs">
            <a href="#" data-toggle="sidebar">
                <i class="fa-bars"></i>
            </a>
        </li>

        <li class="dropdown hover-line">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa-envelope-o"></i>
                <span class="badge badge-green">{{count($messages)}}</span>
            </a>

            <ul class="dropdown-menu messages">
                    <li class="top">
                            <p class="small">
                                <a href="#" class="scripts/"></a>
                                شما <strong>{{count($messages)}}</strong> پیغام جدید دارید.
                            </p>
                    </li>

                <li> 
                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                            
                @foreach($messages as $message)
                        <li class="active"><!-- "active" class means message is unread -->
                            <a href="#">
                                <span class="line">
                                    <strong>{{$message->getUserName->name}}</strong>
                                    <span class="light small">  {{$message->created_at->diffForHumans()}}</span>
                                </span>
                
                                <span class="line desc small">
                                    {{$message->body}}
                                </span>
                            </a>
                        </li>
                @endforeach
                    </ul>
                
                </li>
                
                <li class="external">
                    <a href="mailbox-main.html">
                        <span>مشاهده تمام پیام ها</span>
                        <i class="fa-link-ext"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li class="dropdown hover-line">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa-bell-o"></i>
                <span class="badge badge-purple">{{count($sysMsges)}}</span>
            </a>

            <ul class="dropdown-menu notifications">
                <li class="top">
                    <p class="small">
                        <a href="#" class="scripts/"></a>
                        شما <strong>{{count($sysMsges)}}</strong> پیام سیستمی جدید دارید.
                    </p>
                </li>
                
                <li>
                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                        @foreach($sysMsges as $sysMsg)
                        <li class="active notification-success">
                            <a href="#">
                                <i class="fa-user"></i>
                                
                                <span class="line small time">
                                    <strong>{{$sysMsg->title}}</strong>
                                </span>
                                <span class="line">
                                    <strong>{{$sysMsg->body}}</strong>
                                </span>
                                
                                <span class="line small time">
                                    {{$sysMsg->created_at->diffForHumans()}}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                
                <li class="external">
                    <a href="#">
                        <span>نمایش تمام اعلان ها</span>
                        <i class="fa-link-ext"></i>
                    </a>
                </li>
            </ul>
        </li>

    </ul>


    <!-- Left links for user info navbar -->
    <ul class="user-info-menu left-links list-inline list-unstyled">
                

        <li class="dropdown user-profile">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(file_exists('uploads/users-pic/'.auth()->user()->code_melli.'.jpg'))
                    <img src="{{'/uploads/users-pic/'.auth()->user()->code_melli.'.jpg'}}" class="img-circle img-inline userpic-32" alt="{{auth()->user()->name}}" width="28" height="28">
                    @else
                    <img src="/assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                    @endif
                <span>
                        {{auth()->user()->name}}
                    <i class="fa-angle-down"></i>
                </span>
            </a>

            <ul class="dropdown-menu user-profile-menu list-unstyled">
                <li>
                    <a href="#edit-profile">
                        <i class="fa-edit"></i>
                        New Post
                    </a>
                </li>
                <li>
                    <a href="#settings">
                        <i class="fa-wrench"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <a href="#profile">
                        <i class="fa-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#help">
                        <i class="fa-info"></i>
                        Help
                    </a>
                </li>
                <li class="last">
                    <a href="extra-lockscreen.html">
                        <i class="fa-lock"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" data-toggle="chat">
                <i class="fa-comments-o"></i>
            </a>
        </li>
        <li class="search-form"><!-- You can add "always-visible" to show make the search input visible -->

            <form name="userinfo_search_form" method="get" action="extra-search.html">
                <input type="text" name="s" class="form-control search-field" placeholder="Type to search..." />

                <button type="submit" class="btn btn-link">
                    <i class="linecons-search"></i>
                </button>
            </form>

        </li>
    </ul>

</nav>