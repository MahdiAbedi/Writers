@extends('masterpage') @section('content')

    <section class="mailbox-env">
        
        <div class="row">
            
            <!-- Compose Email Form -->
            <div class="col-sm-12 mailbox-right">
                
                <div class="mail-compose">
                    
                        {!! Form::open(['route'=>'message.store']) !!}

                        <!-- Header Title and Button Options -->
                        <div class="mail-header">
                            <div class="row">
                                <div class="col-sm-6">							
                                    <h3>
                                        <i class="linecons-pencil"></i>
                                        ارسال پیام
                                    </h3>
                                </div>
                            </div>
                        </div>
                      
                        <div class="form-group">
                           
                             {!! Form::select('recievers[]',$recievers,null, ['class'=>'form-control select2-offscreen','id'=>'s2example-2','tabindex'=>'-1','multiple'=>'']) !!}
                            
                            </div>
                        <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                                $("#s2example-2").select2({
                                    placeholder: 'گیرندگان پیام را مشخص کنید',
                                    allowClear: true
                                }).on('select2-open', function()
                                {
                                    // Adding Custom Scrollbar
                                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                });
                                
                            });
                        </script>
        
                        <div class="form-group">
                            
                            {!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'موضوع']) !!}
                            
                        </div>
                        
                        
                        <div class="compose-message-editor">
                                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}

                        </div>
                    
                        <div class="row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-secondary btn-block btn-icon btn-icon-standalone">
                                    <i class="linecons-mail"></i>
                                    <span>ارسال</span>
                                </button>
                            </div>
                            
                            {{--  <div class="col-sm-offset-6 col-sm-3">
                                <button type="submit" class="btn btn-white btn-single btn-block btn-icon btn-icon-standalone">
                                    <i class="fa-plus"></i>
                                    <span>ضمیمه کردن فایل</span>
                                </button>
                            </div>  --}}
                        </div>
                        
                    </form>
                    
                </div>
                
                
            </div>
        
        </div>
        
    </section>

    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="/assets/js/select2/select2.css">
    <link rel="stylesheet" href="/assets/js/select2/select2-bootstrap.css">
    <script src="/assets/js/select2/select2.min.js"></script>
   
    
    @stop