@extends('layout.login')

@section('content')
<div class="container-fluid">
		<div class="row">
			<div class="right-column sisu">
				<div class="row <!-- mx-0 -->">
					<!-- <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark">
						<a class="signin-logo d-sm-block d-md-none invisible" data-qp-animate-type="fadeInDown" data-qp-animate-delay="0" href="#">
							<img src="assets/img/logo-white.png" width="145" height="32.3" alt="QuillPro">
						</a>
						<h1 class="display-4 invisible" data-qp-animate-type="fadeInDown" data-qp-animate-delay="300">Login In To get Started</h1>
						<p class="lead mb-5 invisible" data-qp-animate-type="fadeInDown" data-qp-animate-delay="750">
							
						</p>
					</div> -->
					<div class="col-md-5 order-md-1 signin-left-column bg-white px-5" style="margin: 0 auto;">
						<a class="signin-logo d-sm-none d-md-block invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="300" href="#">
							<!--img src="assets/img/logo-dark.png" width="145" height="32.3" alt="QuillPro"--> 
						</a>
						<form class="invisible-children" data-qp-animate-type="fadeIn" data-qp-animate-delay="300" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
							<div class="form-group{{ $errors->has('membership_code') ? ' has-error' : '' }}">
								<label for="membership_code">Membership Number</label>
								<input type="text" class="form-control" id="membership_code" name="membership_code" placeholder="Membership Code" value="{{ old('membership_code') }}" required>
                                @if ($errors->has('membership_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('membership_code') }}</strong>
                                </span>
                                @endif
							</div>
							<div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
								<label for="phone_no">Phone No</label>
								<input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone Number" value="{{ old('phone_no') }}" >
								@if ($errors->has('phone_no'))
								<span class="help-block">
									<strong>{{ $errors->first('phone_no') }}</strong>
								</span>
								@endif
                            </div>
							<div{!! $errors->has('otp') ? '' : ' style="display: none"' !!}>
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password">Enter OTP</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<label for="mode">Select Mode</label>
                                <select class="form-control" id="mode" name="mode">
									<option value="member"{{ (old('mode') == "member") ? ' selected' : '' }}>MEMBER</option>
									<option value="lobbyhead"{{ (old('mode') == "lobbyhead") ? ' selected' : '' }}>LOBBY HEAD</option>
									<option value="corecommittee"{{ (old('mode') == "corecommittee") ? ' selected' : '' }}>CORE COMMITTEE</option>
									<option value="president"{{ (old('mode') == "president") ? ' selected' : '' }}>PRESIDENT</option>
								</select>
							</div>
							</div>
							<!--div class="form-check">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"> Keep Me Signed In</span>
								</label>
                            </div-->
							<button type="submit" class="btn btn-primary btn-block">
								<i class="batch-icon batch-icon-key"></i>
								{{$errors->has('otp') ? 'Log In' : 'Send OTP'}}
							</button>
							<hr>
							<!--p class="text-center">
								Account Approved? <a href="#">Register here</a>
                            </p-->
                            <!--a class="btn btn-link" href="{{ route('password.request') }}">
									Forgot Your Password?
									{{ route('register') }}
                                </a-->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
