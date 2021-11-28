        @Extends('layouts.apps')
            @section('content')
            <div class="row p-3 mt-4">
                <a href="{{route('frontPage')}}" class="nav-link"><i class="fa fa-arrow-left"></i> Back</a>
                <div class="col-md-4"></div>
                <div class="col-md-4 p-3 mt-4 bg-white login-div shadow-sm">
                    <h4 class='justify-content-center p-3 text-primary header'>
                        <img src="{{asset('EDUC-ITECH logo edited.png')}}" width="50px" height="50px" class='login-img justify-content-center' >
                        Educ-Itech Schools
                    </h4>
                    <div class="header h4 bg-light">LOGIN</div>
                    <form method="POST" action="{{ route('login') }}" >
                        @csrf
                        <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group row p-3">
                            <div class="form-check col">
                                <input class='form-check-input' type="checkbox" id="showpassword">
                                <label for="showpassword" class="form-check-label" onclick="ShowPassword()"> Show Password</label>
                            </div>
                            <div class="form-check col">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>
                        </div>
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            @endsection