<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others fixed">
		
			<div class="sidebar-menu-inner">
				
				<header class="logo-env">
		
					<!-- logo -->
					<div class="logo">
						<a href="/dashboard" class="logo-expanded">
							<img src="/assets/images/big-logo.png" width="200" alt="" />
						</a>
		
						<a href="/dashboard" class="logo-collapsed">
							<img src="/assets/images/small-logo.png" width="40" alt="" />
						</a>
					</div>
		
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="#" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
		
						<a href="#" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
		
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
					{{--  <div class="settings-icon">
						<a href="#" data-toggle="settings-pane" data-animate="true">
							<i class="linecons-cog"></i>
						</a>
					</div>  --}}
		
					
				</header>
				
						
				<!-- Sidebar User Info Bar - Added in 1.3 -->
				<section class="sidebar-user-info" >
					<div class="sidebar-user-info-inner">
						<a href="/users/{{auth()->id()}}/edit" class="user-profile">
								
								@if(file_exists('uploads/users-pic/'.auth()->user()->code_melli.'.jpg'))
								<img src="{{'/uploads/users-pic/'.auth()->user()->code_melli.'.jpg'}}" class="img-circle" alt="{{auth()->user()->name}}" width="60" height="60">
								@else
								<img src="/assets/images/user-4.png" width="60" height="60" class="img-circle img-corona" alt="user-pic" />
								@endif
							
				
							<span>
								<strong>{{auth()->user()->name}}</strong>
								<?php $user=auth()->user();?>
    
								{{$user->userSemat($user)}}
							</span>
						</a>
				
						<ul class="user-links list-unstyled">
							<li>
								<a href="/users/{{auth()->id()}}/edit" title="ویرایش پروفایل">
									<i class="linecons-user"></i>
									ویرایش پروفایل
								</a>
							</li>
							<li>
								<a href="mailbox-main.html" title="Mailbox">
									<i class="linecons-mail"></i>
									میل باکس
								</a>
							</li>
							<li class="logout-link">
								
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
								
								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();" title="خروج">
								
								<i class="fa-power-off"></i>
								</a>
							</li>
							
						</ul>
					</div>
				</section>
				
				
				<ul id="main-menu" class="main-menu">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					
					<li>
						<a href="/suzhe">
							<i class="fa fa-bullhorn"></i>
							<span class="title">سوژه ها</span>
							<span class="label label-info scripts/">{{$suzhes_count}}</span>
						</a>
						
					</li>
					@hasanyrole('modir|modir_halghe|writer')
					<li>
							<a href="/notes">
								<i class="fa fa-book"></i>
								<span class="title">یادداشتها</span>
								<span class="label label-info scripts/">{{$note_started}}</span>
							</a>
						</li>
					<li>
					@endhasanyrole
					@hasrole('ozve_halghe')
					<li>
						<a href="/barrasi">
							<i class="fa fa-search-plus"></i>
							<span class="title">بررسی محتوایی یادداشت</span>
							<span class="label label-info scripts/">{{$nazer_count}}</span>
						</a>

					</li>
					@endhasrole
					@hasrole('arzyab')
					<li>
						<a href="/arzyabi">
							<i class="fa fa-thumbs-o-up"></i>
							<span class="title">ارزیابی شکلی یادداشت</span>
							<span class="label label-info scripts/">{{$arzyabi_count}}</span>
						</a>

					</li>
					@endhasrole
					@hasrole('modir_halghe|modir')
					<li>
						<a href="/set-nazer">
							<i class="fa-hand-o-left"></i>
							<span class="title">در انتظار تعیین ناظر محتوایی</span>
							<span class="label label-info scripts/">{{$nazer_wating}}</span>
						</a>

					</li>
					@endhasrole

					@hasrole('modir')
					<li>
						<a href="notes/final">
							<i class="fa fa-send-o"></i>
							<span class="title">یادداشتهای نهایی شده</span>
							
						</a>

					</li>
					@endhasrole
					<li>
						<a href="/montashershode">
							<i class="fa fa-chain"></i>
							<span class="title">یادداشتها در رسانه ها</span>
							
						</a>

					</li>
					@hasrole('media')
					<li>
						<a href="/waiting">
							<i class="fa fa-chain"></i>
							<span class="title">یادداشتهای در انتظار انتشار</span>
							<span class="label label-info scripts/">7</span>
						</a>

					</li>
					@endhasrole
					@hasrole('modir')
					<li>
						<a href="/users">
							<i class="fa fa-users"></i>
							<span class="title">کاربران</span>
							<span class="label label-info scripts/">{{$user_count}}</span>
						</a>
					</li>
				
					<li>
							<a href="ui-widgets.html">
								<i class="fa fa-cogs"></i>
								<span class="title">تنظیمات</span>
							</a>
							<ul>
									<li>
										<a href="mailbox-main.html">
											<span class="title">حلقه ها</span>
										</a>
									</li>
									
									<li>
										<a href="/media">
											<span class="title">رسانه ها</span>
										</a>
									</li>
							</ul>
					</li>
					@endhasrole
						<a href="mailbox-main.html">
							<i class="linecons-mail"></i>
							<span class="title">پیام ها</span>
							<span class="label label-success scripts/">{{$message_count}} پیام جدید</span>
						</a>
						<ul>
							<li>
								<a href="mailbox-main.html">
									<span class="title">پیام های دریافتی</span>
									<span class="label label-info scripts/ pull-left">5 پیام جدید</span>
								</a>
							</li>
							<li>
								<a href="mailbox-compose.html">
									<span class="title">پیام های ارسال شده</span>
									
								</a>
							</li>
							<li>
								<a href="mailbox-message.html">
									<span class="title">پیام های سامانه برای شما</span>
									<span class="label label-warning scripts/ pull-left">5 پیام جدید</span>
								</a>
							</li>
						</ul>
					</li>
					
					
					

				</ul>
				
			</div>
		
		</div>