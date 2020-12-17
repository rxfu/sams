@extends('layouts.app')

@section('title', __('Edit') . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('user.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('users.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-right">{{ __('user.username') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="{{ __('user.username') }}" value="{{ old('username', $item->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('user.name') }}" value="{{ old('name', $item->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-3 col-form-label text-right">{{ __('user.role') }}</label>
                        <div class="col-sm-9 select2-info">
                            @inject('roles', 'App\Services\RoleService')
							<select name="roles[]" id="roles" class="form-control select2 select2-info @error('roles') is-invalid @enderror" data-dropdown-css-class="select2-info" multiple="multiple">
                                @foreach ($roles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ in_array($collection->getKey(), $item->roles->pluck('id')->toArray()) ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                        <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('user.phone') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="{{ __('user.phone') }}" value="{{ old('phone', $item->phone) }}">
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
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="{{ __('user.email') }}" value="{{ old('email', $item->email) }}">
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
							<select name="department_id" id="department_id" class="form-control select2 select2-info @error('department_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                @foreach ($departments->getCollege() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('department_id', $item->department_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                        <div class="col-sm-9 select2-info">
                            @inject('majors', 'App\Services\MajorService')
							<select name="majors[]" id="majors" class="form-control select2 select2-info @error('majors') is-invalid @enderror" data-dropdown-css-class="select2-info" multiple="multiple">
                                @foreach ($majors->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}" class="{{ $collection->department_id }}"{{ in_array($collection->getKey(), $item->majors->pluck('id')->toArray()) ? ' selected' : '' }}>{{ $collection->name }}（{{ $collection->level == 0 ? '本科' : '研究生' }}）</option>
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
                        <div class="col-sm-9 select2-info">
                            @inject('students', 'App\Services\StudentService')
							<select name="grades[]" id="grades" class="form-control select2 select2-info @error('grades') is-invalid @enderror" data-dropdown-css-class="select2-info" multiple="multiple">
                                @foreach ($students->getAllGrades() as $collection)
                                    <option value="{{ $collection->grade }}"{{ in_array($collection->grade, explode(',', $item->grade)) ? ' selected' : '' }}>{{ $collection->grade }}</option>
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
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable1" class="form-check-input @error('is_enable') is-invalid @enderror" value="1"{{ old('is_enable', $item->is_enable) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input @error('is_enable') is-invalid @enderror" value="0"{{ old('is_enable', $item->is_enable) == 0 ? ' checked' : '' }}>
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
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> {{ __('Save') }}
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
        $('#majors').chained('#department_id');
        $('.select2').select2();
    })
</script>
@endpush
