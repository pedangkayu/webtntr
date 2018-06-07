@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form" role="form" method="POST" action="{{ url('/users/' . $user->id) }}">
      {!! method_field('PUT') !!}
      <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus required>
                    <label for="name">Full Name *</label>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                    <label for="name">Phone *</label>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}" required>
                    <label for="name">City</label>

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                    <input id="country" type="text" class="form-control" name="country" value="{{ $user->country }}" required>
                    <label for="name">Country *</label>

                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <textarea id="address" type="text" class="form-control" name="address" required>{{ $user->address }}</textarea>
                    <label for="name">Address *</label>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

              </div>
              <div class="col-sm-6">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input id="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
                    <label for="email">Email Address</label>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control" name="password">
                    <label for="password">Password</label>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">

                    <select class="form-control" name="level">
                      @foreach($levels as $level)
                        @if($level->id != 1)
                        <option value="{{ $level->id }}" {!! $level->id == $user->level_id ? 'selected' : '' !!}>{{ $level->nm_level }}</option>
                        @endif
                      @endforeach
                    </select>
                    <label for="password-confirm">Level *</label>

                    @if ($errors->has('level'))
                        <span class="help-block">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>

              </div>
            </div>
          </div>

          <div class="card-actionbar">
              <div class="card-actionbar-row">
                <a href="{{ url('/users') }}" class="btn pull-left btn-flat btn-accent ink-reaction">BACK</a>
                <button type="submit" class="btn btn-flat btn-accent ink-reaction">UPDATE ACCOUNT</button>
              </div>
          </div><!--end .card-actionbar -->

      </div>
    </form>
</div>
@endsection
