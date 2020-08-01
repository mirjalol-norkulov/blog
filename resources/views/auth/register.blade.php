@extends('layouts.empty')

@section('title')
    Ro'yxatdan o'tish
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <div class="container">
        {{ old('agree') }}
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col col-12 col-md-6 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3 class="card-title text-uppercase text-center font-weight-bolder">Ro'yxatdan o'tish</h3>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                    name="name"
                                    placeholder="Ismingiz"
                                    value="{{ old('name') }}"
                                >
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input
                                    type="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    id="email" name="email"
                                    placeholder="Email manzilingiz"
                                    value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    id="password" name="password"
                                    placeholder="Parol">

                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Parol qaytadan">

                                @if($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>

                            <div class="custom-control custom-checkbox license-agree">
                                <input
                                    type="checkbox"
                                    class="custom-control-input {{ $errors->has('agree') ? 'is-invalid' : '' }}"
                                    id="agree"
                                    name="agree"
                                    {{ old("agree") ? "checked" : "" }}>
                                <label class="custom-control-label" for="agree">
                                    Men foydalanish shartlaridagi barcha
                                    bayonotlarni qabul qilaman
                                </label>
                                @if($errors->has('agree'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('agree') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary text-uppercase w-100 submit-btn">
                                    Ro'yxatdan o'tish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
