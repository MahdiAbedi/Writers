
@extends('masterpage') @section('content')
	
    <div class="panel panel-default">
        <div class="panel-heading hidden-print"> صورت حساب مربوط به {{$user->name}}</div>
        <div class="panel-body">
            
            <section class="invoice-env">
            
                <!-- Invoice header -->
                <div class="invoice-header">
                    
                    <!-- Invoice Options Buttons -->
                    <div class="invoice-options hidden-print">
                        <a href="#" class="btn btn-block btn-gray btn-icon btn-icon-standalone btn-icon-standalone-right text-left">
                            <i class="fa-envelope-o"></i>
                            <span>ارسال</span>
                        </a>
                        
                        <a href="#" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right btn-single text-left">
                            <i class="fa-print"></i>
                            <span>پرینت</span>
                        </a>
                    </div>
                    
                    <!-- Invoice Data Header -->
                    <div class="invoice-logo">
                    
                        <a href="#" class="logo">
                            <img src="/assets/images/invoice-logo.png" class="img-responsive" />
                        </a>
                        
                        <ul class="list-unstyled">
                            <li class="upper">کد صورت حساب: <strong>#5652256</strong></li>
                            <li>{{Date(now())}}</li>
                            <li>شبکه نویسندگان تحلیلگر</li>
                        </ul>
                        
                    </div>
                    
                </div>
                
                
                <!-- Client and Payment Details -->
                <div class="invoice-details">
                    
                    <div class="invoice-payment-info">
                        <strong>جزییات پرداخت</strong>
                        
                        <ul class="list-unstyled">
                            <li>نام بانک: <strong>{{$user->bank_name}}</strong></li>
                            <li>شماره حساب: <strong>{{$user->bank_account}}</strong> </li>
                            <li>شماره کارت: <strong>{{$user->bank_cart}}</strong></li>
                        </ul>
                    </div>
                    
                    <div class="invoice-client-info">
                        <strong>مشخصات دریافت کننده</strong>

                        <ul class="list-unstyled">		
                            <li>{{$user->name}} </li>
                            <li>{{$user->cellphone}}</li>
                            <li>{{$user->address}}</li>
                        </ul>

                        <ul class="list-unstyled">
                            <li>نام و نام خانوادگی </li>
                            <li>شماره تماس </li>
                            <li>نشانی</li>
                        </ul>
                    </div>
  
                </div>
                
                
                <!-- Invoice Entries -->
                <table class="table table-bordered">
                    <thead>
                        <tr class="no-borders">
                            <th class="text-center hidden-xs">#</th>
                            <th width="60%" class="text-center">نوع خدمت</th>
                            <th class="text-center hidden-xs">امتیاز</th>
                            <th class="text-center">هزینه</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $sum=0;?>
                        @foreach($invoices as $key=>$invoice)
                        <?php $sum+=$invoice->point; ?>
                        <tr>
                            <td class="text-center hidden-xs">{{$key+1}}</td>
                            <td>{{$invoice->description}}</td>
                            <td class="text-center hidden-xs">{{$invoice->point}}</td>
                            <td class="text-right text-primary text-bold">{{$invoice->point*1000}} تومان</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Invoice Subtotals and Totals -->
                <div class="invoice-totals">
                    
                    <div class="invoice-subtotals-totals">
                        <span>
                           مجموع امتیازات: 
                            <strong>{{$sum}}</strong>
                        </span>
                        
                        <span>
                           مبلغ : 
                            <strong>{{$sum*1000}} تومان</strong>
                        </span>
                        
                        <span>
                            تخفیف: 
                            <strong>-----</strong>
                        </span>
                        
                        <hr />
                        
                        <span>
                            مبلغ قابل پرداخت: 
                            <strong>{{$sum*1000}} تومان</strong>
                        </span>
                    </div>
                    
                    <div class="invoice-bill-info">
                        <address>
                            شبکه نویسندگان تحلیلگر<br />
                            تهران،پل گیشا،جنب دانشکده اقتصاد<br /> 
                            تلفن تماس: (021) 66177 <br />
                            
                            <a href="#">info@writers.com</a>
                        </address>
                    </div>
                    
                </div>
                
            </section>
            
        </div>
    </div>

    @stop