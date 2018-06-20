@extends('masterpage') @section('content')

    <section class="mailbox-env">
        
        <div class="row">
            
            <!-- Compose Email Form -->
            <div class="col-sm-12 mailbox-right">
                
                <div class="mail-compose">
                    
                    <form method="post" role="form">
                    
                        <!-- Header Title and Button Options -->
                        <div class="mail-header">
                            <div class="row">
                                <div class="col-sm-6">							
                                    <h3>
                                        <i class="linecons-pencil"></i>
                                        ارسال پیام
                                    </h3>
                                </div>
                                
                                <div class="col-sm-3 col-xs-5">
                                    <button type="button" class="btn btn-gray btn-single btn-icon btn-icon-standalone btn-icon-standalone-right btn-block">
                                        <i class="linecons-fire"></i>
                                        <span>حذف</span>
                                    </button>
                                </div>
                                
                                <div class="col-sm-3 col-xs-8">					
                                    <button type="submit" class="btn btn-secondary btn-single btn-icon btn-icon-standalone btn-icon-standalone-right btn-block">
                                        <i class="linecons-mail"></i>
                                        <span>ارسال</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="to">ارسال پیام به:</label>
                            <input type="text" class="form-control" id="to" tabindex="1" />
                            
                            <div class="field-options">
                                <a href="javascript:;" onclick="jQuery(this).hide(); jQuery('#cc').parent().removeClass('hidden'); jQuery('#cc').focus();">CC</a>
                                <a href="javascript:;" onclick="jQuery(this).hide(); jQuery('#bcc').parent().removeClass('hidden'); jQuery('#bcc').focus();">BCC</a>
                            </div>
                        </div>
                        
                        <div class="form-group hidden">
                            <label for="cc">CC:</label>
                            <input type="text" class="form-control" id="cc" tabindex="2" />
                        </div>
                        
                        <div class="form-group hidden">
                            <label for="bcc">BCC:</label>
                            <input type="text" class="form-control" id="bcc" tabindex="2" />
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">موضوع:</label>
                            <input type="text" class="form-control" id="subject" tabindex="1" />
                        </div>
                        
                        
                        <div class="compose-message-editor">
                            <textarea class="form-control wysihtml5" data-html="false" data-color="false" data-stylesheet-url="assets/css/other/wysihtml5-color.css" name="sample_wysiwyg" id="sample_wysiwyg"></textarea>
                        </div>
                    
                        <div class="row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-secondary btn-block btn-icon btn-icon-standalone">
                                    <i class="linecons-mail"></i>
                                    <span>ارسال</span>
                                </button>
                            </div>
                            
                            <div class="col-sm-offset-6 col-sm-3">
                                <button type="submit" class="btn btn-white btn-single btn-block btn-icon btn-icon-standalone">
                                    <i class="fa-plus"></i>
                                    <span>ضمیمه کردن فایل</span>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
                
                
            </div>
        
        </div>
        
    </section>


                <!-- Imported scripts on this page -->
    <script src="/assets/js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
    
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="/assets/js/wysihtml5/src/bootstrap-wysihtml5.css">

                @stop