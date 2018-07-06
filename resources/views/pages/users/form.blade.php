@extends('masterpage')
@section('content')

<div class="row">
        <div class="col-sm-12">
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{isset($user->id)? 'ویرایش کاربر':'ایجاد کاربر جدید '}}</h3>
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
                        @if(isset($user->id))
                        {!! Form::Model($user,array('class'=>'form-horizontal','route'=>['users.update',$user->id],'method'=>'PATCH','files'=>true))!!}
                           
                        @else
                            {!! Form::open(['class'=>'form-horizontal','route'=>'users.store','files'=>true]) !!}
                        @endif

                                <div class="panel panel-headerless">
                                    <div class="panel-body">
                                        @if(isset($user->id))
                                        <div class="member-form-add-header">
                                            <div class="row">
                                               
                                                <div class="col-md-10 col-sm-8">
                            
                                                    <div class="user-img">
                                                        @if(file_exists('uploads/users-pic/'.$user->code_melli.'.jpg'))
                                                            <img src="{{'/uploads/users-pic/'.$user->code_melli.'.jpg'}}" class="img-circle" alt="{{auth()->user()->name}}" width="60" height="60">
                                                            @else
                                                            <img src="/assets/images/user-4.png" class="img-circle img-corona" alt="user-pic"  width="60" height="60" />
                                                            @endif
                                                      
                                                    </div>
                                                    <div class="user-name">
                                                        <a href="#">{{$user->name}}</a>
                                                        <span>{{$user->userSemat($user)}}</span>
                                                    </div>
                            
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                            
                                        <div class="member-form-inputs">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">نام و نام خانوادگی*</label>
                                                </div>
                                                <div class="col-sm-9">
                                                {!! Form::text('name', null, ['class'=>'form-control','required']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">کد ملی*</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('code_melli', null, ['class'=>'form-control','required']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">نام پدر</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('father_name', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">نام دانشگاه</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('university_name', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">مقطع تحصیلی</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    
                                                    {!! Form::select('maghta', [
                                                        'دیپلم'=>'دیپلم',
                                                        'فوق دیپلم'=>'فوق دیپلم',
                                                        'کارشناسی'=>'کارشناسی',
                                                        'کارشناسی ارشد'=>'کارشناسی ارشد',
                                                        'دکتری'=>'دکتری',
                                                    ], null, ['class'=>'form-control']) !!}
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">شماره دانشجویی</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('student_code', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">وضیعت تاهل</label>
                                                </div>
                                                <div class="col-sm-9">
                                                   
                                                  
                                                  {!! Form::select('marid', array('0'=>'مجرد','1'=>'متاهل'), null, ['class'=>'form-control']) !!}
                                                  
                                                   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">محل سکونت</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('address', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">کدپستی</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('postal_code', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                            {{-- اطلاعات حساب --}}
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">نام بانک</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('bank_name', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">شماره حساب</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('bank_account', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">شماره عابر بانک</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('bank_cart', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>



                                            {{-- پایان اطلاعات حساب --}}
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">تلفن همراه*</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('cellphone', null, ['class'=>'form-control','required']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">تلفن ثابت</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! Form::text('tel', null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">ایمیل*</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        
                                                        {!! Form::email('email', null, ['class'=>'form-control','required']) !!}
                                                        
                                                </div>
                                            </div>
                                            @if(isset($user->id))
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">ویرایش پسورد</label>
                                                </div>
                                                <div class="col-sm-9">
                                                       {!! Form::password('password', ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label" for="name">پسورد*</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                           {!! Form::password('password', ['class'=>'form-control','required']) !!}
                                                    </div>
                                                </div>
                                            @endif
                                        @hasrole('modir')
                                            <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label" for="name">جنسیت*</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!! Form::select('sex', array('0'=>'خانم','1'=>'آقا'), '1', ['class'=>'form-control']) !!}
                                                    </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">وضعیت کاربر</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {!! Form::select('active', array('0'=>'غیر فعال','1'=>'فعال'), '1', ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">انتخاب دوره</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {!! Form::select('dore_id', App\Dore::all()->pluck('name','id'),null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label" for="name">ارزیاب شکلی</label>
                                                </div>
                                                <div class="col-sm-9">
                                                  
                                                  {!! Form::select('arzyab_id', $arzyabs, null, ['class'=>'form-control']) !!}
                                                  
                                                </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label" for="name">انتخاب حلقه</label>
                                                    </div>
                                                  
                                                    <div class="col-sm-9" id="s2id_s2example-2">
                                                        @if(isset($user->id))
                                                             {!! Form::select('halghes[]', App\Halghe::with('user')->get()->pluck('name','id'),$halghes, ['class'=>'form-control select2-offscreen','id'=>'s2example-2','tabindex'=>'-1','multiple'=>'']) !!}

                                                        @else
                                                            {!! Form::select('halghes[]', App\Halghe::with('user')->get()->pluck('name','id'), null, ['class'=>'form-control select2-offscreen','id'=>'s2example-2','tabindex'=>'-1','multiple'=>'']) !!}
                                                        @endif
                                                           
                                                    </div>
                                            </div>
                                            @endhasrole
                                            

                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($)
                                                    {
                                                        $("#s2example-2").select2({
                                                            placeholder: 'حلفه های مورد نظر خود را انتخاب کنید',
                                                            allowClear: true
                                                        }).on('select2-open', function()
                                                        {
                                                            // Adding Custom Scrollbar
                                                            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                                        });
                                                        
                                                    });
                                                </script>
                                            


                                            <div class="row">
                                                    <div class="col-sm-3">
                                                            <label class="control-label" for="name">تاریخ تولد</label>
                                                        </div>
                                                        
                                                <div class="col-sm-9">
                                                   
                                                   {!! Form::text('birthdate', null, ['class'=>'form-control input-small','id'=>'datepicker6']) !!}
     
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-sm-3">
                                                            <label class="control-label" for="name">تصویر کاربر</label>
                                                        </div>
                                                <div class="col-sm-9">
                                             {!! Form::file('photo', ['class'=>'form-control']) !!}       
     
                                                </div>
                                            </div>
                            
                                           
                                            @hasrole('modir')
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">سطح دسترسی*</label>
                                                </div>
                                                <div class="col-sm-9">
                            
                                                    <script type="text/javascript">
                                                        jQuery(document).ready(function($)
                                                        {
                                                            $("#multi-select").multiSelect({
                                                                afterInit: function()
                                                                {
                                                                    // Add alternative scrollbar to list
                                                                    this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                                                },
                                                                afterSelect: function()
                                                                {
                                                                    // Update scrollbar size
                                                                    this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                    
                                                    @if(isset($user->id))
                                                        {!! Form::select('roles[]', $roles, old('roles') ? old('roles') : $user->roles()->pluck('name', 'display_name'), ['class'=>'form-control','required','multiple'=>'multiple','id'=>'multi-select','style'=>'position: absolute;right: -9999px']) !!}
                                                    @else
                                                         {!! Form::select('roles[]', $roles,old('roles'), ['class'=>'form-control','multiple'=>'multiple','id'=>'multi-select','style'=>'position: absolute;right: -9999px']) !!}
                                                    @endif
                            
                                                </div>
                                            </div>
                                            @endhasrole
                                            <div class="row">
                                                <div class="col-sm-3">
                                                        <label class="control-label" for="name"></label>
                                                    </div>
                                                    
                                            <div class="col-sm-3">
                                               
                                            
                                            {!! Form::submit('ثبت', ['class'=>'form-control btn btn-success']) !!}
                                            
 
                                            </div>
                                        </div>
                        
                                        </div>
                            
                                    </div>
                                </div>
                            </form>
                            <!-- Imported styles on this page -->
                            <link rel="stylesheet" href="/assets/js/select2/select2.css">
                            <link rel="stylesheet" href="/assets/js/select2/select2-bootstrap.css">
                            <link rel="stylesheet" href="/assets/js/multiselect/css/multi-select.css">

                            <!-- Imported scripts on this page -->
                            <script src="/assets/js/datepicker/bootstrap-datepicker.js"></script>
                            <script src="/assets/js/datepicker/bootstrap-datepicker.fa.js"></script>
                            <script src="/assets/js/select2/select2.min.js"></script>
                            <script src="/assets/js/multiselect/js/jquery.multi-select.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#datepicker0").datepicker();
                                
                                    $("#datepicker1").datepicker();
                                    $("#datepicker1btn").click(function(event) {
                                        event.preventDefault();
                                        $("#datepicker1").focus();
                                    })
                                
                                    $("#datepicker2").datepicker({
                                        showOtherMonths: true,
                                        selectOtherMonths: true
                                    });
                                
                                    $("#datepicker3").datepicker({
                                        numberOfMonths: 3,
                                        showButtonPanel: true
                                    });
                                
                                    $("#datepicker4").datepicker({
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                
                                    $("#datepicker5").datepicker({
                                        minDate: 0,
                                        maxDate: "+14D"
                                    });
                                
                                    $("#datepicker6").datepicker({
                                        isRTL: true,
                                        dateFormat: "yy/mm/dd",
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                });
                            </script>
@stop




