@extends('website.layout')

@section('contents')
    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Login</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 offset-md-3 py-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-6">
                                @if ($message = Session::get('error'))
                                    <span style="color:red">{{$message}}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if ($message = Session::get('success'))
                                    <span style="color:green">{{$message}}</span>
                                @endif
                            </div>
                            <input type="text" id="mobile" class="form-control form-blms" @error('mobile') is-invalid @enderror name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus placeholder="Enter Your Mobile" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert" style="display:block">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                            <small id="tet" class="form-text text-center">You will get an OTP on this number</small>



                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-blms btn-block">Submit</button>
{{--                            <p id="tet" class="form-text text-center">Don't Have an Account</p>--}}
{{--                            <p id="tet" class="form-text text-center"><a href="">Create Account</a></p>--}}
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>


{{--    <div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('admin.login') }}">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                @if ($message = Session::get('error'))--}}
{{--                                    <span style="color:red">{{$message}}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                @if ($message = Session::get('success'))--}}
{{--                                    <span style="color:green">{{$message}}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('admin.password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
