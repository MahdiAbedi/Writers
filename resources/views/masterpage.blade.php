@include('layouts.head')
<body class="page-body right-sidebar">

	{{--  @include('layouts.setting-panel')  --}}
	
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
			
		@include('layouts.sidebar')
	
		<div class="main-content">
					
			@include('layouts.topmenu')
			@include('layouts.message') 
			@yield('content')
			
			@include('layouts.footer')
		</div>
	
			
		@include('layouts.chat-sidebar')
	
	</div>
	
	@include('layouts.chat-bottom')
	
	
@include('layouts.bottom-scripts')


</body>
</html>