@extends('masterpage') @section('content')
<?php
use Carbon\Carbon
?>
    
    <section class="mailbox-env">
    
        <div class="row">
    
            <!-- Email Single -->
            <div class="col-sm-12 mailbox-right">
    
                <div class="mail-single">
    
                    <!-- Email Title and Button Options -->
                    <div class="mail-single-header">
                        <h2>
                            {{$message->title}}
    
                            <a href="/message" class="go-back">
                                <i class="fa-angle-left"></i>
                                بازگشت
                            </a>
                        </h2>
    
                        <div class="mail-single-header-options">
                            <a href="message/create" class="btn btn-gray btn-icon">
                                <span>پاسخ</span>
                                <i class="fa-reply-all"></i>
                            </a>
    
                            <a href="mailbox-main.html" class="btn btn-gray btn-icon">
                                <i class="fa-trash"></i>
                            </a>
                        </div>
                    </div>
    
                    <!-- Email Info From/Reply -->
                    <div class="mail-single-info">
    
                        <div class="mail-single-info-user dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    @if(file_exists('uploads/users-pic/'.$message->getUsername->code_melli.'.jpg'))
                                    <img src="{{'/uploads/users-pic/'.$message->getUsername->code_melli.'.jpg'}}" class="img-circle pull-left" alt="{{auth()->user()->name}}" width="60" height="60">
                                    @else
                                    <img src="/assets/images/user-4.png" class="img-circle img-corona pull-left" alt="user-pic"  width="60" height="60" />
                                    @endif
                                <span>{{$message->getUsername->name}}</span>
                                ({{$message->getUsername->email}})
                                <em class="time">{{$message->created_at->diffForHumans()}}</em>
                            </a>
    
                         
                        </div>
    
                        <div class="mail-single-info-options">
                            <a href="#" class="star starred">
                                <i class="fa-star-o"></i>
                            </a>
                            <a href="#">
                                <i class="linecons-attach"></i>
                            </a>
                        </div>
    
                    </div>
    
                    <!-- Email Body -->
                    <div class="mail-single-body">
                        {{$message->body}}
                    </div>
    
                    <!-- Email Attachments -->
                    {{--  <div class="mail-single-attachments">
                        <h3>
                            <i class="linecons-attach"></i>
                            ضمیمه ها
                        </h3>
    
                        <ul class="list-unstyled list-inline">
                            <li>
                                <a href="#" class="thumb">
                                    <img src="assets/images/attach-1.png" class="img-thumbnail" />
                                </a>
    
                                <a href="#" class="name">
                                    IMG_007.jpg
                                    <span>14KB</span>
                                </a>
    
                                <div class="links">
                                    <a href="#">View</a> -
                                    <a href="#">Download</a>
                                </div>
                            </li>
    
                            <li>
                                <a href="#" class="thumb download">
                                    <img src="assets/images/attach-2.png" class="img-thumbnail" />
                                </a>
    
                                <a href="#" class="name">
                                    IMG_008.jpg
                                    <span>12KB</span>
                                </a>
    
                                <div class="links">
                                    <a href="#">View</a> -
                                    <a href="#">Download</a>
                                </div>
                            </li>
                        </ul>
                    </div>  --}}
    
                </div>
    
    
            </div>

        </div>
    
    </section>

    @stop