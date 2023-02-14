<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/reset.css')}}">
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js"integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA="crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(function() {
                history.pushState(null, null, null);
                
                $(window).on("popstate", function(){
                    location.href = "/";
                });
            }); 
        </script>
    </head>
    <body>
        <div class="login-content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="login">
                        <h1 class="container login__ttl">すでに会員の方はログイン</h1>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" class="form">
                                @csrf

                                <div class="row mb-3 form__block">
                                    <label for="email" class="col-md-4 col-form-label text-md-end form__block--label">{{ __('メールアドレス') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form__block--mail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ __('メールアドレスが違います。') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 form__block">
                                    <label for="password" class="col-md-4 col-form-label text-md-end form__block--label">{{ __('パスワード') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form__block--pass" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ __('パスワードが違います。') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('> パスワードをお忘れの方はこちら') }}
                                    </a>
                                @endif

                                <div class="row mb-0 btng">
                                    <div class="col-md-8 offset-md-4 btng__cont">
                                        <button type="submit" class="btn btn-primary btng__cont--primary">
                                            {{ __('ログイン') }}
                                        </button>

                                        @if (Route::has('register'))
                                        <button type="btn" class="btng__cont--register">
                                            <a class="nav-link btng__cont--link" href="{{url('/notes')}}">{{ __('新規登録') }}</a>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
