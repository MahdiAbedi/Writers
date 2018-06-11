@if($errors->any())
 <div class="panel panel-info">
        <div class="panel-body">
       
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            
            </div>
        
        </div>
 </div>  
 @endif  

 @if(session()->has('message'))      
 <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>پیام:</strong>  {{ session()->get('message') }}
      </div> 
 @endif  