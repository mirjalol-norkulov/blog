<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirish</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/login.css') }}">
</head>
<body>
<div class="container">
    <div class="row d-flex min-vh-100 justify-content-center align-items-center">
        <div class="col col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Kirish</h3>
                    @if($errors->has('error'))
                        <p class="text-danger">{{ $errors->first('error') }}</p>
                    @endif
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Parol</label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   required>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                            <label class="custom-control-label" for="remember">Eslab qol</label>
                        </div>
                        <div class="form-group mt-4 d-flex">
                            <button class="btn btn-primary flex-grow-1">
                                Kirish
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <a href="{{ route('register-view') }}">Ro'yxatdan o'tish</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
