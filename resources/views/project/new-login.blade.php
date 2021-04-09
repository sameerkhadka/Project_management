@extends('layouts.app')
@section('content')
<section class="login-wrap">
        <div class="login-html">
            <img src="{{ asset('asset/images/logo.png') }}" alt="">

            <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-form">
                
                <label for="">Email</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                 <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                 </span>
                 @enderror
           
            </div>

            <div class="login-form">
            <label for="password" class="col-form-label ">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

             @error('password')
               <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit">Login</button>

            </form>

        </div>
    </section>
@endsection
 <!-- @if(auth()->user()->isAdmin()) -->
<!-- @endif -->