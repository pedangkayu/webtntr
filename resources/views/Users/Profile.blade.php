@extends('layouts.app')

@section('meta')
	<style type="text/css">
		.view-avatar div{
			position: relative;
		}
		.edit-icon-avatar{
			position: absolute;
			color: #fff;
			top: 15px;
			right: 15px;
			opacity: .7;
			display: none;
			font-size: 24pt;
		}
		.view-avatar div:hover .edit-icon-avatar{
			display: block;
		}
	</style>
@endsection

@section('content')

	    <div class="row">
	        <div class="col-md-8">

	            <div class="card">
	            	<div class="card-head style-default-light">
						<header><i class="glyphicon glyphicon-user"></i> Data Diri</header>
					</div>
	                <div class="card-body">
											<form method="POST" action="">
	                        {{ csrf_field() }}

	                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                            <label for="name">Full Name</label>
	                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $user->name }}" required>

	                            @if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
	                        </div>

													<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	                            <label for="phone">Phone</label>
	                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}" required>

	                            @if ($errors->has('phone'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('phone') }}</strong>
	                                </span>
	                            @endif
	                        </div>

													<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
	                            <label for="address">Address</label>
	                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') ? old('address') : $user->address }}" required>

	                            @if ($errors->has('address'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('address') }}</strong>
	                                </span>
	                            @endif
	                        </div>

													<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
	                            <label for="city">City</label>
	                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city') ? old('city') : $user->city }}" required>

	                            @if ($errors->has('city'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('city') }}</strong>
	                                </span>
	                            @endif
	                        </div>

													<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
	                            <label for="country">Country</label>
	                            <input id="country" type="text" class="form-control" name="country" value="{{ old('country') ? old('country') : $user->country }}" required>

	                            @if ($errors->has('country'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('country') }}</strong>
	                                </span>
	                            @endif
	                        </div>

													<div class="card-actionbar">
					                    <div class="card-actionbar-row">
					                        <button type="submit" class="btn btn-flat btn-accent ink-reaction">Perbaharui</button>
					                    </div>
					                </div><!--end .card-actionbar -->
											</form>
	                </div>

	            </div>


	            <div class="card">
	            	<div class="card-head style-default-light">
						<header><i class="fa fa-lock"></i> Akses User</header>
					</div>
	                <div class="card-body">

	                	<form method="POST" action="{{ url('/users/updateuseraccess') }}">
	                		{{ csrf_field() }}

												<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

														<div class="input-group">
															<div class="input-group-content">
																<label for="email">Alamat Email</label>
																<input id="email" type="email" class="form-control" readonly="readonly" title="Tidak dapat diperbaharui" value="{{ $user->email }}" required>
															</div>
															<span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
														</div>

														@if ($errors->has('email'))
																<span class="help-block">
																		<strong>{{ $errors->first('email') }}</strong>
																</span>
														@endif
												</div>

	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

	                            <label for="password">Password</label>
	                            <input id="password" type="password" class="form-control" name="password" required="required">

	                            @if ($errors->has('password'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('password') }}</strong>
	                                </span>
	                            @endif
	                        </div>

	                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

	                            <label for="password-confirm">Konfirmasi Password</label>
	                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="required">

	                            @if ($errors->has('password_confirmation'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
	                                </span>
	                            @endif
	                        </div>


		                </div>

		                <div class="card-actionbar">
		                    <div class="card-actionbar-row">
		                        <button type="submit" class="btn btn-flat btn-accent ink-reaction">Perbaharui</button>
		                    </div>
		                </div><!--end .card-actionbar -->

	                </form>

	            </div>
	        </div>


	        <div class="col-md-4">

	        	<div class="card">
					<div class="card-body view-avatar">
						<div>
						<i class="fa fa-camera fa-lg edit-icon-avatar"></i>
						<a href="{{ url('/users/avatar') }}">
							<img src="{{ asset('/img/avatars/' . $user->avatar) }}" class="img img-responsive">
						</a>
						</div>
					</div>
				</div>

	        </div>


	    </div>


@endsection
