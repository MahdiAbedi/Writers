<?php 
use Carbon\Carbon;
?>
@extends('masterpage') @section('content')
<div class="page-title">
			
    <div class="title-env">
        <h1 class="title">صندوق پیام ها</h1>
        <p class="description">پیامهای دریافتی و ارسال شما</p>
    </div>

</div>


<section class="mailbox-env">

    <div class="row">

        <!-- Inbox emails -->
        <div class="col-sm-9 mailbox-left">

            <div class="mail-env">

                <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        var $state = $(".mail-table thead input[type='checkbox'], .mail-table tfoot input[type='checkbox']"),
                            $chcks = $(".mail-table tbody input[type='checkbox']");

                        // Script to select all checkboxes
                        $state.on('change', function(ev)
                        {
                            if($state.is(':checked'))
                            {
                                $chcks.prop('checked', true).trigger('change');
                            }
                            else
                            {
                                $chcks.prop('checked', false).trigger('change');
                            }
                        });

                        // Row Highlighting
                        $chcks.each(function(i, el)
                        {
                            var $tr = $(el).closest('tr');

                            $(this).on('change', function(ev)
                            {
                                $tr[$(this).is(':checked') ? 'addClass' : 'removeClass']('highlighted');
                            });
                        });

                        // Stars
                        $(".mail-table .star").on('click', function(ev)
                        {
                            ev.preventDefault();

                            if( ! $(this).hasClass('starred'))
                            {
                                $(this).addClass('starred').find('i').attr('class', 'fa-star');
                            }
                            else
                            {
                                $(this).removeClass('starred').find('i').attr('class', 'fa-star-o');
                            }
                        });
                    });
                </script>

                <!-- mail table -->
                <table class="table mail-table">

                    <!-- mail table header -->
                    <thead>
                        <tr>
                            <th class="col-cb">
                                <input type="checkbox" class="cbr" />
                            </th>
                            <th colspan="4" class="col-header-options">
                                <div class="mail-pagination">
                                    شما دارای <strong>{{count($messages)}}</strong> پیام میباشید
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <!-- mail table footer -->
                    <tfoot>
                        <tr>
                            <th class="col-cb">
                                <input type="checkbox" class="cbr" />
                            </th>
                            <th colspan="4" class="col-header-options">
                                <div class="mail-pagination">
                                        {{$messages->links()}}
                                </div>
                            </th>
                        </tr>
                    </tfoot>

                    <!-- email list -->
                    <tbody>
                        @foreach($messages as $message)
                        <tr {{($message->status=='جدید')?'class="unread"':''}}><!-- new email class: unread -->
                            <td class="col-cb">
                                <div class="checkbox checkbox-replace">
                                    <input type="checkbox" class="cbr" />
                                </div>
                            </td>
                            <td class="col-name">
                                <a href="#" class="star starred">
                                    <i class="fa-star"></i>
                                </a>
                                <a href="message/{{$message->id}}" class="col-name">{{$message->getUserName->name}}</a>
                            </td>
                            <td class="col-subject">
                                <a href="message/{{$message->id}}">
                                   {{$message->title}}
                                </a>
                            </td>
                            {{--  <td class="col-options hidden-sm hidden-xs">
                                <a href="#"><i class="linecons-attach"></i></a>
                            </td>  --}}
                            <td class="col-time">{{$message->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

        <!-- Mailbox Sidebar -->
        <div class="col-sm-3 mailbox-right">

            <div class="mailbox-sidebar">

                <a href="/message/create" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                    <i class="linecons-mail"></i>
                    <span>ارسال پیام جدید</span>
                </a>


                <ul class="list-unstyled mailbox-list">
                    <li class="active">
                        <a href="#">
                            صندوق پیام ها
                            <span class="badge badge-success pull-right">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            پیام های ارسال شده
                        </a>
                    </li>
                    {{--  <li>
                        <a href="#">
                            پیش نویس ها
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Spam
                            <span class="badge badge-purple pull-right">2</span>
                        </a>
                    </li>  --}}
                    <li>
                        <a href="#">
                            زباله
                        </a>
                    </li>
                </ul>

                {{--  <div class="vspacer"></div>

                <ul class="list-unstyled mailbox-list">
                    <li class="list-header">فیلتر ها</li>
                    <li>
                        <a href="#">
                            ThemeForest
                            <span class="badge badge-success badge-roundless pull-right upper">Envato</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Society
                            <span class="badge badge-red badge-roundless pull-right upper">Friends</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Work
                            <span class="badge badge-warning badge-roundless pull-right upper">Google</span>
                        </a>
                    </li>
                </ul>  --}}

            </div>

        </div>

    </div>

</section>

@stop