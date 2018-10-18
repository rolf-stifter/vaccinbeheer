@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="login-form row align-items-center h-100">
                

                    <form method="POST" action="{{ route('login') }}" class="mx-auto bg-white">
                        @csrf
                        <h2 class="text-center">Vaccinbeheer</h2>
                        <div class="form-group">

                                <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <input id="password" placeholder="Wachtwoord" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-block form-control">
                                    Inloggen
                                </button>
                        </div>
                        <div class="col-md-8 offset-md-2">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Wachtwoord vergeten?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
@endsection

                    <!--
                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Onthoud mij
                                    </label>
                            </div>
                        </div>
                    -->