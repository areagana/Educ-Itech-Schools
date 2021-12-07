@Extends('layouts.apps')
            @section('content')
            <div class="row p-3 mt-4">
                <a href="{{route('home')}}" class="nav-link"><i class="fa fa-arrow-left"></i> Cancel</a>
                <div class="col-md-4"></div>
                <div class="col-md-4 p-3 mt-4 bg-white login-div shadow-sm">
                    <h4 class='justify-content-center p-3 text-primary header'>
                        <img src="{{asset('EDUC-ITECH logo edited.png')}}" width="50px" height="50px" class='login-img justify-content-center' >
                        Educ-Itech Schools
                    </h4>
                    <div class="header h4 bg-light">CHANGE PASSWORD</div>
                <!-- indicate errors here-->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                        @endif

                <!--end section that shows error and success-->
                    <form method="POST" action="{{ route('changePassword') }}" >
                        @csrf

                        @if(Auth::user()->password_status =='password-changed')
                        <div class="form-group">
                            <label for="current-password" class="col-form-label text-md-right">{{ __('Current password') }}</label>
                                <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required>
                                @error('current-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        @endif

                        <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">{{ __('New password') }}</label>
                                <input id="password" type="password" class="form-control form-control  @error('password') is-invalid @enderror" name="password" required autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm-password" class="col-form-label text-md-right">{{ __('Confirm password') }}</label>
                                <input id="confirm-password" type="password" class="form-control @error('confirm-password') is-invalid @enderror" name="confirm-password" required>
                                @error('confirm-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group row p-3">
                            <div class="form-check col">
                                <input class='form-check-input' type="checkbox" id="showpassword">
                                <label for="showpassword" class="form-check-label" onclick="ShowPasswords()"> Show Passwords</label>
                            </div>
                        </div>
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Change Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endsection