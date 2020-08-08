@extends('dashboard.layouts.base')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row p-4">
            <div class="col">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title">
                            Tahrirlash
                        </h4>
                        @if(session()->has('user.edited'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('user.edited') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('dashboard.users.edit', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Ism</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}"
                                    value="{{ old('name') ? old('name') : $user->name }}"
                                    required>

                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}"
                                    value="{{ old('email') ? old('email') : $user->email }}"
                                    required>

                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="roles">Rol</label>
                                <select
                                    id="roles"
                                    name="roles[]"
                                    class="form-control {{ $errors->has('roles') ? 'is-invalid': '' }}"
                                    multiple>
                                    @foreach($roles as $index => $role)
                                        @if(isset(old('roles')[$index]))
                                            {{ $selected = true }}
                                        @elseif($user->roles->pluck('name')->contains($role->name) && !old('roles'))
                                            {{ $selected = true }}
                                        @else
                                            {{ $selected = false }}
                                        @endif
                                        <option value="{{ $role->id }}" {{ $selected ? 'selected': '' }}>
                                            {{ $role->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('roles'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('roles') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    Parol
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid': '' }}">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password_confirm">
                                    Parolni takrorlang
                                </label>
                                <input type="password"
                                       id="password_confirm"
                                       name="password_confirm"
                                       class="form-control {{ $errors->has('password_confirm') ? 'is-invalid': '' }}">
                                @if($errors->has('password_confirm'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirm') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Saqlash
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
