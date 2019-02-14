<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | Login</title>
    <link href="{{ asset('assets/theme-admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/theme-admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/theme-admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/theme-admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/theme-admin/css/main.css') }}" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box loginscreen animated fadeInDown" style="padding-top: 15%;">
        <div class="row">
            <img src="{{ asset('assets/theme-admin/images/logo_120x120.png') }}" class="img-responsive center-block"><br />
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">

                    <button type="submit" class="btn btn-success btn-lg- btn-block">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Logar agora?') }}
                    </a>
                </div>
            </div>
        </form></div></div>
        <!-- Mainly scripts -->
        <script src="{{ asset('assets/theme-admin/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('assets/theme-admin/js/bootstrap.min.js') }}"></script>
    </body>
    </html>
