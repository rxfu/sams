@extends('layouts.app')

@section('title', '修改密码')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">修改密码</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('passwords.store') }}">
                @csrf
                <div class="card-body">
	                <div class="form-group row">
	                    <label for="old_password" class="col-sm-3 col-form-label text-right">{{ __('user.old_password') }}</label>
	                    <div class="col-md-9">
	                    	<input type="password" name="old_password" id="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('user.old_password') }}" value="{{ old('old_password') }}" required focus>
	                        @error('old_password')
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $message}}</strong>
		                        </div>
	                        @enderror
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="password" class="col-sm-3 col-form-label text-right">{{ __('user.password') }}</label>
	                    <div class="col-md-9">
	                    	<input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('user.password') }}" required>
	                        @error('password')
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $message}}</strong>
		                        </div>
	                        @enderror
	                        <small class="form-text text-muted">密码至少8位</small>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="password_confirmation" class="col-sm-3 col-form-label text-right">{{ __('user.password_confirmation') }}</label>
	                    <div class="col-md-9">
	                    	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{ __('user.password_confirmation') }}" required>
	                        @error('password_confirmation')
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $message}}</strong>
		                        </div>
	                        @enderror
	                    </div>
	                </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> 确认修改
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
