@extends('layouts.app')

@section('title', __('Create') . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('user.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-right">{{ __('user.username') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="{{ __('user.username') }}" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label text-right">{{ __('user.password') }}</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('user.password') }}" value="{{ old('password') }}" required>
                            @error('password')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
	                        <small class="form-text text-muted">密码至少8位</small>
                        </div>
                    </div>

	                <div class="form-group row">
	                    <label for="password_confirmation" class="col-sm-3 col-form-label text-right">{{ __('user.password_confirmation') }}</label>
	                    <div class="col-md-9">
	                    	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('user.password_confirmation') }}" required>
	                        @error('password_confirmation')
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
	                        @enderror
	                    </div>
	                </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('user.name') }}" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-3 col-form-label text-right">{{ __('user.role') }}</label>
                        <div class="col-sm-9 select2-success">
                            @inject('roles', 'App\Services\RoleService')
							<select name="roles[]" id="roles" class="form-control select2 select2-success @error('roles') is-invalid @enderror" data-dropdown-css-class="select2-success" multiple="multiple">
                                @foreach ($roles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="groups" class="col-sm-3 col-form-label text-right">{{ __('user.group') }}</label>
                        <div class="col-sm-9 select2-success">
                            @inject('groups', 'App\Services\GroupService')
							<select name="groups[]" id="groups" class="form-control select2 select2-success @error('groups') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($groups->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('groups')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('user.phone') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="{{ __('user.phone') }}" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">{{ __('user.email') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="{{ __('user.email') }}" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('user.department') }}</label>
                        <div class="col-sm-9">
                            @inject('departments', 'App\Services\DepartmentService')
							<select name="department_id" id="department_id" class="form-control select2 select2-success @error('department_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($departments->getCollege() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="majors" class="col-sm-3 col-form-label text-right">{{ __('user.major') }}</label>
                        <div class="col-sm-9 select2-success">
                            @inject('majors', 'App\Services\MajorService')
							<select name="majors[]" id="majors" class="form-control select2 select2-success @error('majors') is-invalid @enderror" data-dropdown-css-class="select2-success" multiple="multiple">
                                @foreach ($majors->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}" data-chained="{{ $collection->level }}+{{ $collection->department_id }}">{{ $collection->name }}（{{ $collection->group->name }}）</option>
                                @endforeach
                            </select>
                            @error('majors')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grades" class="col-sm-3 col-form-label text-right">{{ __('user.grade') }}</label>
                        <div class="col-sm-9 select2-success">
                            @inject('students', 'App\Services\StudentService')
							<select name="grades[]" id="grades" class="form-control select2 select2-success @error('grades') is-invalid @enderror" data-dropdown-css-class="select2-success" multiple="multiple">
                                @foreach ($students->getAllGrades() as $collection)
                                    <option value="{{ $collection->grade }}">{{ $collection->grade }}</option>
                                @endforeach
                            </select>
                            @error('grades')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('user.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable1" class="form-check-input @error('is_enable') is-invalid @enderror" value="1" checked>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input @error('is_enable') is-invalid @enderror" value="0">
                                <label class="form-check-label" for="is_enable0">否</label>
                            </div>
                            @error('is_enable')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('plugins/jquery-chained/jquery.chained.min.js') }}"></script>
<script>
    $(function() {
        $('#majors').chained('#groups, #department_id');
        $('.select2').select2();
    })
</script>
@endpush
