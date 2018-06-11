<!DOCTYPE html>
<html>
<!-- Head -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>شبکه نویسندگان تحلیلگر</title>

    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Style -->
    <link rel="stylesheet" href="/assets/css/login.css" type="text/css" media="all">
    <!-- Fonts -->
    <!-- Body -->

    <body cz-shortcut-listen="true" style="">


        <h1>شبکه نویسندگان تحلیلگر</h1>
        <!---728x90-->

        <div style="margin: 0 auto;text-align: center;margin-top: 5px;">
            <div class="w3layoutscontaineragileits">
                <h2>ورود به سامانه</h2>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input id="email" placeholder="ایمیل خود را وارد نمایید." type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <input id="password" placeholder="رمز عبور..." type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    <ul class="agileinfotickwthree">
                            <li>
                                    <input type="checkbox" id="brand1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="brand1"><span></span>مرا به خاطر بسپار</label>
                                   
                                </li>
                    </ul>
                    <div class="aitssendbuttonw3ls">
                        <input type="submit" value="ورود به سامانه">
                        
                        <div class="clear"></div>
                    </div>
                </form>
            </div>

            <!---728x90-->

            
            <div class="w3footeragile">
                <p> © 1400 تمام حقوق این وب سایت متعلق به شبکه نویسندگان میباشد. | طراحی شده توسط
                    <a href="http://mahdiabedi.ir/" target="_blank">مهدی عابدی</a>
                </p>
            </div>